<?php

namespace App\Services\Backup;

use Illuminate\Support\Facades\Storage;
use RuntimeException;

class S3BackupService
{
    protected string $disk = 's3';

    protected string $directory = 'testing';

    public function upload(string $localPath): string
    {
        if (!file_exists($localPath)) {
            throw new RuntimeException(
                "Backup file does not exist: {$localPath}"
            );
        }

        if (filesize($localPath) === 0) {
            throw new RuntimeException(
                "Backup file is empty: {$localPath}"
            );
        }

        $filename = basename($localPath);

        $s3Path = $this->directory . '/' . $filename;

        $handle = fopen($localPath, 'rb');

        if ($handle === false) {
            throw new RuntimeException(
                "Unable to open backup file: {$localPath}"
            );
        }

        try {

            $uploaded = Storage::disk($this->disk)->put(
                $s3Path,
                $handle
            );

        } finally {

            fclose($handle);
        }

        if (!$uploaded) {
            throw new RuntimeException(
                "S3 upload failed: {$s3Path}"
            );
        }

        if (!Storage::disk($this->disk)->exists($s3Path)) {
            throw new RuntimeException(
                "S3 upload verification failed: {$s3Path}"
            );
        }

        return $s3Path;
    }

    public function deleteLocal(string $localPath): void
    {
        if (file_exists($localPath)) {
            unlink($localPath);
        }
    }
}