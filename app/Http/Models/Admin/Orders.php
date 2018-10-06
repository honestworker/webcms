<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
//use Hash;
use App\Http\Models\ShippingMethod;
use Helper;

class Orders extends Model {

    public function getOrder($order_id) {
        $orders = DB::table('orders as o');
        $orders->select('o.*', 'sb.name as billing_state_name', 'cb.name as billing_country_name', 'ss.name as shipping_state_name', 'cs.name as shipping_country_name');

        $orders->leftjoin('states as sb', 'sb.zone_id', '=', 'o.billing_state');
        $orders->leftjoin('countries as cb', 'cb.country_id', '=', 'o.billing_country');

        $orders->leftjoin('states as ss', 'ss.zone_id', '=', 'o.shipping_state');
        $orders->leftjoin('countries as cs', 'cs.country_id', '=', 'o.shipping_country');

        $orders->where('id', '=', $order_id);

        return $orders->first();
    }

    // Get order with its product items and GST calculation
    public function getOrderTax($order_id) {
        $order = $this->getOrder($order_id);
        $checkDate = DB::table('room_booked_date')->where('order_id', $order_id)->first();
        $otp = $this->getOrderToProductTax($order_id);
        $order->products = $otp;

        // Add GST calculation
        $subtotal = $total = $tax = $shipping = $items = 0;
        foreach ($otp as $product) {
            $subtotal += $product->subtotal;
            $tax += $product->tax;
            $shipping += $product->shipping_amount;
            $total += $product->amount + $product->gst;
            $items += $product->quantity;
        }
        $order->subtotal = $subtotal;
        $order->tax = $tax;
        $order->shipping = $shipping;
        $order->total = $total;
        $order->items = $items;
        $order->check_date = $checkDate;

        return $order;
//dd($order, $otp);
    }

    // Get order with its product items and GST calculation
    public function getOrderToProductTax($order_id) {
        $orderToProduct = DB::table('order_to_product as otp');
        $orderToProduct->select('otp.*', 'p.*', 'c.title as color_name', 'se.event_type', 'se.token');
        $orderToProduct->leftjoin('colors as c', 'c.id', '=', 'otp.color_id');
        $orderToProduct->leftjoin('products as p', 'p.id', '=', 'otp.product_id');
        $orderToProduct->leftjoin('special_events as se', 'se.id', '=', 'otp.special_event_id');
        $orderToProduct->where('otp.order_id', $order_id);
        $otp = $orderToProduct->get();

        // Add GST calculation
        foreach ($otp as $product) {
            //check if pwp product
            $product->subtotal = is_null($product->pwp_price) ? /* $product->quantity * */ $product->amount : /* $product->quantity * */ $product->pwp_price;
            if ($product->is_tax) {
                $product->tax = round($product->subtotal * 0.06, 2);
            } else {
                $product->tax = 0;
            }

            $product->total = $product->subtotal + $product->tax + $product->shipping_amount - $product->global_discount;
        }

        return $otp;
    }

