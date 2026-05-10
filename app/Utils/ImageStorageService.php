<?php

// David Alejandro Gutiérrez Leal

namespace App\Utils;

use App\Interfaces\ImageStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageStorageService implements ImageStorage
{
    private ?ImageGcsStorage $gcsStorage = null;

    private ImageLocalStorage $localStorage;

    public function __construct(ImageLocalStorage $localStorage)
    {
        $this->localStorage = $localStorage;
    }

    // Get a GCS instance (lazy-loaded)
    private function getGcsStorage(): ImageGcsStorage
    {
        if ($this->gcsStorage === null) {
            $this->gcsStorage = new ImageGcsStorage;
        }

        return $this->gcsStorage;
    }

    // Save image to GCS first, with fallback to local storage
    public function store(UploadedFile $image): string
    {
        try {
            $path = $this->getGcsStorage()->store($image);
            Log::info('Image stored in GCS', ['path' => $path]);

            return $path;
        } catch (\Exception $e) {
            Log::warning('GCS store failed, falling back to local storage', [
                'error' => $e->getMessage(),
            ]);

            try {
                $path = $this->localStorage->store($image);
                Log::info('Image stored locally (GCS fallback)', ['path' => $path]);

                return $path;
            } catch (\Exception $localError) {
                Log::error('Both GCS and local storage failed', [
                    'gcs_error' => $e->getMessage(),
                    'local_error' => $localError->getMessage(),
                ]);
                throw $localError;
            }
        }
    }

    // Remove GCS image first, with fallback to local storage
    public function delete(?string $imagePath): bool
    {
        if (! $imagePath || $imagePath === 'products/default.png') {
            return false;
        }

        try {
            $deleted = $this->getGcsStorage()->delete($imagePath);
            Log::info('Image deleted from GCS', ['path' => $imagePath]);

            return $deleted;
        } catch (\Exception $e) {
            Log::warning('GCS delete failed, falling back to local storage', [
                'path' => $imagePath,
                'error' => $e->getMessage(),
            ]);

            try {
                $deleted = $this->localStorage->delete($imagePath);
                Log::info('Image deleted locally (GCS fallback)', ['path' => $imagePath]);

                return $deleted;
            } catch (\Exception $localError) {
                Log::error('Both GCS and local delete failed', [
                    'path' => $imagePath,
                    'gcs_error' => $e->getMessage(),
                    'local_error' => $localError->getMessage(),
                ]);

                return false;
            }
        }
    }

    /**
     * Get public URL of the file
     * Automatically detects whether it's in GCS or local
     */
    public function getUrl(string $imagePath): string
    {
        if (file_exists(public_path('storage/'.$imagePath))) {
            return $this->localStorage->getUrl($imagePath);
        }

        if (str_starts_with($imagePath, 'products/')) {
            try {
                return $this->getGcsStorage()->getUrl($imagePath);
            } catch (\Exception $e) {
                Log::warning('Failed to get GCS URL, using local fallback', [
                    'path' => $imagePath,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $this->localStorage->getUrl($imagePath);
    }
}
