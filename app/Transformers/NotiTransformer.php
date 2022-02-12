<?php

namespace App\Transformers;

use App\Models\Noti;
use Flugg\Responder\Transformers\Transformer;

class NotiTransformer extends Transformer
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
     * @param  \App\Models\Noti $noti
     * @return array
     */
    public function transform(Noti $noti)
    {
        return [
            'id' => (int) $noti->id,
            'user_id' => (int) $noti->user_id,
            'status' => (int) $noti->status,
            'title' => (string) $noti->title,
            'message' => (string) $noti->message,
        ];
    }
}
