<?php

namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB;

class CheckAvail extends Model {

    function getRoom($check_in, $check_out, $data) {
        $result = DB::table('products')
                ->join('product_room_prices as prp', function ($join) use ($check_in, $check_out) {
                    $join->on('products.id', '=', 'prp.product_id')
                    ->where('prp.status', '=', '1')
                    ->where('prp.date', '<', $check_out)
                    //->where('prp.qty_stock', '>', 0)
                    ->where('prp.date', '>=', $check_in);
                })
                ->select(
                  'products.id',
                  'products.type',
                  'products.room_code',
                  'products.bed',
                  'products.guest',
                  'products.meal',
                  'products.promo_behaviour',
                  'products.categories',
                  'products.brand_id',
                  'products.sale_price',
                  'products.list_price',
                  'products.large_image',
                  'products.thumbnail_image_1',
                  'products.thumbnail_image_2',
                  'products.colors',
                  'products.manufacturer_part_number',
                  'products.ships_in',
                  'products.is_tax',
                  'products.tags',
                  'products.is_available',
                  'products.available_since',
                  'products.in_physical_store_only',
                  'products.created',
                  'products.out_of_stock_action',
                  'products.description',
                  'products.features_and_video',
                  'products.warranty_and_support',
                  'products.return_policy',
                  'products.weight',
                  'products.free_shipping',
                  'products.shipping_cost',
                  'products.status',
                  'products.last_modified',
                  'products.createdate',
                  'products.amenities',
                  DB::raw('ROUND(SUM(COALESCE(prp.sale_price, 0)), 2) as sale_price'),
                  DB::raw('ROUND(SUM(COALESCE(prp.list_price, 0)), 2) as list_price'),
                  DB::raw('ROUND(SUM(COALESCE(prp.qty_stock, 0)), 2) as quantity_in_stock'),
                  DB::raw('ROUND(SUM(COALESCE(prp.low_level, 0)), 2) as low_level_in_stock'),
                  DB::raw('count(prp.sale_price) as dateCount'), 'prp.date as date'
                )
                ->addSelect(DB::raw('(select gst_rates.rate from gst_rates where gst_rates.status = 1 limit 0,1) as gst_rate'));

//        if (!empty($data['product_id'])) {
//            $result->where('products.id', $data['product_id']);
//        }

        if(!empty($data['adult']) && !empty($data['childrens'])){
            $guest_total = $data['adult'] + $data['childrens'];
            $result->where('products.guest', 'like','% '.$guest_total." %");
        }

        $result->where('products.status', 1)
                ->groupBy('products.id')
                ->having('sale_price', '>', 0)
                ->having('dateCount', '=', date_diff(date_create($check_in), date_create($check_out))->format('%a'));

        return $result->get();
    }

    function getPriceByDates($productId, $checkIn, $checkOut) {
        $result = DB::table('product_room_prices')
                ->where('date', '>=', $checkIn)
                ->where('date', '<', $checkOut)
                ->where('product_id', $productId)
                ->orderBy('date')
                ->get();

        return $result;
    }

}

?>
