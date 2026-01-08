<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MysqlBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create MySQL database backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = 'mysql_backup_' . date('Y_m_d_His') . '.sql';
        $path = storage_path('app/backups/' . $filename);

        if (!is_dir(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0755, true);
        }

        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');

        $command = sprintf(
            "mysqldump -h%s -u%s -p'%s' %s > %s",
            $dbHost,
            $dbUser,
            $dbPass,
            $dbName,
            $path
        );

        exec($command, $output, $returnVar);

        if ($returnVar === 0 && file_exists($path)) {

            Log::channel('db_backup')->info('Database backup completed successfully', [
                'file' => $filename,
                'database' => $dbName,
                'time' => now()->toDateTimeString(),
            ]);
    
            $this->info('Backup completed successfully.');
    
        } else {
    
            Log::channel('db_backup')->error('Database backup failed', [
                'database' => $dbName,
                'time' => now()->toDateTimeString(),
                'error_code' => $returnVar,
            ]);
    
            $this->error('Backup failed.');
        }

       
    }
    
}