    public function getOrders($limit, $page, $data) {
        $orders = DB::table('orders as o');
        $id_or = DB::table('room_booked_date');

        if ((isset($data['check_from']) && trim($data['check_from']) != '')) {

            $id_or->where('date_checkin', '>=', date('Y-m-d', strtotime($data['check_from'])));
        }

        if (isset($data['check_to']) && trim($data['check_to']) != '') {

            $id_or->where('date_checkin', '<', date('Y-m-d', strtotime($data['check_to'])));
        }

        if ((isset($data['check_from']) && trim($data['check_from']) != '') || (isset($data['check_to']) && trim($data['check_to']) != '')) {
            $key = 0;
            $_or = $id_or->get();
            $idor = array();
            if (sizeof($id_or) > 0)
                foreach ($_or as $key => $value) {
                    $idor[$key] = $value->order_id;
                }

            //$idor[$key]=$data['order_id'];
            $orders->whereIn('o.id', $idor);
        }


        if (isset($data['order_id']) && trim($data['order_id']) != '') {
            $orders->where('o.id', '=', $data['order_id']);
        }


        if (isset($data['promocode_id']) && trim($data['promocode_id']) != '') {
            $orders->where('promocode_id', '=', $data['promocode_id']);
        }

        if (isset($data['order_from']) && trim($data['order_from']) != '') {
            $orders->where('createdate', '>=', date('Y-m-d 00:00:00', strtotime($data['order_from'])));
        }

        if (isset($data['order_to']) && trim($data['order_to']) != '') {
            $orders->where('createdate', '<=', date('Y-m-d 23:59:59', strtotime($data['order_to'])));
        }

        if (isset($data['customer_name']) && trim($data['customer_name']) != '') {
            $orders->where('billing_first_name', 'LIKE', $data['customer_name']);
        }

        if (isset($data['status']) && trim($data['status']) != '') {
            $orders->where('status', '=', $data['status']);
        }

        if (isset($data['payment_status']) && trim($data['payment_status']) != '') {
            $orders->where('payment_status', '=', $data['payment_status']);
        }

        if (isset($data['isShipment']) && $data['isShipment']) {
            $orders->whereIn('status', ['Ready To Ship', 'Shipped']);
        }

        if (isset($data['shipment_from']) && trim($data['shipment_from']) != '') {
            $orders->where('shipment_date', '>=', date('Y-m-d 00:00:00', strtotime($data['shipment_from'])));
        }

        if (isset($data['shipment_to']) && trim($data['shipment_to']) != '') {
            $orders->where('shipment_date', '<=', date('Y-m-d 23:59:59', strtotime($data['shipment_to'])));
        }

        //Sorting Start
        $sort = 'DESC';
        $sort_by = 'createdate';

        if (isset($data['sort']) && $data['sort'] == 'ASC') {
            $sort = $data['sort'];
        }

        if (isset($data['sort_by']) && in_array($data['sort_by'], array('id', 'order_id', 'shipment_date', 'createdate', 'email', 'name', 'totalPrice', 'status', 'payment_status'))) {
            $sort_by = $data['sort_by'];
        }

        if ($sort_by == 'name') {
            $orders->orderBy('billing_first_name', $sort);
            $orders->orderBy('billing_last_name', $sort);
        } else {
            $orders->orderBy($sort_by, $sort);
        }
        //Sorting End
        //dd($data['customer_name']);
        return $orders->paginate($limit);
    }

