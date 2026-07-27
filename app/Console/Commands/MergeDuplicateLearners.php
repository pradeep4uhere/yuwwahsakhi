<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Learner;

class MergeDuplicateLearners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'learners:merge-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Merge duplicate learners based on normalized_mobile';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::beginTransaction();

        try {

            $columns = Schema::getColumnListing('learners');

            $ignoreColumns = [
                'id',
                'created_at',
                'updated_at',
            ];

            $duplicates = Learner::select('normalized_mobile')
                ->whereNotNull('normalized_mobile')
                ->where('normalized_mobile', '<>', '')
                ->groupBy('normalized_mobile')
                ->havingRaw('COUNT(*) > 1')
                ->pluck('normalized_mobile');

            $this->info("Duplicate Mobiles Found : ".$duplicates->count());

            foreach ($duplicates as $mobile) {

                $rows = Learner::where('normalized_mobile', $mobile)->get();

                /*
                |--------------------------------------------------------------------------
                | Find Best Record (Maximum Filled Columns)
                |--------------------------------------------------------------------------
                */

                $master = null;
                $highestScore = -1;

                foreach ($rows as $row) {

                    $score = 0;

                    foreach ($columns as $column) {

                        if (in_array($column, $ignoreColumns)) {
                            continue;
                        }

                        $value = $row->$column;

                        if (
                            !is_null($value) &&
                            trim((string)$value) !== ''
                        ) {
                            $score++;
                        }
                    }

                    if ($score > $highestScore) {

                        $highestScore = $score;
                        $master = $row;

                    }

                }

                if (!$master) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Merge Remaining Records
                |--------------------------------------------------------------------------
                */

                foreach ($rows as $row) {

                    if ($row->id == $master->id) {
                        continue;
                    }

                    foreach ($columns as $column) {

                        if (in_array($column, $ignoreColumns)) {
                            continue;
                        }

                        $masterValue = $master->$column;
                        $otherValue = $row->$column;

                        if (
                            (
                                is_null($masterValue)
                                || trim((string)$masterValue) == ''
                            )
                            &&
                            (
                                !is_null($otherValue)
                                && trim((string)$otherValue) != ''
                            )
                        ) {

                            $master->$column = $otherValue;

                            $this->line(
                                "Merged {$column} from ID {$row->id} -> {$master->id}"
                            );

                        }

                    }

                }

                $master->save();

                /*
                |--------------------------------------------------------------------------
                | Delete Remaining Records
                |--------------------------------------------------------------------------
                */

                foreach ($rows as $row) {

                    if ($row->id != $master->id) {

                        $this->warn(
                            "Deleting Duplicate ID : {$row->id}"
                        );

                        $row->delete();

                    }

                }

            }

            DB::commit();

            $this->info('Duplicate Merge Completed Successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            $this->error($e->getMessage());

        }
    }
}
