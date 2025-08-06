<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function upload(UploadedFile $file, $folder = 'attachments')
    {
        $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'docx'];
        if (!in_array($file->extension(), $allowed)) {
            throw new \Exception('Dosya türü desteklenmiyor!');
        }
        if ($file->getSize() > 5 * 1024 * 1024) {
            throw new \Exception('Dosya çok büyük!');
        }
        $path = $file->store($folder, 'public');
        return $path;
    }
}