    public function get_paginate_msg($limit, $page, $data) {
        $page = ($page ? ($page - 1) * $limit : 0);

        //First query
        $orders = DB::table('orders')->select('id');

        if (isset($data['order_id']) && trim($data['order_id']) != '') {
            $orders->where('order_id', '=', $data['order_id']);
        }

        if (isset($data['promocode_id']) && trim($data['promocode_id']) != '') {
            $orders->where('promocode_id', '=', $data['promocode_id']);
        }

        if (isset($data['order_from']) && trim($data['order_from']) != '') {
            $orders->where('createdate', '>=', date('Y-m-d 00:00:00', strtotime($data['order_from'])));
        }

        if (isset($data['order_to']) && trim($data['order_to']) != '') {
            $orders->where('createdate', '<=', date('Y-m-d 23:59:59', strtotime($data['order_to'])));
        }

        if (isset($data['customer_name']) && trim($data['customer_name']) != '') {
            $orders->where('billing_first_name', 'LIKE', "'%" . $data['customer_name '] . "%'");
        }


        if (isset($data['status']) && trim($data['status']) != '') {
            $orders->where('status', '=', $data['status']);
        }

        if (isset($data['payment_status']) && trim($data['payment_status']) != '') {
            $orders->where('payment_status', '=', $data['payment_status']);
        }

        if (isset($data['isShipment']) && $data['isShipment']) {
            $orders->whereIn('status', ['Ready To Ship', 'Shipped']);
        }

        if (isset($data['shipment_from']) && trim($data['shipment_from']) != '') {
            $orders->where('shipment_date', '>=', date('Y-m-d 00:00:00', strtotime($data['shipment_from'])));
        }

        if (isset($data['shipment_to']) && trim($data['shipment_to']) != '') {
            $orders->where('shipment_date', '<=', date('Y-m-d 23:59:59', strtotime($data['shipment_to'])));
        }

        $results = $orders->skip($page)->take($limit)->get();

        //Second query
        $orders = DB::table('orders');

        if (isset($data['order_id']) && trim($data['order_id']) != '') {
            $orders->where('order_id', '=', $data['order_id']);
        }

        if (isset($data['promocode_id']) && trim($data['promocode_id']) != '') {
            $orders->where('promocode_id', '=', $data['promocode_id']);
        }

        if (isset($data['order_from']) && trim($data['order_from']) != '') {
            $orders->where('createdate', '>=', date('Y-m-d 00:00:00', strtotime($data['order_from'])));
        }

        if (isset($data['order_to']) && trim($data['order_to']) != '') {
            $orders->where('createdate', '<=', date('Y-m-d 23:59:59', strtotime($data['order_to'])));
        }

        if (isset($data['customer_name']) && trim($data['customer_name']) != '') {
            $orders->where('billing_first_name', 'LIKE', "'%" . $data['customer_name '] . "%'");
        }

        if (isset($data['status']) && trim($data['status']) != '') {
            $orders->where('status', '=', $data['status']);
        }

        if (isset($data['payment_status']) && trim($data['payment_status']) != '') {
            $orders->where('payment_status', '=', $data['payment_status']);
        }

        if (isset($data['isShipment']) && $data['isShipment']) {
            $orders->whereIn('status', ['Ready To Ship', 'Shipped']);
        }

        if (isset($data['shipment_from']) && trim($data['shipment_from']) != '') {
            $orders->where('shipment_date', '>=', date('Y-m-d 00:00:00', strtotime($data['shipment_from'])));
        }

        if (isset($data['shipment_to']) && trim($data['shipment_to']) != '') {
            $orders->where('shipment_date', '<=', date('Y-m-d 23:59:59', strtotime($data['shipment_to'])));
        }

        $count = $orders->count();

        if ($results) {
            $message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
        } else {
            $message = 'Showing 0 to 0 of ' . $count . ' entries';
        }

        return $message;
    }

    public function getTotalOrderByStatus($status) {
        return DB::table('orders')->where('status', '=', $status)->count();
    }

    public function getLastUpdated() {
        $modifydate = DB::table('orders')->select('modifydate')->orderBy('modifydate', 'DESC')->take(1)->first();
        if ($modifydate) {
            return date('d M, Y @ h:i A', strtotime($modifydate->modifydate));
        } else {
            return false;
        }
    }

    public function deleteOrder($order_id) {
        DB::table('orders')->where('id', '=', $order_id)->delete();
        DB::table('order_to_product')->where('order_id', '=', $order_id)->delete();
    }

    public function getOrderToProduct($order_id) {
        $orderToProduct = DB::table('order_to_product as otp');
        $orderToProduct->leftjoin('colors as c', 'c.id', '=', 'otp.color_id');
        $orderToProduct->leftjoin('products as p', 'p.id', '=', 'otp.product_id');
        $orderToProduct->leftjoin('special_events as se', 'se.id', '=', 'otp.special_event_id');
        $orderToProduct->select('otp.*', 'p.type', 'p.room_code', 'p.thumbnail_image_1', 'p.thumbnail_image_2', 'c.title as color_name', 'se.event_type', 'se.token');
        $orderToProduct->where('otp.order_id', $order_id);

        return $orderToProduct->get();
//dd($orderToProduct->get());
    }

    public function getCustomer($customer_id) {
        //return DB::table('customers')->where('id', '=', $customer_id)->first();

        $customer = DB::table('customers as c');
        $customer->select('c.*', 'sb.name as billing_state_name', 'cb.name as billing_country_name', 'ss.name as shipping_state_name', 'cs.name as shipping_country_name');

        $customer->leftjoin('states as sb', 'sb.zone_id', '=', 'c.billing_state');
        $customer->leftjoin('countries as cb', 'cb.country_id', '=', 'c.billing_country');

        $customer->leftjoin('states as ss', 'ss.zone_id', '=', 'c.shipping_state');
        $customer->leftjoin('countries as cs', 'cs.country_id', '=', 'c.shipping_country');

        $customer->where('id', '=', $customer_id);

        return $customer->first();
    }

