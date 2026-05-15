<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private function indexExists(string $table, string $index): bool
    {
        $database = DB::getDatabaseName();

        return DB::table('information_schema.statistics')
            ->where('table_schema', $database)
            ->where('table_name', $table)
            ->where('index_name', $index)
            ->exists();
    }

    public function up(): void
    {
        Schema::table('event_transactions', function (Blueprint $table) {
            if (!$this->indexExists('event_transactions', 'idx_review_status')) {
                $table->index('review_status', 'idx_review_status');
            }

            if (!$this->indexExists('event_transactions', 'idx_event_date_submitted')) {
                $table->index('event_date_submitted', 'idx_event_date_submitted');
            }

            if (!$this->indexExists('event_transactions', 'idx_learner_id')) {
                $table->index('learner_id', 'idx_learner_id');
            }

            if (!$this->indexExists('event_transactions', 'idx_event_category')) {
                $table->index('event_category', 'idx_event_category');
            }

            if (!$this->indexExists('event_transactions', 'idx_ys_id')) {
                $table->index('ys_id', 'idx_ys_id');
            }
        });

        Schema::table('yuwaah_backend.event_transaction_comments', function (Blueprint $table) {
            if (!$this->indexExists('yuwaah_backend.event_transaction_comments', 'idx_event_transaction_id')) {
                $indexes = collect(DB::select("SHOW INDEX FROM yuwaah_backend.event_transaction_comments"))
                ->pluck('Key_name')
                ->toArray();
            
                if (!in_array('idx_event_transaction_id', $indexes)) {
                    $table->index('event_transaction_id', 'idx_event_transaction_id');
                }
            }
        });

        Schema::table('learners', function (Blueprint $table) {
            if (!$this->indexExists('learners', 'idx_program_code')) {
                $table->index('PROGRAM_CODE', 'idx_program_code');
            }
        });
    }

    public function down(): void
    {
        Schema::table('event_transactions', function (Blueprint $table) {
            if ($this->indexExists('event_transactions', 'idx_review_status')) {
                $table->dropIndex('idx_review_status');
            }

            if ($this->indexExists('event_transactions', 'idx_event_date_submitted')) {
                $table->dropIndex('idx_event_date_submitted');
            }

            if ($this->indexExists('event_transactions', 'idx_learner_id')) {
                $table->dropIndex('idx_learner_id');
            }

            if ($this->indexExists('event_transactions', 'idx_event_category')) {
                $table->dropIndex('idx_event_category');
            }

            if ($this->indexExists('event_transactions', 'idx_ys_id')) {
                $table->dropIndex('idx_ys_id');
            }
        });

        Schema::table('yuwaah_backend.event_transaction_comments', function (Blueprint $table) {
            if ($this->indexExists('yuwaah_backend.event_transaction_comments', 'idx_event_transaction_id')) {
                $table->dropIndex('idx_event_transaction_id');
            }
        });

        Schema::table('learners', function (Blueprint $table) {
            if ($this->indexExists('learners', 'idx_program_code')) {
                $table->dropIndex('idx_program_code');
            }
        });
    }
};