<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class OptimizePdfFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:optimize-pdfs 
                            {--quality=ebook : PDF quality: screen, ebook, printer, prepress}
                            {--backup : Create .bak backup before replacing original}';


    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Optimize all PDF files inside storage/app/public recursively using Ghostscript';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $basePath = storage_path('app/public');

        if (!File::exists($basePath)) {
            $this->error("Directory not found: {$basePath}");
            return Command::FAILURE;
        }

        if (!$this->ghostscriptAvailable()) {
            $this->error('Ghostscript not found. Please install ghostscript first.');
            return Command::FAILURE;
        }

        $quality = $this->option('quality');

        $allowedQualities = ['screen', 'ebook', 'printer', 'prepress'];

        if (!in_array($quality, $allowedQualities)) {
            $this->error('Invalid quality. Use: screen, ebook, printer, prepress');
            return Command::FAILURE;
        }

        $files = collect(File::allFiles($basePath))
            ->filter(fn ($file) => strtolower($file->getExtension()) === 'pdf');

        if ($files->isEmpty()) {
            $this->warn('No PDF files found.');
            return Command::SUCCESS;
        }

        $totalOptimized = 0;
        $totalSkipped = 0;
        $totalFailed = 0;
        $savedBytes = 0;

        foreach ($files as $file) {
            $fullPath = $file->getPathname();
            $relativePath = $file->getRelativePathname();

            $originalSize = filesize($fullPath);

            if ($originalSize <= 0) {
                $this->warn("Skipped empty file: {$relativePath}");
                $totalSkipped++;
                continue;
            }

            $this->info("Optimizing PDF: {$relativePath}");

            $tempFile = $fullPath . '.optimized.pdf';

            try {
                $success = $this->compressPdf($fullPath, $tempFile, $quality);

                if (!$success || !File::exists($tempFile)) {
                    $this->error("Failed: {$relativePath}");
                    $totalFailed++;
                    continue;
                }

                $optimizedSize = filesize($tempFile);

                if ($optimizedSize <= 0) {
                    File::delete($tempFile);
                    $this->error("Failed empty output: {$relativePath}");
                    $totalFailed++;
                    continue;
                }

                if ($optimizedSize >= $originalSize) {
                    File::delete($tempFile);
                    $this->warn("Skipped, already optimized: {$relativePath}");
                    $totalSkipped++;
                    continue;
                }

                if ($this->option('backup')) {
                    copy($fullPath, $fullPath . '.bak');
                }

                File::delete($fullPath);
                File::move($tempFile, $fullPath);

                $saved = $originalSize - $optimizedSize;
                $savedBytes += $saved;

                $this->info(
                    "Done: {$relativePath} | " .
                    $this->formatBytes($originalSize) .
                    " => " .
                    $this->formatBytes($optimizedSize) .
                    " | Saved: " .
                    $this->formatBytes($saved)
                );

                $totalOptimized++;
            } catch (\Throwable $e) {
                if (File::exists($tempFile)) {
                    File::delete($tempFile);
                }

                $this->error("Error: {$relativePath} => " . $e->getMessage());
                $totalFailed++;
            }
        }

        $this->newLine();
        $this->info('=================================');
        $this->info('PDF Optimization Completed');
        $this->info("Optimized: {$totalOptimized}");
        $this->info("Skipped: {$totalSkipped}");
        $this->info("Failed: {$totalFailed}");
        $this->info("Total Saved: " . $this->formatBytes($savedBytes));
        $this->info('=================================');

        $logMessage = "
        =================================
        PDF Optimization Completed
        Optimized: {$totalOptimized}
        Skipped: {$totalSkipped}
        Failed: {$totalFailed}
        Total Saved: " . $this->formatBytes($savedBytes) . "
        =================================
        ";

        $this->newLine();
        $this->info($logMessage);

        Log::info($logMessage);
        

        return Command::SUCCESS;
    }


    private function compressPdf(string $inputFile, string $outputFile, string $quality): bool
    {
        $settings = '/' . $quality;

        $command = [
            'gs',
            '-sDEVICE=pdfwrite',
            '-dCompatibilityLevel=1.4',
            "-dPDFSETTINGS={$settings}",
            '-dNOPAUSE',
            '-dQUIET',
            '-dBATCH',
            '-dDetectDuplicateImages=true',
            '-dCompressFonts=true',
            '-dSubsetFonts=true',
            '-sOutputFile=' . $outputFile,
            $inputFile,
        ];

        $escapedCommand = implode(' ', array_map('escapeshellarg', $command));

        exec($escapedCommand, $output, $returnCode);

        return $returnCode === 0;
    }

    private function ghostscriptAvailable(): bool
    {
        exec('command -v gs', $output, $returnCode);

        return $returnCode === 0;
    }

    private function formatBytes(int|float $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $power = floor(log($bytes, 1024));
        $power = min($power, count($units) - 1);

        return round($bytes / pow(1024, $power), 2) . ' ' . $units[$power];
    }
}
