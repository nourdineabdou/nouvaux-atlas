<?php

namespace App\Console\Commands;

use App\Models\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SyncImages extends Command
{
    protected $signature = 'images:sync';
    protected $description = 'Import image files found on disk (public/assets/images/{section}) that are missing from the images table';

    protected $sections = ['blog', 'security', 'cleaning', 'companies', 'business'];

    public function handle(): int
    {
        $imported = 0;

        foreach ($this->sections as $section) {
            $dir = public_path('assets/images/' . $section);
            if (!is_dir($dir)) {
                continue;
            }

            foreach (File::files($dir) as $file) {
                $ext = strtolower($file->getExtension());
                if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'svg'])) {
                    continue;
                }

                $relativePath = 'assets/images/' . $section . '/' . $file->getFilename();

                if (Image::where('path', $relativePath)->exists()) {
                    continue;
                }

                Image::create([
                    'section' => $section,
                    'filename' => $file->getFilename(),
                    'original_name' => $file->getFilename(),
                    'mime' => File::mimeType($file->getPathname()) ?: null,
                    'size' => $file->getSize(),
                    'path' => $relativePath,
                ]);

                $imported++;
                $this->line("Imported {$relativePath}");
            }
        }

        $this->info("Done. Imported {$imported} image(s).");

        return self::SUCCESS;
    }
}
