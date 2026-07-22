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
        $privateKey = (string) config('services.imagekit.private_key');
        $uploadUrl = (string) config('services.imagekit.upload_url', 'https://upload.imagekit.io/api/v1/files/upload');

        if (empty($privateKey)) {
            Log::error('ImageKit Upload Error: Private key (PRIVATE_KEY) is not configured in environment or services configuration.');
            return null;
        }

        try {
            $contents = file_get_contents($file->getRealPath());
            if ($contents === false) {
                Log::error('ImageKit Upload Error: Failed to read uploaded file contents.');
                return null;
            }

            $response = Http::withBasicAuth($privateKey, '')
                ->attach('file', $contents, $fileName)
                ->post($uploadUrl, [
                    'fileName' => $fileName,
                ]);

            if ($response->successful()) {
                return $response->json()['url'];
            }

            Log::error('ImageKit upload failed: Status Code: ' . $response->status() . ' - Response: ' . $response->body());
            return null;
        } catch (\Throwable $e) {
            Log::error('ImageKit upload exception: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return null;
        }
    }
}
