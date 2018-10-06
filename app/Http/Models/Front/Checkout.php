<?php

namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB;
// Start Here for orderPlacement Function Dev:Indra
use Session;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderToProduct;
use App\Models\RoomBookedDate;
use App\Models\Product as myProduct;
use App\Http\Models\Countries;
use Mail;

// End Here Added for orderPlacement Function

class Checkout extends Model {

    public function addOrder($data) {
        echo "<pre>";
        print_r($data);
        die;
        $insert = [
            'customer_id' => $data['customer_id'],
            'billing_first_name' => $data['billing_first_name'],
            'billing_last_name' => $data['billing_last_name'],
            'billing_email' => $data['billing_email'],
            'billing_telephone' => $data['billing_telephone'],
            'billing_country' => $data['billing_country'],
            'billing_state' => $data['billing_state'],
            'billing_address' => $data['billing_address'],
            'billing_city' => $data['billing_city'],
            'billing_post_code' => $data['billing_post_code'],
            'shipping_first_name' => $data['shipping_first_name'],
            'shipping_last_name' => $data['shipping_last_name'],
            'shipping_email' => $data['shipping_email'],
            'shipping_telephone' => $data['shipping_telephone'],
            'shipping_country' => $data['shipping_country'],
            'shipping_state' => $data['shipping_state'],
            'shipping_address' => $data['shipping_address'],
            'shipping_city' => $data['shipping_city'],
            'shipping_post_code' => $data['shipping_post_code'],
            'shipping_method' => $data['shipping_method'],
            'shipping_charge' => $data['shipping_charge'],
            'total_weight' => $data['total_weight'],
            'shipping_estimate_country' => $data['shipping_estimate_country'],
            'shipping_estimate_state' => $data['shipping_estimate_state'],
            'totalPrice' => $data['totalPrice'],
            'discount' => $data['discount'],
            'promocode_id' => $data['promocode_id'],
            'payment_method' => $data['payment_method'],
            'payment_status' => 'Processing',
            'status' => 'Processing',
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'modifydate' => date('Y-m-d H:i:s'),
            'createdate' => date('Y-m-d H:i:s'),
        ];

        DB::table('orders')->insert($insert);
        $orderId = DB::getPdo()->lastInsertId();

        $order_id = 'TBM' . sprintf('%05d', $orderId);
        DB::table('orders')->where('id', $orderId)->update(['order_id' => $order_id]);

        foreach ($data['products'] as $products) {
            //Insert into order to product table
            $insert = [
                'order_id' => $orderId,
                'product_id' => $products['product_id'],
                'quantity' => $products['quantity'],
                'color_id' => ($products['color_id'] ? $products['color_id'] : ''),
                'special_event_id' => $products['special_event_id'],
                'amount' => $products['amount'],
                'shipping_amount' => $products['shipping_amount'],
                'global_discount' => $products['global_discount'],
                'quantity_discount' => $products['quantity_discount'],
                'promo_code_discount' => $products['promo_code_discount'],
                'pwp_price' => isset($products['pwp_price']) ? $products['pwp_price'] : NULL,
            ];

            DB::table('order_to_product')->insert($insert);

            //update product quantity
            DB::update("update products set quantity_in_stock = (quantity_in_stock - " . $products['quantity'] . "), last_modified = '" . date('Y-m-d H:i:s') . "' where id = ?", [$products['product_id']]);
        }

        return $orderId;
    }

    public function updateOrderByRefNo($refno, $data) {
        $data['modifydate'] = date('Y-m-d H:i:s');
        DB::table('orders')->where('order_id', $refno)->update($data);
    }

    public function getOrder($orderId) {
        $orders = DB::table('orders as o');
        $orders->select('o.*', 'sb.name as billing_state_name', 'cb.name as billing_country_name', 'ss.name as shipping_state_name', 'cs.name as shipping_country_name');

        $orders->leftjoin('states as sb', 'sb.zone_id', '=', 'o.billing_state');
        $orders->leftjoin('countries as cb', 'cb.country_id', '=', 'o.billing_country');

        $orders->leftjoin('states as ss', 'ss.zone_id', '=', 'o.shipping_state');
        $orders->leftjoin('countries as cs', 'cs.country_id', '=', 'o.shipping_country');

        $orders->where('id', '=', $orderId);

        return $orders->first();
    }

    public function getOrderByRefNo($refno) {
        $orders = DB::table('orders as o');
        $orders->select('o.*', 'sb.name as billing_state_name', 'cb.name as billing_country_name', 'ss.name as shipping_state_name', 'cs.name as shipping_country_name');

        $orders->leftjoin('states as sb', 'sb.zone_id', '=', 'o.billing_state');
        $orders->leftjoin('countries as cb', 'cb.country_id', '=', 'o.billing_country');

        $orders->leftjoin('states as ss', 'ss.zone_id', '=', 'o.shipping_state');
        $orders->leftjoin('countries as cs', 'cs.country_id', '=', 'o.shipping_country');

        $orders->where('order_id', '=', $refno);

        return $orders->first();
    }

