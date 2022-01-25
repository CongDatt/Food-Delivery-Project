<?php

namespace App\Actions\Image;

use App\Actions\BaseAction;
use App\Models\Image;
use App\Transformers\ImageTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Aws\S3\S3ClientInterface;

class CreateImageAction extends BaseAction
{
    public function __invoke(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {
            $path = $data['image']->store('images_dat','s3');
            $image = Image::create([
                'image_url' => Storage::disk('s3')->url($path)
            ]);

            return $this->ok($image, ImageTransformer::class);
        });
    }
}
