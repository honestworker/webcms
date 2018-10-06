<?php
namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class RoomPrice extends Model
{
	/**
     * Add room prices in bulk.
     *
     * @param int   $productId Product identifier.
	 * @param array $prices    Array of price objects.
	 *
     * @return void
     */
	function addRoomPrices($productId, $prices)
	{
		// echo '<pre>';
		// print_r($prices);
		// exit;
		foreach($prices as $price) {
			$price->product_id = $productId;
			if (!$price->status) {
				if(empty($price->sale_price)) {
					$price->sale_price = '0.00';
				}
				if(empty($price->list_price)) {
					$price->list_price = '0.00';
				}
				if(empty($price->qty_stock)) {
					$price->qty_stock = '0.00';
				}
				if(empty($price->low_level)) {
					$price->low_level = '0.00';
				}
			} else {
				if(empty($price->restriction_text)) {
					$price->restriction_text = '';
				}
			}

			$existingPrice = DB::table('product_room_prices')
				->where('date', '=', $price->date)
				->where('product_id', '=', $productId)
				->first();

			if($existingPrice) {
				$price->updated_at = date('Y-m-d H:i:s');
				$this->updateRoomPrice($existingPrice->id, $price);
			} else {
				$price->created_at = date('Y-m-d H:i:s');
				$this->addRoomPrice((array)$price);
			}
		}

		return;
	}

	/**
     * Add room prices in bulk.
     *
     * @param array $priceData Price data to be inserted.
	 *
     * @return int $id Identifier of last inserted record.
     */
	function addRoomPrice($priceData)
	{
		DB::table('product_room_prices')->insert($priceData);

		return DB::getPdo()->lastInsertId();
	}

	/**
     * Update room price.
     *
	 * @param array $id Identifier.
     * @param array $price Price object to be updated.
	 *
     * @return int $id Identifier of last inserted record.
     */
	function updateRoomPrice($id, $price)
	{
		DB::table('product_room_prices')
			->where('id', $id)
            ->update([
				'status' => $price->status,
				'sale_price' => $price->sale_price,
				'list_price' => $price->list_price,
				'qty_stock' => $price->qty_stock,
				'low_level' => $price->low_level,
				'restriction_text' => $price->restriction_text
			]);

		return DB::getPdo()->lastInsertId();
	}
}
