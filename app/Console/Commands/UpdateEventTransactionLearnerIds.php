<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateEventTransactionLearnerIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:update-learner-ids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update event_transactions.learner_id from learners table based on phone number match';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $this->info('Updating learner IDs in event_transactions...');
        $this->info('🔄 Starting learner ID update process...');
        $total = DB::table('event_transactions')->count();
        $this->info("Total event_transactions: {$total}");

        $updatedCount = 0;
        DB::statement("
        UPDATE event_transactions AS et
        JOIN learners AS l ON et.beneficiary_phone_number = l.primary_phone_number
        SET et.learner_id = l.id");
        // Fetch affected rows count
        $updatedCount = DB::select("SELECT ROW_COUNT() AS affected_rows")[0]->affected_rows;

        $this->info("✅ Learner IDs updated successfully!");
        $this->info("🔢 Total records updated: {$updatedCount}");
        $this->info('✅ Learner IDs updated successfully!');
        return 0;
        

    }
}
