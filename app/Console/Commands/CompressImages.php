<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CompressImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:compress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compress all uploaded images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $optimizerChain = OptimizerChainFactory::create();

        $path = public_path('uploads');

        $images = collect(
            \File::allFiles($path)
        )->filter(function ($file) {
            return in_array(strtolower($file->getExtension()), [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ]);
        });

        foreach ($images as $image) {

            $this->info("Compressing: " . $image->getFilename());

            $optimizerChain->optimize($image->getPathname());
        }

        $this->info('All images compressed successfully.');
    }
}
