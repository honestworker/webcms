<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Models\Admin\Orders;
use App\Http\Models\Countries;


use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Request;
use Response;
use Mail;
use App\Http\Models\ShippingMethod;

class OrdersController extends Controller {
	private $data = array();
	private $OrdersModel = null;
	private $ShippingModel = null;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->OrdersModel = new Orders();
		$this->ShippingModel = new ShippingMethod();
	}

	public function index($limit = 10)
	{
		$page = 0;

		if(Input::get('page')){
			$page = Input::get('page');
		}
		if(Input::get('sort')){
			$sort = Input::get('sort');
		}
		else{
			$sort = 'DESC';
		}
		if(Input::get('sort_by')){
			$sort_by = Input::get('sort_by');
		}
		else{
			$sort_by = 'createdate';
		}

		$this->data['success'] = Session::get('order.success');
		Session::forget('order.success');
		$this->data['warning'] = Session::get('order.warning');
		Session::forget('order.warning');

		$this->data['orders'] = $this->OrdersModel->getOrders($limit, $page, Input::get());
		$this->data['paginate_msg'] = $this->OrdersModel->get_paginate_msg($limit, $page, Input::get());
		$this->data['last_updated'] = $this->OrdersModel->getLastUpdated();
		$this->data['curr_url'] = Request::url(). '?' . $_SERVER['QUERY_STRING'];

		//Sorting URL Start
		$sortingUrl = url('web88cms/orders/' . $limit) . '?';
		if(Input::get('order_from')){
			$sortingUrl .= '&order_from=' . Input::get('order_from');
		}

		if(Input::get('order_to')){
			$sortingUrl .= '&order_to=' . Input::get('order_to');
		}

		if(Input::get('customer_name')){
			$sortingUrl .= '&customer_name=' . Input::get('customer_name');
		}

		if(Input::get('status')){
			$sortingUrl .= '&status=' . Input::get('status');
		}

		if(Input::get('payment_status')){
			$sortingUrl .= '&payment_status=' . Input::get('payment_status');
		}
		//Sorting URL End

		$this->data['limit'] = $limit;
		$this->data['page'] = $page;
		$this->data['sorting_url'] = $sortingUrl;
		$this->data['sort'] = $sort;
		$this->data['sort_by'] = $sort_by;

		$this->data['page_title'] = 'Orders:: Listing';

		return view('admin.order.index', $this->data);
	}

	public function deleteOrder($order_id){
		$this->OrdersModel->deleteOrder($order_id);
		Session::put('order.success', 'Order deleted successfully.');

		if(Input::get('redirect')){
			return redirect(Input::get('redirect'));
		}
		else{
			return redirect(Input::get('web88cms/orders'));
		}
	}

	public function deleteAllOrder(){
		$orders = Input::get('order_id');

		if($orders && is_array($orders)){
			foreach($orders as $order_id){
				$this->OrdersModel->deleteOrder($order_id);
			}
		}

		Session::put('order.success', 'Orders deleted successfully.');
		$json['success'] = 'TRUE';
		return Response::json($json);
	}

	public function detail($order_id){
                
                $bookind=$order_id;
		$this->data['success'] = Session::get('order.success');
		Session::forget('order.success');
		$this->data['warning'] = Session::get('order.warning');
		Session::forget('order.warning');

		$CountriesModel = new Countries();
		$order = $this->OrdersModel->getOrder($order_id);

		$this->data['billing_states'] = array();
		$this->data['shipping_states'] = array();

		if($order->billing_country){
			$this->data['billing_states'] = $CountriesModel->getStatesByCountry($order->billing_country);
		}
		if($order->shipping_country){
			$this->data['shipping_states'] = $CountriesModel->getStatesByCountry($order->shipping_country);
		}
                
        $this->data['bookid'] =$bookind;
		$this->data['countries'] = $CountriesModel->getCountries();
		$this->data['order'] = $order;
		$this->data['order_to_products'] = $this->OrdersModel->getOrderToProduct($order_id);
		$this->data['booking_date'] = DB::table('room_booked_date')->where('order_id', $order_id)->first();
		$this->data['customer'] = $this->OrdersModel->getCustomer($order->customer_id);
		$this->data['customerTotalOrders'] = $this->OrdersModel->getCustomerTotalOrders($order->customer_id);
		$this->data['totalOrderItems'] = $this->OrdersModel->getTotalOrderItems($order->id);

		$this->data['orderStatus'] = array('New Order', 'Declined', 'Cancelled', 'Shipped', 'Ready To Ship', 'Completed', 'Processing');
		$this->data['paymentStatus'] = array('Processing', 'Paid', 'Payment Error', 'Cancelled');
		//echo '<pre>';print_r($this->data['orders']);exit;

		$this->data['page_title'] = 'View Orders:: Details';

		//Get Available Csv shipping method
		$this->data['shipping_options'] = $this->ShippingModel->getAvailableCsvShipping($order->total_weight, $order->shipping_state);

		return view('admin.order.detail', $this->data);
	}

	public function invoice($id){

		$order = $this->OrdersModel->getOrder($id);
		$orderToProduct = $this->OrdersModel->getOrderToProduct($id);
		$product = new \App\Http\Models\Front\Product();
                
		$order_id=$id;
		$this->data['bookid'] =$order_id;
		$total = 0;
		$discount = 0;
		//dd($orderToProduct);
               $arrivalDate=DB::table('room_booked_date')->select('date_checkin')->where('order_id','=',$id)->first();
               $arrivalDate=$arrivalDate->date_checkin;
               $deliveryDate=DB::table('room_booked_date')->select('date_checkout')->where('order_id','=',$id)->first();
               $deliveryDate=$deliveryDate->date_checkout;
		for($i = 0; $i < count($orderToProduct); $i++){
			$orderToProduct[$i]->bed = $product->getProduct($orderToProduct[$i]->product_id,$arrivalDate,$deliveryDate)->bed;
			$orderToProduct[$i]->guest = $product->getProduct($orderToProduct[$i]->product_id,$arrivalDate,$deliveryDate)->guest;
			$orderToProduct[$i]->meal = $product->getProduct($orderToProduct[$i]->product_id,$arrivalDate,$deliveryDate)->meal;
			$orderToProduct[$i]->pwp_price = $product->getProduct($orderToProduct[$i]->product_id,$arrivalDate,$deliveryDate)->sale_price;
			$orderToProduct[$i]->sale_price = $product->getProduct($orderToProduct[$i]->product_id,$arrivalDate,$deliveryDate)->sale_price;
			$total += $orderToProduct[$i]->sale_price*$orderToProduct[$i]->quantity;

			$off = DB::table('order_to_product')->where('product_id', $orderToProduct[$i]->product_id)->where('order_id', $orderToProduct[$i]->order_id)->get()[0];

			$discount += $off->quantity_discount*$orderToProduct[$i]->quantity;
		}


                //$orderToProduct[0]->bed = $product->getProduct(1303,'2018-02-28')->bed;

		$invoice = array(
			'order' 			=> $order,
			'order_to_products'	=> $orderToProduct,
			'total'	=> $total,
			'discount'	=> $discount
		);
                
                $this->data['success'] = Session::get('order.success');
		Session::forget('order.success');
		$this->data['warning'] = Session::get('order.warning');
		Session::forget('order.warning');

		$CountriesModel = new Countries();
		$order = $this->OrdersModel->getOrder($order_id);

		$this->data['billing_states'] = array();
		$this->data['shipping_states'] = array();

		if($order->billing_country){
			$this->data['billing_states'] = $CountriesModel->getStatesByCountry($order->billing_country);
		}
		if($order->shipping_country){
			$this->data['shipping_states'] = $CountriesModel->getStatesByCountry($order->shipping_country);
		}

		$this->data['countries'] = $CountriesModel->getCountries();
		$this->data['order'] = $order;
		$this->data['order_to_products'] = $this->OrdersModel->getOrderToProduct($order_id);
		$this->data['booking_date'] = DB::table('room_booked_date')->where('order_id', $order_id)->first();
		$this->data['customer'] = $this->OrdersModel->getCustomer($order->customer_id);
		$this->data['customerTotalOrders'] = $this->OrdersModel->getCustomerTotalOrders($order->customer_id);
		$this->data['totalOrderItems'] = $this->OrdersModel->getTotalOrderItems($order->id);

		$this->data['orderStatus'] = array('New Order', 'Declined', 'Cancelled', 'Shipped', 'Ready To Ship', 'Completed', 'Processing');
		$this->data['paymentStatus'] = array('Processing', 'Paid', 'Payment Error', 'Cancelled');
		//echo '<pre>';print_r($this->data['orders']);exit;

		$this->data['page_title'] = 'View Orders:: Details';

		//Get Available Csv shipping method
		$this->data['shipping_options'] = $this->ShippingModel->getAvailableCsvShipping($order->total_weight, $order->shipping_state);
		//dd($orderToProduct);
		//////////////////////////////
		//////////////////////////////
		// $order = $this->OrdersModel->getOrder($id);
		//
		// $this->data['order'] = $order;
		// $this->data['order_to_products'] = $this->OrdersModel->getOrderToProduct($id);
		// $this->data['customer'] = $this->OrdersModel->getCustomer($order->customer_id);
		// $this->data['customerTotalOrders'] = $this->OrdersModel->getCustomerTotalOrders($order->customer_id);
		// $this->data['totalOrderItems'] = $this->OrdersModel->getTotalOrderItems($order->id);
		//
		// $this->data['page_title'] = 'Invoice';
		//dd($invoice);
		//// return view('admin.order.invoice', $this->data);
                //var_dump($invoice);
                //return view('invoice.admin-invoice-print-html','order' =>$invoice);
                return view('invoice.admin-invoice-print-html',$invoice,$this->data);
	//	//return view('invoice/invoice-html', $this->data);
	}

	public function saveShippingAddress($id){
		$json = array();

		$validation['shipping_first_name'] = 'required';
		$validation['shipping_last_name'] = 'required';
		$validation['shipping_email'] = 'required|email';
		$validation['shipping_telephone'] = 'required';
		$validation['shipping_address'] = 'required';

		$validator = Validator::make(Request::all(), $validation);

		if ($validator->fails()) {
			$json['error'] = $validator->errors()->all();
		}
		else
		{
			$this->OrdersModel->saveShippingAddress($id, Request::all());
			Session::put('order.success', 'Shipping address updated successfuly.');
			$json['success'] = 'TRUE';
		}

		return Response::json($json);
	}

	public function saveBillingAddress($id){
		$json = array();

		$validation['billing_first_name'] = 'required';
		$validation['billing_last_name'] = 'required';
		$validation['billing_email'] = 'required|email';
		$validation['billing_telephone'] = 'required';
		$validation['billing_address'] = 'required';

		$validator = Validator::make(Request::all(), $validation);

		if ($validator->fails()) {
			$json['error'] = $validator->errors()->all();
		}
		else
		{
			$this->OrdersModel->saveBillingAddress($id, Request::all());
			Session::put('order.success', 'Billing address updated successfuly.');
			$json['success'] = 'TRUE';
		}

		return Response::json($json);
	}

	public function updateOrderStatus($id){
		$json = array();
		$this->OrdersModel->updateOrderStatus($id, Input::get('status'));

		//Send invoice
		if(Input::get('notify')){

			$order = $this->OrdersModel->getOrder($id);
			$orderToProduct = $this->OrdersModel->getOrderToProduct($id);
			$product = new \App\Http\Models\Front\Product();

			$total = 0;
			$discount = 0;
			//dd($orderToProduct);
			for($i = 0; $i < count($orderToProduct); $i++){
				$orderToProduct[$i]->bed = $product->getProduct($orderToProduct[$i]->product_id)->bed;
      	$orderToProduct[$i]->guest = $product->getProduct($orderToProduct[$i]->product_id)->guest;
      	$orderToProduct[$i]->meal = $product->getProduct($orderToProduct[$i]->product_id)->meal;
				$orderToProduct[$i]->pwp_price = $product->getProduct($orderToProduct[$i]->product_id)->sale_price;
				$orderToProduct[$i]->sale_price = $product->getProduct($orderToProduct[$i]->product_id)->sale_price;
				$total += $orderToProduct[$i]->sale_price*$orderToProduct[$i]->quantity;

				$off = DB::table('order_to_product')->where('product_id', $orderToProduct[$i]->product_id)->where('order_id', $orderToProduct[$i]->order_id)->get()[0];

				$discount += $off->quantity_discount*$orderToProduct[$i]->quantity;
			}
			$invoice = array(
				'order' 			=> $order,
				'order_to_products'	=> $orderToProduct,
				'total'	=> $total,
				'discount'	=> $discount
			);

			$messageData = [
				'fromEmail' 			=> 'registration@ritzgardenhotel.com',//'shop@tbm.com.my',
				'fromName' 				=> 'Ritz Garden Hotel Online Booking',
				'toEmail' 				=> $order->billing_email,
				'toName' 				=> $order->billing_first_name . ' ' . $order->billing_last_name,
				'subject'				=> 'Ritz Garden Hotel::Order #' . $order->order_id
			];
			//dd($invoice);
			Mail::send('invoice.admin-invoice-html', $invoice, function ($message) use ($messageData) {
				$message->from($messageData['fromEmail'], $messageData['fromName']);
				$message->to($messageData['toEmail'], $messageData['toName']);
				$message->subject($messageData['subject']);
			});
		}
		//End
//dd($messageData);
		Session::put('order.success', 'Order status updated successfuly.');
		$json['success'] = 'TRUE';

		return Response::json($json);
	}

	public function updatePaymentStatus($id){
		$json = array();

		$this->OrdersModel->updatePaymentStatus($id, Input::get('status'));

		//Send invoice
		if(Input::get('notify')){
			$order = $this->OrdersModel->getOrder($id);
			$orderToProduct = $this->OrdersModel->getOrderToProduct($id);
			$product = new \App\Http\Models\Front\Product();

			$total = 0;
			$discount = 0;
			//dd($orderToProduct);
			for($i = 0; $i < count($orderToProduct); $i++){
				$orderToProduct[$i]->bed = $product->getProduct($orderToProduct[$i]->product_id)->bed;
      	$orderToProduct[$i]->guest = $product->getProduct($orderToProduct[$i]->product_id)->guest;
      	$orderToProduct[$i]->meal = $product->getProduct($orderToProduct[$i]->product_id)->meal;
				$orderToProduct[$i]->pwp_price = $product->getProduct($orderToProduct[$i]->product_id)->sale_price;
				$orderToProduct[$i]->sale_price = $product->getProduct($orderToProduct[$i]->product_id)->sale_price;
				$total += $orderToProduct[$i]->sale_price*$orderToProduct[$i]->quantity;

				$off = DB::table('order_to_product')->where('product_id', $orderToProduct[$i]->product_id)->where('order_id', $orderToProduct[$i]->order_id)->get()[0];

				$discount += $off->quantity_discount*$orderToProduct[$i]->quantity;
			}
			$invoice = array(
				'order' 			=> $order,
				'order_to_products'	=> $orderToProduct,
				'total'	=> $total,
				'discount'	=> $discount
			);

			$messageData = [
				'fromEmail' 			=> 'registration@ritzgardenhotel.com',//'shop@tbm.com.my',
				'fromName' 				=> 'Ritz Garden Hotel Online Booking',
				'toEmail' 				=> $order->billing_email,
				'toName' 				=> $order->billing_first_name . ' ' . $order->billing_last_name,
				'subject'				=> 'Ritz Garden Hotel::Order #' . $order->order_id
			];
			//dd($invoice);
			Mail::send('invoice.admin-invoice-html', $invoice, function ($message) use ($messageData) {
				$message->from($messageData['fromEmail'], $messageData['fromName']);
				$message->to($messageData['toEmail'], $messageData['toName']);
				$message->subject($messageData['subject']);
			});
		}
		//End

		Session::put('order.success', 'Payment status updated successfuly.');
		$json['success'] = 'TRUE';

		return Response::json($json);
	}

	// public function updatePaymentStatus($id){
	// 	$json = array();
	//
	// 	$this->OrdersModel->updatePaymentStatus($id, Input::get('status'));
	//
	// 	//Send invoice
	// 	if(Input::get('notify')){
	// 		$order = $this->OrdersModel->getOrder($id);
	// 		$orderToProduct = $this->OrdersModel->getOrderToProduct($id);
	//
	// 		$invoice = array(
	// 			'order' 			=> $order,
	// 			'order_to_products'	=> $orderToProduct
	// 		);
	//
	// 		$messageData = [
	// 			'fromEmail' 			=> 'shop@tbm.com.my',
	// 			'fromName' 				=> 'TBMonline',
	// 			'toEmail' 				=> $order->billing_email,
	// 			'toName' 				=> $order->billing_first_name . ' ' . $order->billing_last_name,
	// 			'subject'				=> 'TBM::Order #' . $order->order_id
	// 		];
	//
	// 		Mail::send('invoice.admin-invoice-html', $invoice, function ($message) use ($messageData) {
	// 			$message->from($messageData['fromEmail'], $messageData['fromName']);
	// 			$message->to($messageData['toEmail'], $messageData['toName']);
	// 			$message->subject($messageData['subject']);
	// 		});
	// 	}
	// 	//End
	//
	// 	Session::put('order.success', 'Payment status updated successfuly.');
	// 	$json['success'] = 'TRUE';
	//
	// 	return Response::json($json);
	// }

	public function shipmentsList($limit = 10)
	{
		$page = 0;

		if(Input::get('page')){
			$page = Input::get('page');
		}
		if(Input::get('sort')){
			$sort = Input::get('sort');
		}
		else{
			$sort = 'DESC';
		}
		if(Input::get('sort_by')){
			$sort_by = Input::get('sort_by');
		}
		else{
			$sort_by = 'createdate';
		}

		$this->data['success'] = Session::get('order.success');
		Session::forget('order.success');
		$this->data['warning'] = Session::get('order.warning');
		Session::forget('order.warning');

		$data = Input::get();
		$data['isShipment'] = true;

		$this->data['orders'] = $this->OrdersModel->getOrders($limit, $page, $data);
		$this->data['paginate_msg'] = $this->OrdersModel->get_paginate_msg($limit, $page, $data);
		$this->data['last_updated'] = $this->OrdersModel->getLastUpdated();
		$this->data['curr_url'] = Request::url(). '?' . $_SERVER['QUERY_STRING'];

		//Sorting URL Start
		$sortingUrl = url('web88cms/orders/shipmentsList/' . $limit) . '?';
		if(Input::get('order_from')){
			$sortingUrl .= '&order_from=' . Input::get('order_from');
		}

		if(Input::get('order_to')){
			$sortingUrl .= '&order_to=' . Input::get('order_to');
		}

		if(Input::get('customer_name')){
			$sortingUrl .= '&customer_name=' . Input::get('customer_name');
		}

		if(Input::get('status')){
			$sortingUrl .= '&status=' . Input::get('status');
		}

		if(Input::get('payment_status')){
			$sortingUrl .= '&payment_status=' . Input::get('payment_status');
		}
		//Sorting URL End

		$this->data['limit'] = $limit;
		$this->data['page'] = $page;
		$this->data['sorting_url'] = $sortingUrl;
		$this->data['sort'] = $sort;
		$this->data['sort_by'] = $sort_by;

		$this->data['page_title'] = 'Orders:: Listing';

		return view('admin.order.shipmentsList', $this->data);
	}

	public function shipmentDetail($id){
		$order = $this->OrdersModel->getOrder($id);

		$this->data['order'] = $order;
		$this->data['order_to_products'] = $this->OrdersModel->getOrderToProduct($id);
		$this->data['customer'] = $this->OrdersModel->getCustomer($order->customer_id);
		$this->data['totalOrderItems'] = $this->OrdersModel->getTotalOrderItems($order->id);

		$this->data['page_title'] = 'View Shipment:: Details';

		return view('admin.order.shipmentDetail', $this->data);
	}

	public function addNewShipment($id){
		$json = array();

		$validation['shipping_method'] = 'required';
		$validation['tracking_number'] = 'required';
		$validation['comments'] = 'required';

		$validator = Validator::make(Request::all(), $validation);

		if ($validator->fails()) {
			$json['error'] = $validator->errors()->all();
		}
		else
		{
			$this->OrdersModel->addNewShipment($id, Request::all());

			//Send invoice
			if(Input::get('send_shipment_notification') == 'on'){
				$order = $this->OrdersModel->getOrder($id);
				$orderToProduct = $this->OrdersModel->getOrderToProduct($id);

				$invoice = array(
					'order' 			=> $order,
					'order_to_products'	=> $orderToProduct
				);

				$messageData = [
					'fromEmail' 			=> 'shop@tbm.com.my',
					'fromName' 				=> 'TBMonline',
					'toEmail' 				=> $order->billing_email,
					'toName' 				=> $order->billing_first_name . ' ' . $order->billing_last_name,
					'subject'				=> 'TBM::Order #' . $order->order_id
				];

				Mail::send('invoice.admin-invoice-shipment', $invoice, function ($message) use ($messageData) {
					$message->from($messageData['fromEmail'], $messageData['fromName']);
					$message->to($messageData['toEmail'], $messageData['toName']);
					$message->subject($messageData['subject']);
				});
			}
			//End

			Session::put('order.success', 'New shipment added successfuly.');
			$json['success'] = 'TRUE';
		}

		return Response::json($json);
	}

	public function editNote($id){
		$json = array();

		$data['customer_notes'] = Input::get('customer_notes');
		$data['staff_notes'] = Input::get('staff_notes');

		$this->OrdersModel->updateNotes($id, $data);
		$json['success'] = 'Notes updated successfuly.';

		return Response::json($json);
	}

	function csv(){
		$table = DB::table('orders')->select('id', 'order_id', 'createdate', 'billing_email', 'billing_first_name', 'billing_last_name', 'totalPrice', 'status', 'payment_status')->get();

		$filename = "orders.csv";
		$handle = fopen($filename, 'w+');
		fputcsv($handle, array('id', 'order_id', 'createdate', 'email', 'first_name', 'last_name', 'totalPrice', 'status', 'payment_status'));

		foreach($table as $row) {
			fputcsv($handle, array($row->id, $row->order_id, $row->createdate, $row->billing_email, $row->billing_first_name, $row->billing_last_name, $row->totalPrice, $row->status, $row->payment_status));
		}

		fclose($handle);

		$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="' . $filename . '"',
		);

		return Response::download($filename, $filename, $headers);
	}

	public function viewPurchasedService(Request $requst){
		$inputs = Input::all();

		//$this->OrdersModel->getOrderToProduct($order_id);
		foreach ($inputs['order_id'] as $id) {
			if(isset($this->OrdersModel->getOrderToProduct($id)[0])){
				$order = $this->OrdersModel->getOrderToProduct($id)[0];
				$order->tax = $this->OrdersModel->getOrderTax($id);
				$this->data['orders'][] = $order;
			}
		}

		$this->data['page_title'] = 'view purchased service';

		return view('admin.order.view_purchased_services', $this->data);
	}
}
