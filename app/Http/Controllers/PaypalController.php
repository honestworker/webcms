<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\UsersPackage;
use App\Models\Payment as PaymentModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Package;
use Auth;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Models\Front\Checkout;

class PaypalController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        parent::__construct();

        /** setup Paypal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {
        return view('upgradeAccount');
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {
        $cart = Session::get('cart');
        $itemListArr = [];
        $Totalamount = 0;

        foreach ($cart['product'] as $i=>$room) {
            $unitprice = $room['sale_price'] - $room['off'];
			$unitprice = $unitprice + ($unitprice * 6 / 100);
            $Totalamount = $Totalamount + $unitprice;
            $item = new Item();
            $item->setName( $room['type']) /** item name * */
                    ->setCurrency('MYR')
                    ->setQuantity($room['qty'])
                    ->setPrice($unitprice);/** unit price * */

            array_push($itemListArr,$item);
        }

		$discount = Input::get('discount');
		if($discount != 0){
            $item = new Item();
            $item->setName('discount') /** item name * */
                    ->setCurrency('MYR')
                    ->setQuantity(1)
                    ->setPrice(-$discount);/** unit price * */
			$Totalamount = $Totalamount - $discount;
			array_push($itemListArr, $item);
		}

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_list = new ItemList();
        $item_list->setItems($itemListArr);

        $amount = new Amount();
        //$amount->setCurrency('USD')->setTotal($Totalamount);
		//echo $Totalamount .'::'. Input::get('amount');exit;
        $amount->setCurrency('MYR')->setTotal($Totalamount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\Paypal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                Session::put('error','Connection timeout');
                return Redirect::route('addmoney.paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('addmoney.paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        Session::put('error','Unknown error occurred');
        return Redirect::route('addmoney.paywithpaypal');
    }

    public function getPaymentStatus()
    {

        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
    //    dump($payment_id);
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        $payment_id = Input::get('PaymentID');
        $payerID = Input::get('PayerID');
        $paypal_token = Input::get('paymentToken');
        if (empty($payerID) || empty($paypal_token)) {

            Session::put('error', 'Payment failed');
            return Redirect::route('addmoney.paywithpaypal');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        /** PaymentExecution object includes information necessary **/
        /** to execute a Paypal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {

            /** it's all right * */
            /** Here Write your database logic like that insert record or value in database if you want * */
            $checkout = new Checkout();
            $invoice2 = $checkout->orderPlacement($payment, $payment_id);
            //dd($invoice2);
            Session::put('success', 'Payment success');
            Session::put('already',0);
            Session::put('payment',$payment);
            Session::put('payment_id',$payment_id);

            Session::put('invoice',$invoice2);

            return Redirect::route('orderConfirmation');
            //return view('front.checkout.order-confirmation')->with($invoice2);
        }
        Session::put('error','Payment failed');
        return Redirect::route('orderConfirmation');
    }
  }
