<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Filters\MerchantFilter;
use App\Models\User;
use App\Sorts\MerchantSort;
use App\Transformers\MerchantTransformer;
use App\Transformers\ShipperTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowListMerchantAction extends BaseAction
{
    protected $merchantFilter;

    protected $merchantSort;

    public function __construct(MerchantFilter $merchantFilter, MerchantSort $merchantSort, Request $request)
    {
        parent::__construct();
        $this->merchantFilter = $merchantFilter;
        $this->merchantSort = $merchantSort;
        $this->q = $request->input('q');
        $this->category = $request->input('category');

    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        if($this->q === null && $this->category == null) {
            $merchant = User::where('is_merchant',1)->get();
            return $this->ok($merchant, MerchantTransformer::class);
        }

        else if ($this->category !== null) {
            $merchant = User::query()
                ->where("category", $this->category)->get();
            return $this->ok($merchant, MerchantTransformer::class);
        }
//
//        if ($this->q !== null) {
//            $merchant = DB::table('users')->where('name','LIKE','%'.$this->q.'%')
//                ->get();
//            return $this->ok($merchant, MerchantTransformer::class);
//        }
//        else {
//            $merchant = User::where([
//                ["category", $this->category],
//                ["name",'like', $this->q],
//            ])
//                ->get();
//            return $this->ok($merchant, MerchantTransformer::class);
//        }
    }
}
