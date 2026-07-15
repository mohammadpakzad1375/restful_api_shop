<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Market\AmazingSale;
use App\Models\Market\Product;

class AmazingSaleService
{
    public function showAllAmazingSaleDiscounts(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return AmazingSale::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createAmazingSale($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $product = Product::find($inputs['product_id']);

            if ($product->amazingSales()->active()->exists())
                return 'This action is unauthorized, exists another active amazing sale for this product.';

            return AmazingSale::create($inputs);

        });
    }

    public function showAmazingSale(AmazingSale $amazingSale): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($amazingSale){

            return  $amazingSale->load('product');

        });
    }

    public function updateAmazingSale($inputs, AmazingSale $amazingSale): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $amazingSale) {

            if (array_key_exists('end_date', $inputs) &&
                !$amazingSale->isActive() &&
                $amazingSale->product()->amazingSales()->active()->exists())
                    return 'This action is unauthorized, exists another active amazing sale for this product and can not active this amazing sale.';

                $amazingSale->update($inputs);
                return $amazingSale;


        });
    }

    public function deleteAmazingSale(AmazingSale $amazingSale): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($amazingSale){

            $amazingSale->delete();

        });
    }

    public function getMostAmazingSaleProducts()
    {
        return app(ServiceWrapper::class)(function () {

            return Product::query()
                ->select('products.*')
                ->join('amazing_sales', 'products.id', '=', 'amazing_sales.product_id')
                ->whereNowOrPast('amazing_sales.start_date')
                ->whereNowOrFuture('amazing_sales.end_date')
                ->with(['amazingSales'])
                ->orderByDesc('amazing_sales.percentage')
                ->limit(10)
                ->get();

        });
    }
}