    public function getOrderToProduct($order_id) {
        $orderToProduct = DB::table('order_to_product as otp');
        $orderToProduct->select('otp.*', 'p.product_name', 'p.product_code', 'p.thumbnail_image_1', 'p.thumbnail_image_2', 'c.title as color_name', 'se.event_type', 'se.token');
        $orderToProduct->leftjoin('colors as c', 'c.id', '=', 'otp.color_id');
        $orderToProduct->leftjoin('products as p', 'p.id', '=', 'otp.product_id');
        $orderToProduct->leftjoin('special_events as se', 'se.id', '=', 'otp.special_event_id');
        $orderToProduct->where('otp.order_id', $order_id);

        return $orderToProduct->get();
    }

    public function updateCustomer($customer_id, $data) {
        $update = [
            'billing_first_name' => $data['billing_first_name'],
            'billing_last_name' => $data['billing_last_name'],
            'billing_email' => $data['billing_email'],
            'billing_telephone' => $data['billing_telephone'],
            'billing_country' => $data['billing_country'],
            'billing_state' => $data['billing_state'],
            'billing_address' => $data['billing_address'],
            'billing_city' => $data['billing_city'],
            'billing_post_code' => $data['billing_post_code'],
            'shipping_first_name' => $data['shipping_first_name'],
            'shipping_last_name' => $data['shipping_last_name'],
            'shipping_email' => $data['shipping_email'],
            'shipping_telephone' => $data['shipping_telephone'],
            'shipping_country' => $data['shipping_country'],
            'shipping_state' => $data['shipping_state'],
            'shipping_address' => $data['shipping_address'],
            'shipping_city' => $data['shipping_city'],
            'shipping_post_code' => $data['shipping_post_code'],
            'modifydate' => date('Y-m-d H:i:s'),
        ];

        DB::table('customers')->where('id', $customer_id)->update($update);
    }

    public function getPromoCodes($promo_code) {
        $result = DB::table('promocodes');

        $result->where('promo_code', $promo_code);

        $result->where('start_date', '<=', date('Y-m-d'));
        $result->where('end_date', '>=', date('Y-m-d'));

        $result->where('status', '=', '1');

        $promocode = $result->first();

        if ($promocode) {
            $count = DB::table('orders')->select('id')->where('promocode_id', '=', $promocode->id)->count();

            if ($count < $promocode->times_to_use) {
                $results = DB::table('promocodes_to_product')->select('product_id')->where('promocode_id', '=', $promocode->id)->get();
                $productApply = array();

                foreach ($results as $result) {
                    $productApply[] = $result->product_id;
                }

                return array(
                    'promocode' => $promocode,
                    'products' => $productApply
                );
            } else {
                return array('warning' => 'Promo code expired!');
            }
        } else {
            return array('warning' => 'Invalid promo code!');
        }
    }

