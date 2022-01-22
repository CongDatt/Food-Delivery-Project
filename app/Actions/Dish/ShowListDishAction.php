<?php

namespace App\Actions\Dish;

use App\Actions\BaseAction;
use App\Filters\DishFilter;
use App\Models\Dish;
use App\Sorts\DishSort;
use App\Transformers\DishTransformer;
use Illuminate\Http\JsonResponse;

class ShowListDishAction extends BaseAction
{
    protected $dishFilter;

    protected $dishSort;

    public function __construct(DishFilter $dishFilter, DishSort $dishSort)
    {
        parent::__construct();
        $this->dishFilter = $dishFilter;
        $this->dishSort = $dishSort;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $dish = Dish::query()
            ->filter($this->dishFilter)
            ->sortBy($this->dishSort)
            ->paginate($this->per_page);

        return $this->ok($dish, DishTransformer::class);
    }
}
