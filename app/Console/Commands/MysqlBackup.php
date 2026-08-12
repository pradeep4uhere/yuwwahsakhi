<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class MysqlBackup extends Command
{
    protected $signature = 'backup:mysql';

    protected $description = 'Create MySQL backups for primary and secondary databases';

    public function handle()
    {
        set_time_limit(0);

        $backupDir = storage_path('app/backups');

        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        /*
        |--------------------------------------------------------------------------
        | Get databases from Laravel database connections
        |--------------------------------------------------------------------------
        */

        $connections = [
            'mysql',
            'mysql2',
        ];

        foreach ($connections as $connectionName) {

            $config = config("database.connections.{$connectionName}");

            $dbHost = $config['host'];
            $dbPort = $config['port'] ?? 3306;
            $dbName = $config['database'];
            $dbUser = $config['username'];
            $dbPass = $config['password'];

            if (empty($dbName)) {

                $this->error(
                    "Database name is missing for connection: {$connectionName}"
                );

                continue;
            }

            $this->newLine();

            $this->info('==========================================');
            $this->info("Starting backup: {$dbName}");
            $this->info("Connection: {$connectionName}");
            $this->info('==========================================');

            /*
            |--------------------------------------------------------------------------
            | Backup filename
            |--------------------------------------------------------------------------
            */

            $filename = 'bkp_' .
                date('dMY_His') .
                '_' .
                $dbName .
                '.sql';

            $path = $backupDir . '/' . $filename;

            /*
            |--------------------------------------------------------------------------
            | Temporary MySQL credentials file
            |--------------------------------------------------------------------------
            */

            $tempConfig = tempnam(
                sys_get_temp_dir(),
                'mysql_backup_'
            );

            file_put_contents(
                $tempConfig,
                "[client]\n" .
                "host={$dbHost}\n" .
                "port={$dbPort}\n" .
                "user={$dbUser}\n" .
                "password={$dbPass}\n"
            );

            chmod($tempConfig, 0600);

            try {

                /*
                |--------------------------------------------------------------------------
                | Run mysqldump
                |--------------------------------------------------------------------------
                */

                $process = new Process([
                    'mysqldump',
                    "--defaults-extra-file={$tempConfig}",
                    '--single-transaction',
                    '--routines',
                    '--triggers',
                    '--events',
                    $dbName,
                ]);

                $process->setTimeout(null);

                $outputFile = fopen($path, 'w');

                if (!$outputFile) {

                    $this->error(
                        "Unable to create backup file: {$path}"
                    );

                    unlink($tempConfig);

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Execute
                |--------------------------------------------------------------------------
                */

                $process->run(
                    function ($type, $buffer) use ($outputFile) {

                        if ($type === Process::OUT) {
                            fwrite($outputFile, $buffer);
                        } else {
                            echo $buffer;
                        }

                    }
                );

                fclose($outputFile);

                /*
                |--------------------------------------------------------------------------
                | Check result
                |--------------------------------------------------------------------------
                */

                if (!$process->isSuccessful()) {

                    $error = $process->getErrorOutput();

                    if (file_exists($path)) {
                        unlink($path);
                    }

                    Log::channel('db_backup')->error(
                        'Database backup failed',
                        [
                            'connection' => $connectionName,
                            'database' => $dbName,
                            'error' => $error,
                            'exit_code' => $process->getExitCode(),
                        ]
                    );

                    $this->error(
                        "✘ Backup FAILED: {$dbName}"
                    );

                    $this->error($error);

                    unlink($tempConfig);

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Verify backup
                |--------------------------------------------------------------------------
                */

                if (!file_exists($path) || filesize($path) === 0) {

                    $this->error(
                        "✘ Backup file is empty: {$filename}"
                    );

                    unlink($tempConfig);

                    continue;
                }

                $size = filesize($path);

                /*
                |--------------------------------------------------------------------------
                | Log
                |--------------------------------------------------------------------------
                */

                Log::channel('db_backup')->info(
                    'Database backup completed successfully',
                    [
                        'connection' => $connectionName,
                        'database' => $dbName,
                        'file' => $filename,
                        'path' => $path,
                        'size_bytes' => $size,
                        'size_mb' => round(
                            $size / 1024 / 1024,
                            2
                        ),
                        'time' => now()->toDateTimeString(),
                    ]
                );

                $this->info(
                    "✓ Backup completed: {$dbName}"
                );

                $this->info(
                    "  File: {$filename}"
                );

                $this->info(
                    '  Size: ' .
                    round($size / 1024 / 1024, 2) .
                    ' MB'
                );

            } catch (\Throwable $e) {

                if (isset($outputFile) && is_resource($outputFile)) {
                    fclose($outputFile);
                }

                if (file_exists($path)) {
                    unlink($path);
                }

                Log::channel('db_backup')->error(
                    'Database backup exception',
                    [
                        'connection' => $connectionName,
                        'database' => $dbName,
                        'error' => $e->getMessage(),
                    ]
                );

                $this->error(
                    "✘ Backup failed: {$dbName}"
                );

                $this->error(
                    $e->getMessage()
                );

            } finally {

                /*
                |--------------------------------------------------------------------------
                | Remove temporary credentials
                |--------------------------------------------------------------------------
                */

                if (file_exists($tempConfig)) {
                    unlink($tempConfig);
                }
            }
        }

        $this->newLine();

        $this->info('==========================================');
        $this->info('All Database Backups Completed');
        $this->info('==========================================');

        return self::SUCCESS;
    }
}