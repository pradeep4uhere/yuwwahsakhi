<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\YuwaahSakhi;

class GenerateFieldAgentSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fieldagent:summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Partner Field Agent Summery';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info('Generating Field Agent Summary...');

        DB::beginTransaction();

        try {

            DB::table('field_agent_summaries')->truncate();

            $agents = YuwaahSakhi::select(
                    'id',
                    'partner_id',
                    'csc_id'
                )
                ->where('csc_id', '!=', 'Sandbox_Testing')
                ->get();

            $bar = $this->output->createProgressBar($agents->count());

            foreach ($agents as $agent) {

                /*
                |--------------------------------------------------------------------------
                | Job Counts
                |--------------------------------------------------------------------------
                */

                $job = DB::table('event_transactions')
                    ->selectRaw("
                        COUNT(*) as total_jobs,

                        SUM(CASE WHEN review_status='Open' THEN 1 ELSE 0 END) as open_jobs,

                        SUM(CASE WHEN review_status='Pending' THEN 1 ELSE 0 END) as pending_jobs,

                        SUM(CASE WHEN review_status='Accepted' THEN 1 ELSE 0 END) as accepted_jobs,

                        SUM(CASE WHEN review_status='Rejected' THEN 1 ELSE 0 END) as rejected_jobs
                    ")
                    ->where('learner_id', $agent->id)
                    ->whereIn('event_type', [1,5])
                    ->first();

                /*
                |--------------------------------------------------------------------------
                | Social Protection Counts
                |--------------------------------------------------------------------------
                */

                $social = DB::table('event_transactions')
                    ->selectRaw("
                        COUNT(*) as total_social,

                        SUM(CASE WHEN review_status='Open' THEN 1 ELSE 0 END) as open_social,

                        SUM(CASE WHEN review_status='Pending' THEN 1 ELSE 0 END) as pending_social,

                        SUM(CASE WHEN review_status='Accepted' THEN 1 ELSE 0 END) as accepted_social,

                        SUM(CASE WHEN review_status='Rejected' THEN 1 ELSE 0 END) as rejected_social
                    ")
                    ->where('learner_id', $agent->id)
                    ->where('event_type',3)
                    ->first();

                /*
                |--------------------------------------------------------------------------
                | Learner Count
                |--------------------------------------------------------------------------
                */

                $learnerCount = DB::table('learners')
                    ->where('UNIT_INSTITUTE',$agent->csc_id)
                    ->count();

                /*
                |--------------------------------------------------------------------------
                | Completed Learners
                |--------------------------------------------------------------------------
                */

                $completedLearners = DB::table('learners')
                    ->join(
                        'yhub_learners',
                        'learners.normalized_mobile',
                        '=',
                        'yhub_learners.normalized_mobile'
                    )
                    ->where('learners.UNIT_INSTITUTE',$agent->csc_id)
                    ->count();

                /*
                |--------------------------------------------------------------------------
                | Insert
                |--------------------------------------------------------------------------
                */

                DB::table('field_agent_summaries')->insert([

                    'sakhi_id' => $agent->id,

                    'partner_id' => $agent->partner_id,

                    'csc_id' => $agent->csc_id,

                    'total_jobs' => $job->total_jobs ?? 0,
                    'open_jobs' => $job->open_jobs ?? 0,
                    'pending_jobs' => $job->pending_jobs ?? 0,
                    'accepted_jobs' => $job->accepted_jobs ?? 0,
                    'rejected_jobs' => $job->rejected_jobs ?? 0,

                    'total_social' => $social->total_social ?? 0,
                    'open_social' => $social->open_social ?? 0,
                    'pending_social' => $social->pending_social ?? 0,
                    'accepted_social' => $social->accepted_social ?? 0,
                    'rejected_social' => $social->rejected_social ?? 0,

                    'learner_count' => $learnerCount,

                    'completed_learners' => $completedLearners,

                    'summary_generated_at' => now(),

                    'created_at' => now(),
                    'updated_at' => now(),

                ]);

                $bar->advance();

            }

            $bar->finish();

            DB::commit();

            $this->newLine();

            $this->info('Summary Generated Successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            $this->error($e->getMessage());

        }

        return Command::SUCCESS;

    }
}
