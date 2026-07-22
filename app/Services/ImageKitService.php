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
            return ['success' => false, 'error' => 'الملف المرفوع غير موجود أو غير صالح.'];
        }

        $fileName = time() . '_' . $file->getClientOriginalName();
        $privateKey = (string) config('services.imagekit.private_key');
        $uploadUrl = (string) config('services.imagekit.upload_url', 'https://upload.imagekit.io/api/v1/files/upload');

        if (empty($privateKey)) {
            return [
                'success' => false,
                'error' => 'لم يتم إعداد المفتاح السري (PRIVATE_KEY) في خادم الاستضافة.'
            ];
        }

        try {
            $contents = file_get_contents($file->getRealPath());
            if ($contents === false) {
                return ['success' => false, 'error' => 'فشل قراءة محتوى الملف المرفوع.'];
            }

            $response = Http::withBasicAuth($privateKey, '')
                ->attach('file', $contents, $fileName)
                ->post($uploadUrl, [
                    'fileName' => $fileName,
                ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'url' => $response->json()['url']
                ];
            }

            $errBody = $response->body();
            $decoded = json_decode($errBody, true);
            $msg = $decoded['message'] ?? $errBody;

            return [
                'success' => false,
                'error' => 'استجابة ImageKit (' . $response->status() . '): ' . $msg
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => 'حدث استثناء برميجي: ' . $e->getMessage()
            ];
        }
    }
}
