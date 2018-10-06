<?php namespace App\Http\Helpers;

use App\Http\Models\Front\Product;
use App\Http\Models\Countries;
use App\Http\Models\Admin\Customers as Customer;
use App\Http\Models\ShippingMethod;
use Session;
/**
 * Class QD_Helper for App.
 *
 */
class QD_Helper
{
    /**
     * Handle upload and convert csv file content to PHP array
     *
     * @param  $file  File upload
     * @return Array csv array content and csv file name
     */
    public static function importCsv($file)
    {
        $destinationPath = base_path().config('ship.csv_path');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        $rows = [];
        if (($handle = fopen($destinationPath.'/'.$fileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $rows[] = $data;
            }
            fclose($handle);
        }

        return [
            'csv_content' => $rows,
            'csv_file' => $fileName,
        ];
    }

    /**
     * Convert csv content store in database to array
     *
     * @param  String $csv_content
     * @return Array
     */
    public static function outputCsv($csv_content)
    {
        $csv_arr = unserialize($csv_content);
        $table = [
            'head' => [],
            'body' => [],
        ];
        foreach ($csv_arr as $row) {
            if (trim($row[0]) == '') {
                continue;
            } else if (is_numeric($row[0])) {
                $table['body'][] = $row;
            } else {
                $table['head'][] = $row;
            }

        }

        return $table;
    }

    /**
     * Get courier charge from csv shipping by total weight
     *
     * @param  Float $weight
     * @param  String $csv_content
     * @param  Integer $state_id
     *
     * @return Float
     */
    public static function getCsvChargeByWeight($weight, $csv_content, $state_id) {
        $csv_table = self::outputCsv($csv_content);
        $row_select = [];
        foreach ($csv_table['body'] as $row) {
            if ($weight >= $row[0] && $weight <= $row[1]) {
                $row_select = $row;
                break;
            }
        }

        if (empty($row_select)) {
            return false;
        }

        if ($state_id === false) {
            return $row_select;
        }

        $col_idx_select = null;
        $states = self::getStateArrayByCoutryId();
        if (!isset($states[$state_id])) {
            return false;
        }
        foreach ($csv_table['head'] as $row_idx => $row) {
            foreach ($row as $col_idx => $col) {
                if (self::compareDestination($col, $states[$state_id]) !== false) {
                    $col_idx_select = $col_idx;
                    break;
                }
            }
        }

        if (is_null($col_idx_select)) {
            return false;
        }

        return $row_select[$col_idx_select];

    }

    /**
     * Find which destination the state belong to.
     *
     * @param  String $destination
     * @param  String $state
     * @return Mixed
     */
    public static function compareDestination($destination, $state)
    {
        if ($destination == '') {
            return false;
        }

        $states = config('ship.states');
        $is_state = false;
        foreach ($states as $value) {
            if (strpos($destination, $value) !== false) {
                $is_state = true;
                break;
            }
        }

        if ($is_state) {
            return strpos($destination, $state);
        }

        $destinations = config('ship.destinations');

        foreach ($destinations as $key => $value) {
            if (strpos($key, $destination) !== false) {
                return in_array($state, $value);
            }
        }

        return false;
    }

    /**
     * Get customer cart information
     *
     * @return Array
     */
    public static function getCartInfo()
    {
        if (!Session::has('cart')) {
            return false;
        }

        $cart = Session::get('cart');
        $total_amount = 0;
        $total_weight = 0;
        $cart_items = [];
        $categories = [];

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            $total_amount += $item['quantity']*$product->sale_price;
            $total_weight += $item['quantity']*(float)$product->weight;
            $cart_items[$product->id] = [
                'categories' => Product::getCategoriesByProduct($product->id),
                'total_weight' => $item['quantity']*(float)$product->weight,
                'price' => $product->sale_price,
            ];
            $categories = array_merge($categories, $cart_items[$product->id]['categories']);
        }

        $categories = array_unique($categories);

        return [
            'total_weight' => $total_weight,
            'total_amount' => $total_amount,
            'cart_items' => $cart_items,
            'categories' => $categories,
        ];
    }

    /**
     * Get states by country id
     *
     * @param  Integer $country_id
     * @return Array
     */
    public static function getStateArrayByCoutryId($country_id = null)
    {
        $CountryModel = new Countries();
        $states = $CountryModel->getStatesByCountry($country_id);

        $result = [];
        foreach ($states as $state) {
            $result[$state->zone_id] = $state->name;
        }

        return $result;
    }

    /**
     * Get Customer Destination Info
     *
     * @return Array
     */
    public static function getDestinationInfo()
    {
        $estimateShipping = Session::get('estimateShipping');
        $promocode = Session::get('promocode');
        $country_id = 0;
        $state_id = 0;

        if (isset($estimateShipping['country'])) {
            $country_id = $estimateShipping['country'];
            $state_id = $estimateShipping['state'];
        } elseif (Session::has('userId')) {
            $customer = Customer::find(Session::get('userId'));

            if (is_null($customer)) {
                return 0;
            }

            $country_id = $customer->shipping_country;
            $state_id = $customer->shipping_state;
        }

        if ($country_id == 0 || $state_id == 0) {
            return false;
        }

        return ['country' => $country_id, 'state' => $state_id];

    }

    /**
     * Calculate shipping charge
     *
     * @return Float
     */
    public static function calculateShippingCharge() {
        $destination = self::getDestinationInfo();
        $estimateShipping = Session::get('estimateShipping');
        if ($destination === false) {
            return 0;
        }

        $cart_info = self::getCartInfo();
        if ($cart_info === false) {
            return 0;
        }

        $ship_model = new ShippingMethod();

        if (isset($estimateShipping['shipping_method_id'])) {
            $csv_ship = $ship_model->find($estimateShipping['shipping_method_id']);

            if (is_null($csv_ship)) {
                return 0;
            }

            return self::getCsvChargeByWeight($cart_info['total_weight'], $csv_ship->csv_content, $destination['state']);
        }

        $default_ship = $ship_model->getLowestShippingCharge($cart_info['total_weight'], $cart_info['total_amount'],
                                                    $cart_info['categories'], $cart_info['cart_items'],
                                                    $destination['country'], $destination['state']);
        Session::put('default_ship', $default_ship['ship_method']);
        return $default_ship['min'];
    }

    /**
     * Check if product is a pwp product
     * @param  Array    $cart
     * @param  Integer  $product_id
     * @return boolean
     */
    public static function isValidPwp($cart, $product_id)
    {
        foreach ($cart as $key => $item) {
            if (!isset($item['pwp_product_id']) && $item['product_id'] == $product_id) {
                return true;
            }
        }

        return false;
    }
}