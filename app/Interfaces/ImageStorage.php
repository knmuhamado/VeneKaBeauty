<?php

// David Alejandro Gutiérrez Leal

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface ImageStorage
{
    public function store(UploadedFile $image): string;

    public function delete(?string $imagePath): bool;
}
