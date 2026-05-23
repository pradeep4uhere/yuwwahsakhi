<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportLearnersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $path;
    public $historyId;

    public function __construct($path, $historyId)
    {
        $this->path = $path;
        $this->historyId = $historyId;
    }

    public function handle()
    {
        $history = ImportHistory::find($this->historyId);

        $fullPath = storage_path('app/' . $this->path);

        $handle = fopen($fullPath, 'r');

        $header = fgetcsv($handle);

        $processed = 0;
        $updated = 0;
        $inserted = 0;

        $logs = [];

        while (($row = fgetcsv($handle)) !== false) {

            $data = array_combine($header, $row);

            $phone = preg_replace('/\D/', '', $data['USER PHONE NUMBER']);

            $exists = Learner::where(
                'primary_phone_number',
                $phone
            )->first();

            if ($exists) {

                $exists->update([
                    'first_name' => $data['FIRST NAME']
                ]);

                $updated++;

                $logs[] = [
                    'type' => 'updated',
                    'phone' => $phone,
                    'name' => $data['FIRST NAME']
                ];

            } else {

                Learner::create([
                    'first_name' => $data['FIRST NAME'],
                    'primary_phone_number' => $phone,
                ]);

                $inserted++;

                $logs[] = [
                    'type' => 'inserted',
                    'phone' => $phone,
                    'name' => $data['FIRST NAME']
                ];
            }

            $processed++;

            // Keep latest 100 logs only
            $logs = array_slice($logs, -100);

            $history->update([
                'processed_rows' => $processed,
                'updated_rows' => $updated,
                'inserted_rows' => $inserted,
                'logs' => json_encode($logs),
            ]);
        }

        fclose($handle);

        $history->update([
            'status' => 'completed'
        ]);
    }



}
