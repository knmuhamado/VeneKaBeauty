<?php

// David Alejandro Gutiérrez Leal

namespace App\Utils;

use App\Interfaces\ImageStorage;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ImageGcsStorage implements ImageStorage
{
    private StorageClient $storage;

    private string $bucket;

    private const FOLDER = 'products';

    public function __construct()
    {
        $keyFileConfig = config('services.gcs.key_file');

        if (str_starts_with($keyFileConfig, 'storage/')) {
            $keyFileConfig = substr($keyFileConfig, 8); // Remover "storage/"
        }

        // Convert to absolute path using storage_path()
        $keyFile = str_starts_with($keyFileConfig, '/')
            ? $keyFileConfig
            : storage_path($keyFileConfig);

        if (! $keyFile || ! file_exists($keyFile)) {
            Log::warning('GCS credentials file not found', ['configured' => config('services.gcs.key_file'), 'resolved' => $keyFile]);
            throw new \Exception('GCS credentials file not found at: '.$keyFile);
        }

        try {
            $this->storage = new StorageClient([
                'projectId' => config('services.gcs.project_id'),
                'keyFilePath' => $keyFile,
            ]);
            $this->bucket = config('services.gcs.bucket');
            Log::info('GCS initialized successfully', ['bucket' => $this->bucket, 'keyFile' => $keyFile]);
        } catch (\Exception $e) {
            Log::error('GCS initialization failed', ['error' => $e->getMessage(), 'file' => $keyFile]);
            throw $e;
        }
    }

    public function store(UploadedFile $image): string
    {
        try {
            $bucket = $this->storage->bucket($this->bucket);

            $filename = self::FOLDER.'/'.uniqid().'.'.$image->getClientOriginalExtension();

            $bucket->upload(
                fopen($image->getRealPath(), 'r'),
                [
                    'name' => $filename,
                    'metadata' => [
                        'contentType' => $image->getMimeType(),
                    ],
                ]
            );

            return $filename;
        } catch (\Exception $e) {
            Log::error('GCS store operation failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function delete(?string $imagePath): bool
    {
        if (! $imagePath || $imagePath === 'products/default.png') {
            return false;
        }

        try {
            $bucket = $this->storage->bucket($this->bucket);
            $object = $bucket->object($imagePath);
            $object->delete();

            return true;
        } catch (\Exception $e) {
            Log::error('GCS delete operation failed', ['path' => $imagePath, 'error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function getUrl(string $imagePath): string
    {
        $bucket = $this->storage->bucket($this->bucket);
        $object = $bucket->object($imagePath);

        return $object->signedUrl(new \DateTimeImmutable('+1 day'));
    }
}