    /**
     *
     * Transfered this function from CheckoutController.
     * Dev: Indra
     * */
    public function orderPlacement($payment, $payment_id) {
        $gst_rate_data = DB::table('gst_rates')->where('status', "1")->first();
        $gst_rate = 6;
        if (isset($gst_rate_data)) {
            $gst_rate = $gst_rate_data->rate;
        }
        $cart = Session::get('cart');

        $PM = new Product();
        $promo = ($cart['promocode_id']) ? $PM->getDiscount(Session::get('_token'), $cart['product'][0]['product_id']) : '';

        $user_id = Session::get('userId');
        $customerArr = Customer::where('id', $user_id)->first();
        //Countries and states
        $countryModel = new Countries();
        $billingInfo = ([ 'country' => $countryModel->getCountry($customerArr['billing_country']), 'state' => DB::table('states')->where('zone_id', '=', $customerArr['billing_state'])->get()[0]]);
        // $shippingInfo = ([ 'country' => $countryModel->getCountry($customerArr['shipping_country']), 'state' =>  DB::table('states')->where('zone_id', '=', $customerArr['shipping_state'])->get()[0] ]);


        $orderObj = new Order();
        $orderObj->order_id = $payment_id . str_random(6);
        $orderObj->customer_id = $user_id;
        $orderObj->rooms = $cart['rooms'];
        $orderObj->adults = $cart['adults'];
        $orderObj->children = $cart['children'];
        $orderObj->billing_first_name = $customerArr['billing_first_name'];
        $orderObj->billing_last_name = $customerArr['billing_last_name'];
        $orderObj->billing_email = $customerArr['billing_email'];
        $orderObj->billing_telephone = $customerArr['billing_telephone'];
        $orderObj->billing_address = $customerArr['billing_address'];
        $orderObj->billing_city = $customerArr['billing_city'];
        $orderObj->billing_post_code = $customerArr['billing_post_code'];
        $orderObj->billing_state = $customerArr['billing_state'];
        $orderObj->billing_country = $customerArr['billing_country'];
        $orderObj->shipping_first_name = $customerArr['shipping_first_name'];
        $orderObj->shipping_last_name = $customerArr['shipping_last_name'];
        $orderObj->shipping_email = $customerArr['shipping_email'];
        $orderObj->shipping_telephone = $customerArr['shipping_telephone'];
        $orderObj->shipping_address = $customerArr['shipping_address'];
        $orderObj->shipping_city = $customerArr['shipping_city'];
        $orderObj->shipping_post_code = $customerArr['shipping_post_code'];
        $orderObj->shipping_state = $customerArr['shipping_state'];
        $orderObj->shipping_country = $customerArr['shipping_country'];
        $orderObj->totalPrice = $payment->transactions[0]->amount->total;
        $orderObj->transaction_id = $payment_id;
        $orderObj->payment_method = 'PayPal';
        $orderObj->payment_status = 'Paid';
        $orderObj->status = 'New Order';
        $orderObj->promocode_id = ($promo) ? $promo->id : 0;
        $orderObj->discount = $cart['discount_amount'];
        $orderObj->ip_address = $this->getRealIpAddr();
        $orderObj->modifydate = date('Y-m-d H:i:s');
        $orderObj->createdate = date('Y-m-d H:i:s');
        $orderObj->save();

        $OrderToProductArr = [];
        foreach ($cart['product'] as $room) {

            $OrderToProduct = new OrderToProduct();
            $RoomBookedDate = new RoomBookedDate();
            $OrderToProduct->order_id = $orderObj->id;
            $OrderToProduct->product_id = $room['product_id'];
            $OrderToProduct->quantity = $room['qty'];
            $OrderToProduct->amount = $room['sale_price'];
            $OrderToProduct->gst = $room['is_tax'] ? ($room['sale_price'] * $gst_rate / 100) : 0.0;
            $OrderToProduct->gst_rate = $room['is_tax'] ? $gst_rate : 0;
            $OrderToProduct->quantity_discount = $room['off'];
            $OrderToProduct->promo_code_discount = $this->calculateDiscount([$room], $promo);
            $OrderToProduct->save();
            array_push($OrderToProductArr, $OrderToProduct);
            $RoomBookedDate->date_checkin = $cart['arrival'];
            $RoomBookedDate->date_checkout = $cart['departure'];
            $RoomBookedDate->order_id = $orderObj->id;
            $RoomBookedDate->product_id = $room['product_id'];
            $RoomBookedDate->save();

            myProduct::where('id', $room['product_id'])->decrement('quantity_in_stock', $room['qty']);
        }

        $bookindid = $orderObj->id;
        $invoice = array(
            'order' => $orderObj,
            'order_to_products' => $OrderToProductArr,
            'bookid' => $bookindid
        );
        $invoice['cart'] = $cart == null ? array() : $cart;
        $total = 0;
        $discount = 0;
        foreach ($cart['product'] as $key => $value) {
            $total += $value['sale_price'] * $value['qty'];
            $discount += $value['off'] * $value['qty'];
        }
        $ProductsModel = new Product();
        $invoice['promo'] = $ProductsModel->getDiscount(Session::get('_token'), $cart['product'][0]['product_id']);
        $invoice['discount'] = $discount;
        $invoice['billing_info'] = $billingInfo;
        // $invoice['shipping_info'] = $shippingInfo;

        $messageData = [
            'fromEmail' => 'registration@ritzgardenhotel.com',
            'fromName' => 'Ritz Garden Hotel Online Booking',
            'toEmail' => $orderObj->billing_email,
            'toName' => $orderObj->billing_first_name . ' ' . $orderObj->billing_last_name,
            'subject' => 'Ritz Garden Hotel::Order #' . $orderObj->order_id
        ];

        /* Send invoice emails to 3 other email addresses as well */
		//$messageData['toEmails'] = [$messageData['toEmail'], "lily@ritzgardenhotel.com", "reservation@ritzgardenhotel.com", "sales@ritzgardenhotel.com"];//
        $messageData['toEmails'] = [$messageData['toEmail'], "bruce@webqom.com", "reservation@ritzgardenhotel.com", "sales@ritzgardenhotel.com"];
        //dd($invoice->cart);//
        Mail::send('invoice.invoice-html', $invoice, function ($message) use ($messageData) {
            $message->from($messageData['fromEmail'], $messageData['fromName']);
            //$message->to($messageData['toEmail'], $messageData['toName']);
            $message->to($messageData['toEmails']);
            $message->subject($messageData['subject']);
        });



        $invoice2 = array(
            'orderInfo' => $orderObj,
            'orderProducts' => $OrderToProductArr,
            'booking_reference_id' => $orderObj->id,
            'cart' => $cart,
            'billingInfo' => $billingInfo,
                // 'shippingInfo' => $shippingInfo
        );

        Session::forget('cart');
        return $invoice2;
    }

    function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    private function calculateDiscount($products, $promo) {
        $discount = 0;
        foreach ($products as $product) {
            $total_amount = $product['sale_price'] * $product['qty'];
            $discount_price = $product['off'] * $product['qty'];
            $p_disc = isset($promo->discount) ? $promo->discount : 0;
            $discount = $discount + number_format((($total_amount - $discount_price) / 100 * $p_disc), 2);
        }
        return $discount;
    }

}
