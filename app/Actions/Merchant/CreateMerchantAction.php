<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Models\Merchant;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Aws\S3\S3ClientInterface;
use Illuminate\Support\Arr;

class CreateMerchantAction extends BaseAction
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function __invoke(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {
            $path = $data['image']->store('images_dat','s3');
            $merchant = Merchant::create(Arr::except($data, 'image'));
            $merchant->image = Storage::disk('s3')->url($path);

            return $this->ok($merchant, MerchantTransformer::class);
        });
    }
}