    public function getCustomerTotalOrders($customer_id) {
        return DB::table('orders')->select('id')->where('customer_id', '=', $customer_id)->count();
    }

    public function getTotalOrderItems($order_id) {
        return DB::table('order_to_product')->where('order_id', '=', $order_id)->sum('quantity');
    }

    public function saveBillingAddress($id, $data) {
        $update = [
            'billing_first_name' => $data['billing_first_name'],
            'billing_last_name' => $data['billing_last_name'],
            'billing_email' => $data['billing_email'],
            'billing_telephone' => $data['billing_telephone'],
            'billing_address' => $data['billing_address'],
            'modifydate' => date('Y-m-d H:i:s')
        ];

        DB::table('orders')->where('id', $id)->update($update);
    }

    public function saveShippingAddress($id, $data) {
        $update = [
            'shipping_first_name' => $data['shipping_first_name'],
            'shipping_last_name' => $data['shipping_last_name'],
            'shipping_email' => $data['shipping_email'],
            'shipping_telephone' => $data['shipping_telephone'],
            'shipping_address' => $data['shipping_address'],
            'modifydate' => date('Y-m-d H:i:s')
        ];

        DB::table('orders')->where('id', $id)->update($update);
    }

    public function updateOrderStatus($id, $status) {
        $update = [
            'status' => $status,
            'modifydate' => date('Y-m-d H:i:s')
        ];

        if ($status == 'Shipped') {
            $update['shipment_date'] = date('Y-m-d H:i:s');
            $update['delivery_date'] = '';
        }

        if ($status == 'Completed') {
            $update['delivery_date'] = date('Y-m-d H:i:s');
        }

        DB::table('orders')->where('id', $id)->update($update);

        if ($status == 'Cancelled' || $status == 'Declined') {
            $orders = DB::table('order_to_product as otp');
            $orders->select('otp.*', 'p.quantity_in_stock');
            $orders->leftjoin('products as p', 'p.id', '=', 'otp.product_id');
            $orders->where('otp.order_id', '=', $id);

            $products = $orders->get();

            foreach ($products as $product) {
                $update = [
                    'quantity_in_stock' => ($product->quantity_in_stock + $product->quantity),
                    'last_modified' => date('Y-m-d H:i:s')
                ];

                DB::table('products')->where('id', $product->product_id)->update($update);
            }
        }
    }

    public function updatePaymentStatus($id, $status) {
        $update = [
            'payment_status' => $status,
            'modifydate' => date('Y-m-d H:i:s')
        ];
        DB::table('orders')->where('id', $id)->update($update);
    }

    public function addNewShipment($id, $data) {
        $update = [
            'tracking_number' => $data['tracking_number'],
            'comments' => $data['comments'],
            'modifydate' => date('Y-m-d H:i:s'),
            'shipment_date' => date('Y-m-d'),
        ];
        $ship = ShippingMethod::find($data['shipping_method']);
        if (!is_null($ship)) {
            $update['shipping_method'] = $ship->title;
            $update['shipping_charge'] = Helper::getCsvChargeByWeight($data['total_weight'], $ship->csv_content, $data['shipping_state']);
        }

        if ($data['shipping_method'] == 0) {
            $update['shipping_method'] = 'Self Collection';
            $update['shipping_charge'] = 0;
        }

        DB::table('orders')->where('id', $id)->update($update);

        if ($data['status'] != '') {
            $this->updateOrderStatus($id, $data['status']);
        }
    }

    public function updateNotes($id, $data) {
        $update = [
            'customer_notes' => $data['customer_notes'],
            'staff_notes' => $data['staff_notes'],
            'modifydate' => date('Y-m-d H:i:s')
        ];
        DB::table('orders')->where('id', $id)->update($update);
    }

    public function customer() {
        return $this->belongsTo('App\Http\Models\Admin\Customers', 'customer_id');
    }

}
