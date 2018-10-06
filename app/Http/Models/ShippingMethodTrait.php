<?php namespace App\Http\Models;

use Helper;

trait ShippingMethodTrait {

	public function getLowestShippingCharge($total_weight, $total_amount, $categories, $cart_items, $country_id, $state_id)
	{
		$min = false;
		$ship_method = '';
		$amount_ship = $this->getAvailableAmountShipping($total_amount, $country_id);
		if (!$amount_ship->isEmpty()) {
			$lowest = $this->getLowestCharge($amount_ship);
			$min = $lowest['min'];
			$ship_method = $lowest['ship_method'];
		}

		$weight_ship = $this->getAvailableWeightShipping($total_weight, $country_id, $state_id);
		if (!$weight_ship->isEmpty()) {
			$lowest = $this->getLowestCharge($weight_ship);
			if ($min > $lowest['min'] || $min === false) {
				$min = $lowest['min'];
				$ship_method = $lowest['ship_method'];
			}
		}

		$csv_ship = $this->getAvailableCsvShipping($total_weight, $state_id);
		if (!empty($csv_ship)) {
			$lowest = $this->getLowestCsvCharge($csv_ship);
			if ($min > $lowest['min'] || $min === false) {
				$min = $lowest['min'];
				$ship_method = $lowest['ship_method'];
			}
		}

		$cat_ship = $this->getAvailableCategoryShipping($categories, $country_id);
		if (!$cat_ship->isEmpty()) {
			$lowest = $this->getLowestCategoryCharge($cat_ship, $cart_items, $country_id, $state_id);
			if ( ($lowest['min'] !== false && $min > $lowest['min'])  || $min === false) {
				$min = $lowest['min'];
				$ship_method = $lowest['ship_method'];
			}
		}

		return [
			'min' => $min,
			'ship_method' => $ship_method,
		];
	}

	public function getAvailableCsvShipping($total_weight, $state_id)
	{
		$csv_shipping = parent::where('type', config('ship.csv'))->where('status', 1)->get();
		$result = [];
		foreach ($csv_shipping as $csv) {
			$courier_charge = Helper::getCsvChargeByWeight($total_weight, $csv->csv_content, $state_id);
			if ($courier_charge) {
				$result[] = [
					'courier_charge' => $courier_charge,
					'csv' => $csv,
				];
			}
		}

		return $result;
	}

	public function getCsvShippingByWeight($weight)
	{
		$csv_ships = $this->getAvailableCsvShipping($weight, false);
		$result = [];
		foreach ($csv_ships as $ship) {
			$csv_table = Helper::outputCsv($ship['csv']->csv_content);
			$thead = end($csv_table['head']);
			foreach ($thead as $key => $title) {
				if (strpos($title, 'From') !== false || strpos($title, 'To') !== false) {
					continue;
				}
				$result[$ship['csv']->title][] = [
					'destination' => $title,
					'charge' => $ship['courier_charge'][$key],
				];
			}
		}

		return $result;
	}

	public function getAvailableWeightShipping($total_weight, $country_id, $state_id)
	{
		return parent::where('from_weight', '<=', $total_weight)
							        ->where('to_weight', '>=', $total_weight)
							        ->where('country', $country_id)
							        ->where('state', $state_id)
							        ->where('status', 1)
							        ->where('type', config('ship.weight'))->get();
	}

	public function getAvailableAmountShipping($total_amount, $country_id)
	{
		return parent::where('from_amount', '<=', $total_amount)
							        ->where('to_amount', '>=', $total_amount)
							        ->where('country', $country_id)
							        ->where('status', 1)
							        ->where('type', config('ship.amount'))->get();
	}

	public function getAvailableCategoryShipping($categories, $country_id)
	{
		return parent::whereIn('product_cat', $categories)
							  ->where('country', $country_id)
							  ->where('status', 1)
							  ->where('type', config('ship.category'))->get();
	}

	public function getLowestCategoryCharge($cat_ship, $cart_items, $country_id, $state_id)
	{
		$min = false;
		$ship_method = '';
		$ship_extra = '';
		foreach ($cat_ship as $ship) {
			$ship_charge = $this->calculateCategoryCharge($ship, $cart_items, $country_id, $state_id);
			if ($ship_charge && ($min === false || $min > $ship_charge['amount'])) {
				$min = $ship_charge['amount'];
				$ship_method = $ship->title;
				$ship_extra = $ship_charge['ship_extra'];
			}
		}

		return [
			'min' => $min,
			'ship_method' => trim($ship_method.', '. $ship_extra, ', '),
		];
	}

	public function calculateCategoryCharge($ship, $cart_items, $country_id, $state_id)
	{
		$amount = 0;
		$shipable_items = [];
		$remain_items = [];
		foreach ($cart_items as $id => $item) {
			if (in_array($ship->product_cat, $item['categories'])) {
				$amount = ($amount == 0) ? $ship->courier_charge : $amount;
				$shipable_items[$id] = $item;
			} else {
				$remain_items[$id] = $item;
			}
		}

		$ship_extra = '';
		foreach ($remain_items as $id => $item) {
			$csv_ship = $this->getAvailableCsvShipping($item['total_weight'], $state_id);
			if (!empty($csv_ship)) {
				$lowest = $this->getLowestCsvCharge($csv_ship);
				$amount += $lowest['min'];
				$ship_extra .= $lowest['ship_method'] . ', ';
				$shipable_items[$id] = $item;
			} else {
				$csv_weight = $this->getAvailableWeightShipping($item['total_weight'], $country_id, $state_id);
				if (!$csv_weight->isEmpty()) {
					$lowest = $this->getLowestCharge($csv_weight);
					$amount += $lowest['min'];
					$ship_extra .= $lowest['ship_method'] . ', ';
					$shipable_items[$id] = $item;
				}
			}
		}

		if (count($shipable_items) < count($cart_items)) {
			return false;
		}

		return [
			'amount' => $amount,
			'ship_extra' => $ship_extra,
		];
	}

	public function getLowestCharge($ships)
	{
		$min = $ships->first()->courier_charge;
		$ship_method = $ships->first()->title;
		foreach ($ships as $ship) {
			if ($ship->courier_charge < $min) {
				$min = $ship->courier_charge;
				$ship_method = $ship->title;
			}
		}

		return [
			'min' => $min,
			'ship_method' => $ship_method,
		];
	}

	public function getLowestCsvCharge($csv_ship)
	{
		$min = $csv_ship[0]['courier_charge'];
		$ship_method = $csv_ship[0]['csv']->title;
		foreach ($csv_ship as $key => $csv) {
			if ($key == 0){
				continue;
			}

			if ($csv['courier_charge'] < $min) {
				$min = $csv['courier_charge'];
				$ship_method = $csv['csv']->title;
			}
		}

		return [
			'min' => $min,
			'ship_method' => $ship_method,
		];
	}

	public static function getById($id)
	{
		$ship = parent::find($id);

		if (is_null($ship)) {
			throw new Exception("Id Not Exists!");
		}

		return $ship;
	}

}