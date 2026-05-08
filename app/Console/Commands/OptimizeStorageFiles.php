<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image;

class OptimizeStorageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:optimize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize all images inside storage/app/public recursively';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');

        $optimizerChain = OptimizerChainFactory::create();

        $basePath = storage_path('app/public');

        if (!File::exists($basePath)) {
            $this->error("Directory not found: {$basePath}");
            return;
        }

        $files = File::allFiles($basePath);

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        $totalOptimized = 0;
        $totalSkipped = 0;

        foreach ($files as $file) {

            $extension = strtolower($file->getExtension());

            // Skip non-images
            if (!in_array($extension, $allowedExtensions)) {

                $this->warn("Skipped: " . $file->getRelativePathname());

                $totalSkipped++;

                continue;
            }

            try {

                $fullPath = $file->getPathname();

                $this->info("Optimizing: " . $file->getRelativePathname());

                // Resize if huge
                $image = Image::make($fullPath);

                if ($image->width() > 2000) {
                    $image->resize(2000, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    
                    $image->save($fullPath, 75);
                }

                // Extra compression
                $optimizerChain->optimize($fullPath);

                $totalOptimized++;

            } catch (\Exception $e) {

                $this->error(
                    "Failed: " .
                    $file->getRelativePathname() .
                    " => " .
                    $e->getMessage()
                );
            }
        }

        $this->newLine();

        $this->info("=================================");
        $this->info("Optimization Completed");
        $this->info("Optimized: {$totalOptimized}");
        $this->info("Skipped: {$totalSkipped}");
        $this->info("=================================");
    }
}
