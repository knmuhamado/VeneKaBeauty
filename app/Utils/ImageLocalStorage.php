<?php

// David Alejandro Gutiérrez Leal

namespace App\Utils;

use App\Interfaces\ImageStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageLocalStorage implements ImageStorage
{
    public function store(UploadedFile $image): string
    {
        return $image->store('products', 'public');
    }

    public function delete(?string $imagePath): bool
    {
        if (! $imagePath || $imagePath === 'products/default.png') {
            return false;
        }

        return Storage::disk('public')->delete($imagePath);
    }
}
