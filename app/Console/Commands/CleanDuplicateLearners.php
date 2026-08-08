<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Throwable;

class CleanDuplicateLearners extends Command
{
    /**
     * Run:
     *
     * Dry run:
     * php artisan learners:clean-duplicates
     *
     * Delete:
     * php artisan learners:clean-duplicates --delete
     */
    protected $signature = 'learners:clean-duplicates
                            {--delete : Actually delete eligible duplicate learners}
                            {--limit= : Process only this many mobile numbers}
                            {--mobile= : Process only a specific normalized_mobile}
                            {--report= : Custom CSV report path}';

    protected $description = 'Find duplicate learners with different PROGRAM_CODE values and safely delete only learners not referenced by event_transactions';

    public function handle(): int
    {
        $deleteMode = (bool) $this->option('delete');
        $limit = $this->option('limit');
        $specificMobile = $this->option('mobile');

        $reportPath = $this->option('report')
            ?: storage_path(
                'app/duplicate-learners-' . now()->format('Y-m-d_H-i-s') . '.csv'
            );

        $this->info('Starting duplicate learner analysis...');
        $this->newLine();

        if ($deleteMode) {
            $this->warn('DELETE MODE ENABLED');
            $this->warn('Only learners NOT referenced by event_transactions will be deleted.');
            $this->newLine();

            if (!$this->confirm('Do you want to continue?', false)) {
                $this->info('Operation cancelled.');
                return self::SUCCESS;
            }
        } else {
            $this->info('DRY-RUN MODE');
            $this->info('No records will be deleted.');
        }

        /*
         * -------------------------------------------------------------
         * Step 1
         * Find mobile numbers which:
         *
         * - are not NULL
         * - are not empty
         * - have more than one learner
         * - have more than one PROGRAM_CODE
         * -------------------------------------------------------------
         */

        $duplicateMobilesQuery = DB::table('learners')
            ->select('normalized_mobile')
            ->whereNotNull('normalized_mobile')
            ->where('normalized_mobile', '!=', '')
            ->when($specificMobile, function ($query) use ($specificMobile) {
                $query->where('normalized_mobile', $specificMobile);
            })
            ->groupBy('normalized_mobile')
            ->havingRaw('COUNT(*) > 1')
            ->havingRaw('COUNT(DISTINCT PROGRAM_CODE) > 1')
            ->orderBy('normalized_mobile');

        if ($limit) {
            $duplicateMobilesQuery->limit((int) $limit);
        }

        $duplicateMobiles = $duplicateMobilesQuery->pluck('normalized_mobile');

        if ($duplicateMobiles->isEmpty()) {
            $this->info('No duplicate learners found.');
            return self::SUCCESS;
        }

        $this->info(
            'Duplicate mobile numbers found: ' . $duplicateMobiles->count()
        );

        $this->newLine();

        /*
         * -------------------------------------------------------------
         * CSV REPORT
         * -------------------------------------------------------------
         */

        File::ensureDirectoryExists(dirname($reportPath));

        $csv = fopen($reportPath, 'w');

        fputcsv($csv, [
            'normalized_mobile',
            'learner_id',
            'program_code',
            'created_at',
            'referenced_in_event_transactions',
            'event_transaction_count',
            'action',
        ]);

        $totalLearners = 0;
        $eligibleForDeletion = 0;
        $protectedLearners = 0;
        $deletedLearners = 0;

        /*
         * -------------------------------------------------------------
         * Step 2
         *
         * Process each duplicate mobile separately.
         * -------------------------------------------------------------
         */

        foreach ($duplicateMobiles as $mobile) {

            $learners = DB::table('learners')
                ->select([
                    'id',
                    'normalized_mobile',
                    'PROGRAM_CODE',
                    'created_at',
                ])
                ->where('normalized_mobile', $mobile)
                ->orderBy('id')
                ->get();

            if ($learners->count() < 2) {
                continue;
            }

            /*
             * Make sure there are actually different PROGRAM_CODEs.
             */

            $programCodes = $learners
                ->pluck('PROGRAM_CODE')
                ->unique()
                ->values();

            if ($programCodes->count() < 2) {
                continue;
            }

            $this->line(
                "Mobile: {$mobile} | Learners: {$learners->count()} | Programs: {$programCodes->count()}"
            );

            foreach ($learners as $learner) {

                $totalLearners++;

                /*
                 * -----------------------------------------------------
                 * Step 3
                 *
                 * Check whether learner ID is referenced by
                 * event_transactions.
                 * -----------------------------------------------------
                 */

                $transactionCount = DB::table('event_transactions')
                    ->where('learner_id', $learner->id)
                    ->count();

                $isReferenced = $transactionCount > 0;

                if ($isReferenced) {

                    $action = 'KEEP - REFERENCED';

                    $protectedLearners++;

                } else {

                    $action = 'DELETE - NOT REFERENCED';

                    $eligibleForDeletion++;
                }

                /*
                 * Write report row.
                 */

                fputcsv($csv, [
                    $learner->normalized_mobile,
                    $learner->id,
                    $learner->PROGRAM_CODE,
                    $learner->created_at,
                    $isReferenced ? 'YES' : 'NO',
                    $transactionCount,
                    $action,
                ]);

                /*
                 * Display result.
                 */

                if ($isReferenced) {

                    $this->line(
                        "  KEEP   ID: {$learner->id} | PROGRAM: {$learner->PROGRAM_CODE} | Transactions: {$transactionCount}"
                    );

                } else {

                    $this->warn(
                        "  DELETE ID: {$learner->id} | PROGRAM: {$learner->PROGRAM_CODE} | Transactions: 0"
                    );
                }
            }

            $this->newLine();
        }

        fclose($csv);

        /*
         * -------------------------------------------------------------
         * Summary before deletion
         * -------------------------------------------------------------
         */

        $this->newLine();
        $this->info('========================================');
        $this->info('DUPLICATE LEARNER SUMMARY');
        $this->info('========================================');

        $this->info(
            'Duplicate mobile numbers : ' . $duplicateMobiles->count()
        );

        $this->info(
            'Learners analysed        : ' . $totalLearners
        );

        $this->info(
            'Referenced / protected   : ' . $protectedLearners
        );

        $this->warn(
            'Eligible for deletion    : ' . $eligibleForDeletion
        );

        $this->info(
            'Report                   : ' . $reportPath
        );

        /*
         * -------------------------------------------------------------
         * DRY RUN
         * -------------------------------------------------------------
         */

        if (!$deleteMode) {

            $this->newLine();

            $this->info('DRY RUN COMPLETE.');
            $this->info(
                "No learners were deleted. {$eligibleForDeletion} learners are eligible for deletion."
            );

            $this->newLine();

            $this->comment(
                'Review the CSV report before running with --delete.'
            );

            $this->newLine();

            $this->comment(
                'To delete eligible records:'
            );

            $this->comment(
                'php artisan learners:clean-duplicates --delete'
            );

            return self::SUCCESS;
        }

        /*
         * -------------------------------------------------------------
         * DELETE MODE
         *
         * Re-check everything before deletion.
         * -------------------------------------------------------------
         */

        if ($eligibleForDeletion === 0) {

            $this->info('Nothing to delete.');
            return self::SUCCESS;
        }

        $this->newLine();

        if (!$this->confirm(
            "Final confirmation: delete {$eligibleForDeletion} unreferenced learners?",
            false
        )) {
            $this->info('Deletion cancelled.');
            return self::SUCCESS;
        }

        /*
         * -------------------------------------------------------------
         * Delete inside transaction.
         * -------------------------------------------------------------
         */

        try {

            DB::transaction(function () use (
                $duplicateMobiles,
                &$deletedLearners
            ) {

                foreach ($duplicateMobiles as $mobile) {

                    /*
                     * Get learners again because we want the latest
                     * state of the database before deleting.
                     */

                    $learners = DB::table('learners')
                        ->select([
                            'id',
                            'normalized_mobile',
                            'PROGRAM_CODE',
                        ])
                        ->where('normalized_mobile', $mobile)
                        ->get();

                    /*
                     * Confirm multiple PROGRAM_CODEs still exist.
                     */

                    if (
                        $learners
                            ->pluck('PROGRAM_CODE')
                            ->unique()
                            ->count() < 2
                    ) {
                        continue;
                    }

                    foreach ($learners as $learner) {

                        /*
                         * VERY IMPORTANT:
                         *
                         * Re-check event_transactions immediately
                         * before deletion.
                         */

                        $transactionExists = DB::table('event_transactions')
                            ->where('learner_id', $learner->id)
                            ->exists();

                        if ($transactionExists) {
                            continue;
                        }

                        /*
                         * Delete learner.
                         */

                        $deleted = DB::table('learners')
                            ->where('id', $learner->id)
                            ->delete();

                        if ($deleted) {
                            $deletedLearners++;
                        }
                    }
                }
            });

        } catch (Throwable $e) {

            $this->error('Deletion failed.');
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        /*
         * -------------------------------------------------------------
         * Final result
         * -------------------------------------------------------------
         */

        $this->newLine();

        $this->info('========================================');
        $this->info('DELETION COMPLETE');
        $this->info('========================================');

        $this->info(
            'Learners deleted: ' . $deletedLearners
        );

        $this->info(
            'Learners protected: ' . $protectedLearners
        );

        $this->info(
            'Report: ' . $reportPath
        );

        return self::SUCCESS;
    }
}
