<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Front\Product;
use App\Http\Models\Front\CheckAvail;
use Helper;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use View;
use Request;
use Response;
use Cookie;
use URL;
use Mail;

class CheckAvailController extends Controller {

    private $data = array();

    public function __construct() {
        $this->CheckAvailModel = new CheckAvail();
        $this->ProductModel = new Product();
    }

    function index() {
        $data = Input::all();
        $data['status'] =true;
        \Session::forget('cart');
        return View::make('front.check_avail.check_avail', $data);
    }

    function check_avail() {

        $data = Input::all();
        $rules = [
            'checkin_date' => 'required',
            'checkout_date' => 'required'
        ];
        $val = Validator::make($data, $rules);

        if ($val->fails()) {
            echo json_encode(['status' => false]);
            return;
        }

        // Check it all the dates are available
        if ($data['product_id']) {
            $isNotAvailable = false;
            $notAvailableDates = '';
            $checkIn = date_create_from_format('Y-m-d', $data['checkin_date']);
            $checkOut = date_create_from_format('Y-m-d', $data['checkout_date']);

            while ($checkIn <= $checkOut) {
                $exist = DB::table('product_room_prices as prp')
                        ->where('product_id', '=', $data['product_id'])
                        ->where('status', '=', '1')
                        ->where('date', '=', date_format($checkIn, 'Y-m-d'))
                        ->exists();

                if (!$exist) {
                    $isNotAvailable = true;
                    $notAvailableDates .= date_format($checkIn, 'd-m-Y') . " ";
                }

                date_add($checkIn, date_interval_create_from_date_string('1 day'));
            }

            if ($isNotAvailable) {
                echo json_encode([
                    'status' => true,
                    'dates' => $notAvailableDates
                ]);
                return;
            }
        }

        // Get available rooms
        $avail = $this->CheckAvailModel->getRoom($data['checkin_date'], $data['checkout_date'], $data);

        $res = [];
        foreach ($avail as $key => &$value) {
            $discount = $this->ProductModel->getGlobalDiscount($value->id, $value->sale_price);
            $off = 0;
            if (!empty($discount)) {
                if ($discount->discount_by == 'percentage') {
                    $off = ($value->sale_price * $discount->discount) / 100;
                } else {
                    $off = $discount->discount;
                }
                $value->discount = $off;
            } else {
                $value->discount = $off;
            }
            $priceByDates = $this->CheckAvailModel->getPriceByDates($value->id, $data['checkin_date'], $data['checkout_date']);

            $value->priceByDates = "";

            $need = true;
            foreach ($priceByDates as $pd) {
                $value->priceByDates .= "<span>" . date('l', strtotime($pd->date)) . ", " . date('d/M/Y', strtotime($pd->date)) . " MYR " . number_format($pd->sale_price, 2) . "</span><br/>";

                if($pd->qty_stock == 0)
                  $need = false;
            }
            if($need)
              $res[] = $value;
        }

        echo json_encode(['status' => true, 'avail' => $res]);
    }

