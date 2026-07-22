<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImageKitService
{
    /**
     * Upload an image to ImageKit.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string|null
     */
    public static function upload($file)
    {
        if (!$file) {
            return null;
        }

        $fileName = time() . '_' . $file->getClientOriginalName();
        $privateKey = config('services.imagekit.private_key');
        $uploadUrl = config('services.imagekit.upload_url', 'https://upload.imagekit.io/api/v1/files/upload');

        try {
            $fileStream = fopen($file->getRealPath(), 'r');

            $response = Http::withBasicAuth($privateKey, '')
                ->attach('file', $fileStream, $fileName)
                ->post($uploadUrl, [
                    'fileName' => $fileName,
                ]);

            if ($response->successful()) {
                return $response->json()['url'];
            }

            Log::error('ImageKit upload failed: Status Code: ' . $response->status() . ' - Response: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('ImageKit upload exception: ' . $e->getMessage());
            return null;
        }
    }
}
