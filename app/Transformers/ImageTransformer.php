<?php

namespace App\Transformers;

use App\Models\Image;
use Flugg\Responder\Transformers\Transformer;

class ImageTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Image $image
     * @return array
     */
    public function transform(Image $image)
    {
        return [
            'id' => (string) $image->id,
            'image_url' => (string) $image->image_url
        ];
    }
}