    function saveCart() {
        $cart = [];
        $tax_rate = 0;
        $data = Input::all();
        $cart['product'] = array();
        $cart['arrival'] = $data['arrival'];
        $cart['departure'] = $data['departure'];
        $cart['rooms'] = $data['rooms'];
        $cart['adults'] = $data['adults'];
        $cart['children'] = $data['children'];
        $cart['promocode_id'] = $data['promocode_id'];
        $discountGlobal = 0;
        $tax = 0;
        $total_amount = 0;
        $GST_rate = $this->ProductModel->getGSTRate();
        if (isset($GST_rate)) {
            $tax_rate = $GST_rate->rate;
        }
        foreach ($data['order'] as $key => $value) {
            $product = $this->ProductModel->getProduct($value['product_id'], $data['arrival'], $data['departure']);
            if (empty($product))
                continue;
            $discount = $this->ProductModel->getGlobalDiscount($product->id, $product->sale_price);
            // $tmp = $discount;
            if (!empty($discount)) {
                $off = 0;
                if ($discount->discount_by == 'percentage') {
                    $off = ($product->sale_price * $discount->discount) / 100;
                } else {
                    $off = $discount->discount;
                }
            } else {
                $off = 0;
            }

            $roomDates = $this->CheckAvailModel->getPriceByDates($product->id, $data['arrival'], $data['departure']);

            $priceByDates = "";
            foreach ($roomDates as $pd) {
                $priceByDates .= "<span>" . date('l', strtotime($pd->date)) . ", " . date('d/M/Y', strtotime($pd->date)) . " MYR " . number_format($pd->sale_price, 2) . " </span><br/>";
            }

            $cartProduct = array(
                'product_id' => $product->id,
                'is_tax' => $product->is_tax,
                'off' => $off,
                // 'tmp' => $tmp,
                'type' => $product->type,
                'qty' => $value['qty'],
                'thumbnail_image_1' => $product->thumbnail_image_1,
                'room_code' => $product->room_code,
                'bed' => $product->bed,
                'guest' => $product->guest,
                'meal' => $product->meal,
                'sale_price' => $product->sale_price,
                'quantity_in_stock' => $product->quantity_in_stock,
                'promocode_id' => $data['promocode_id'],
                'priceByDates' => $priceByDates
            );

            $cart['product'][] = $cartProduct;
            // $discountGlobal += floor($off) * $value['qty'];
            $discountGlobal += $off * $cart['rooms'];
            if ($product->is_tax == 1) {
                //$tax += ($product->sale_price*6/100);
                $tax += ($product->sale_price * $tax_rate / 100);
            }
            $total_amount += $product->sale_price * $value['qty'];
        }
        $promo = $this->ProductModel->getDiscount(Session::get('_token'), $data['order'][0]['product_id']);
        $totalDiscount = 0;
        if (isset($promo->discount)) {
            if ($promo->discount_type == "P") {
                $totalDiscount = $total_amount * $promo->discount / 100;
            } else {
                $totalDiscount = $promo->discount;
            }
        } else {
            $totalDiscount = $discountGlobal;
        }
        $cart['sub_total'] = $total_amount;
        $cart['discount_amount'] = $totalDiscount;
        $cart['tax_amount'] = $tax;
        $cart['tax_rate'] = ($product->is_tax == 1)?$tax_rate:0;
        $cart['final_amount'] = ($total_amount - $totalDiscount) + $tax;
        Session::put('cart', $cart);
        echo json_encode(array('status' => 1));
    }

    public function checkDiscount(\Illuminate\Http\Request $request) {

        // dd($request->all());
        // 	return DB::table('product_discount')->get();
        $promo = $this->ProductModel->checkPromo($request->get('code'));
        // return error if no promocode matched
        if (!$promo)
            return json_encode(['error' => 'Coupon is not valid!']);


        $check = $this->ProductModel->checkUse($promo->id, Session::get('_token'));
        //echo $promo->id;
        //var_dump(collect($check)->isEmpty());
        // changed ! (not negation symbol)
        // if(!collect($check)->isEmpty()){
        // if(!collect($check)->isEmpty()){
        //     return 1;
        // }

        $this->ProductModel->setPromo($promo, $request->get('pids'));
        return json_encode($promo);
    }

    /**
     * Signup for the notifications function
     *
     * @return void
     * @author
     * */
    function signupForNotification(\Illuminate\Http\Request $request) {
        $formData = array(
            "email" => $request->email,
            "product_id" => $request->notify_product_id,
            "checkin_date" => $request->notify_checkin_date,
            "checkout_date" => $request->notify_checkout_date,
            "room" => $request->notify_room,
            "adult" => $request->notify_adult,
            "children" => $request->notify_children,
            "createdate" => date("Y-m-d H:i:s")
        );
        DB::table("notify_me")->insert($formData);

        /* Send Mail to Admin */
        Mail::send('emails.notify_signup', $formData, function ($message) {
            $message->from("registration@ritzgardenhotel.com");
            $message->to("reservation@ritzgardenhotel.com");
            // $message->to("chandraprakash.024@gmail.com");
            $message->subject("New Signup for notification");
        });

        Session::flash('notify_success_msg', 'You have registered for notifications successfully.');
        return redirect('/notify-success');
    }

    /**
     * Notification Success function
     *
     * @return void
     * @author
     * */
    public function notifySuccess() {
        //Session::flash('notify_success_msg', 'You have registered for notifications successfully.');
        $success = "";
        $warning = "";
        if (!empty(Session::get('notify_success_msg'))) {
            $success = Session::get('notify_success_msg');
        } else {
            return redirect('/');
        }
        return view('front/check_avail/notify_success', compact("success", "warning"));
    }

}
