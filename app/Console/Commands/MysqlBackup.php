<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class MysqlBackup extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'backup:mysql';

    /**
     * The console command description.
     */
    protected $description = 'Create MySQL backups for configured databases';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(0);

        /*
        |--------------------------------------------------------------------------
        | Backup directory
        |--------------------------------------------------------------------------
        */

        $backupDir = storage_path('app/backups');

        if (!is_dir($backupDir)) {

            if (!mkdir($backupDir, 0755, true) && !is_dir($backupDir)) {

                $this->error(
                    "Unable to create backup directory: {$backupDir}"
                );

                return self::FAILURE;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Laravel database connections
        |--------------------------------------------------------------------------
        |
        | These are the connection names configured in config/database.php.
        |
        */

        $connections = [
            'mysql',
            'mysql2',
        ];

        $totalSuccess = 0;
        $totalFailed = 0;

        /*
        |--------------------------------------------------------------------------
        | Start backup
        |--------------------------------------------------------------------------
        */

        foreach ($connections as $connectionName) {

            /*
            |--------------------------------------------------------------------------
            | Get connection configuration
            |--------------------------------------------------------------------------
            */

            $config = config(
                "database.connections.{$connectionName}"
            );

            if (!$config) {

                $this->error(
                    "Database connection not found: {$connectionName}"
                );

                $totalFailed++;

                continue;
            }

            $dbHost = $config['host'] ?? '127.0.0.1';
            $dbPort = $config['port'] ?? 3306;
            $dbName = $config['database'] ?? null;
            $dbUser = $config['username'] ?? null;
            $dbPass = $config['password'] ?? null;

            /*
            |--------------------------------------------------------------------------
            | Validate configuration
            |--------------------------------------------------------------------------
            */

            if (empty($dbName)) {

                $this->error(
                    "Database name is missing for connection: {$connectionName}"
                );

                $totalFailed++;

                continue;
            }

            if (empty($dbUser)) {

                $this->error(
                    "Database username is missing for connection: {$connectionName}"
                );

                $totalFailed++;

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Display backup information
            |--------------------------------------------------------------------------
            */

            $this->newLine();

            $this->info(
                '=========================================='
            );

            $this->info(
                "Starting backup: {$dbName}"
            );

            $this->info(
                "Connection: {$connectionName}"
            );

            $this->info(
                "Host: {$dbHost}:{$dbPort}"
            );

            $this->info(
                "User: {$dbUser}"
            );

            $this->info(
                '=========================================='
            );

            /*
            |--------------------------------------------------------------------------
            | Backup filename
            |--------------------------------------------------------------------------
            */

            $filename =
                'bkp_' .
                date('dMY_His') .
                '_' .
                $dbName .
                '.sql';

            $path = $backupDir . DIRECTORY_SEPARATOR . $filename;

            /*
            |--------------------------------------------------------------------------
            | Create mysqldump process
            |--------------------------------------------------------------------------
            |
            | --no-tablespaces is required because the backup users do not
            | have the PROCESS privilege.
            |
            */

            $process = new Process([
                'mysqldump',

                '--no-tablespaces',

                '--single-transaction',

                '--routines',

                '--triggers',

                '--events',

                '-h',
                $dbHost,

                '-P',
                (string) $dbPort,

                '-u',
                $dbUser,

                $dbName,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Unlimited timeout
            |--------------------------------------------------------------------------
            |
            | Your database is large (2.6GB+), so don't use the default
            | Symfony Process timeout.
            |
            */

            $process->setTimeout(null);

            /*
            |--------------------------------------------------------------------------
            | Pass MySQL password through environment
            |--------------------------------------------------------------------------
            |
            | This avoids putting the password directly in the command.
            |
            */

            $process->setEnv([
                'MYSQL_PWD' => $dbPass ?? '',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Open backup file
            |--------------------------------------------------------------------------
            */

            $outputFile = fopen($path, 'wb');

            if ($outputFile === false) {

                $this->error(
                    "Unable to create backup file: {$path}"
                );

                Log::channel('db_backup')->error(
                    'Unable to create backup file',
                    [
                        'connection' => $connectionName,
                        'database' => $dbName,
                        'path' => $path,
                        'time' => now()->toDateTimeString(),
                    ]
                );

                $totalFailed++;

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Run mysqldump
            |--------------------------------------------------------------------------
            */

            try {

                $process->run(
                    function ($type, $buffer) use ($outputFile) {

                        if ($type === Process::OUT) {

                            fwrite(
                                $outputFile,
                                $buffer
                            );

                        } else {

                            /*
                            |--------------------------------------------------------------------------
                            | Error output
                            |--------------------------------------------------------------------------
                            */

                            echo $buffer;
                        }
                    }
                );

            } catch (\Throwable $e) {

                fclose($outputFile);

                if (file_exists($path)) {
                    unlink($path);
                }

                Log::channel('db_backup')->error(
                    'Database backup exception',
                    [
                        'connection' => $connectionName,
                        'database' => $dbName,
                        'error' => $e->getMessage(),
                        'time' => now()->toDateTimeString(),
                    ]
                );

                $this->error(
                    "✘ Backup exception: {$dbName}"
                );

                $this->error(
                    $e->getMessage()
                );

                $totalFailed++;

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Close output file
            |--------------------------------------------------------------------------
            */

            fclose($outputFile);

            /*
            |--------------------------------------------------------------------------
            | Check mysqldump result
            |--------------------------------------------------------------------------
            */

            if (!$process->isSuccessful()) {

                $error = trim(
                    $process->getErrorOutput()
                );

                /*
                |--------------------------------------------------------------------------
                | Delete incomplete backup
                |--------------------------------------------------------------------------
                */

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
                        'time' => now()->toDateTimeString(),
                    ]
                );

                $this->error(
                    "✘ Backup FAILED: {$dbName}"
                );

                if (!empty($error)) {

                    $this->error(
                        $error
                    );
                }

                $totalFailed++;

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Verify backup file
            |--------------------------------------------------------------------------
            */

            if (
                !file_exists($path) ||
                filesize($path) === 0
            ) {

                $this->error(
                    "✘ Backup file is empty: {$filename}"
                );

                if (file_exists($path)) {
                    unlink($path);
                }

                Log::channel('db_backup')->error(
                    'Backup file is empty',
                    [
                        'connection' => $connectionName,
                        'database' => $dbName,
                        'file' => $filename,
                        'time' => now()->toDateTimeString(),
                    ]
                );

                $totalFailed++;

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Backup successful
            |--------------------------------------------------------------------------
            */

            $sizeBytes = filesize($path);

            $sizeMB = round(
                $sizeBytes / 1024 / 1024,
                2
            );

            $sizeGB = round(
                $sizeBytes / 1024 / 1024 / 1024,
                2
            );

            Log::channel('db_backup')->info(
                'Database backup completed successfully',
                [
                    'connection' => $connectionName,
                    'database' => $dbName,
                    'file' => $filename,
                    'path' => $path,
                    'size_bytes' => $sizeBytes,
                    'size_mb' => $sizeMB,
                    'size_gb' => $sizeGB,
                    'time' => now()->toDateTimeString(),
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Console output
            |--------------------------------------------------------------------------
            */

            $this->info(
                "✓ Backup completed: {$dbName}"
            );

            $this->info(
                "  File: {$filename}"
            );

            $this->info(
                "  Size: {$sizeMB} MB ({$sizeGB} GB)"
            );

            $this->info(
                "  Location: {$path}"
            );

            $totalSuccess++;
        }

        /*
        |--------------------------------------------------------------------------
        | Final summary
        |--------------------------------------------------------------------------
        */

        $this->newLine();

        $this->info(
            '=========================================='
        );

        $this->info(
            'Database Backup Summary'
        );

        $this->info(
            '=========================================='
        );

        $this->info(
            "Successful: {$totalSuccess}"
        );

        $this->info(
            "Failed: {$totalFailed}"
        );

        $this->info(
            "Backup directory: {$backupDir}"
        );

        $this->info(
            '=========================================='
        );

        /*
        |--------------------------------------------------------------------------
        | Return status
        |--------------------------------------------------------------------------
        */

        return $totalFailed > 0
            ? self::FAILURE
            : self::SUCCESS;
    }
}