<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Services\FieldAgentSummaryService;

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
    public function handle(FieldAgentSummaryService $service)
    {
        $this->info('Generating Field Agent Summary...');
        DB::table('field_agent_summaries')->truncate();

        DB::beginTransaction();
        try {

          

            $count = $service->generate();

            DB::commit();

            $this->info("{$count} summaries generated successfully.");

        } catch (\Throwable $e) {

            DB::rollBack();

            $this->error($e->getMessage());

        }

        return self::SUCCESS;
    }
}
