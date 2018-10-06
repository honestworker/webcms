<?php namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Front\Page;
use App\Http\Models\Front\Contactus;
use App\Http\Models\Countries;


use Illuminate\Http\Request;
use View;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use URL;
use Mail;


class ContactUsController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		/*FOR DEBUG, PLEASE DON'T REMOVE THEESE LINES*/
		// $this->time = 0;
		// $this->queries = 0;
		// \DB::listen(function($sql, $bindings, $time)
		// {
		// 	$this->queries++;
		// 	$this->time+=$time;
		//     file_put_contents('php://stdout', "time:\t{$this->time} milliseconds\n-------------{$this->queries}----------------\n\n\n");
		// });
		$this->ContactusModel = new Contactus();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $CountriesModel = new Countries();
        $this->data['countries'] = DB::table('countries')->orderBy('name', 'ASC')->get();

		return view('front/contact_us/home',  $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
     public function create() {

           $data = Input::all();
            foreach ($data as $key => $item) {
                if ($key === 'fax')
                    continue;
                if (!isset($item) || empty($item)) {
                    Session::flash('captcha', '0');
                    Session::flash('contact_us', '0');
                    return Redirect::to(URL::previous() . "#head");
            }
        }




            $contact = [
                'first_name'      => '',
                'last_name'       => '',
                'company_name'    => '',
                'occupation'      => '',
                'tel'             => '',
                'fax'             => '',
                'email'           => '',
                'Address'         => '',
                'city'            => '',
                'postcode'        => '',
                'room'            => '',
                'subject'         => '',
                'comment_enquiry' => '',
                'billing_state'   => '',
                'billing_country' => '',
            ];
            $contact = array_replace($contact, $data);


            unset($contact['_token']);
            unset($contact['g-recaptcha-response']);
            if ($this->ContactusModel->createContact($contact)) {
                Session::put('success', '1');
                Session::flash('contact_us', '1');
               $messageData = [
                        'fromEmail' => 'registration@ritzgardenhotel.com',
                        'fromName'  => 'Admin',
                        'toEmail'   => 'support@webqom.com',
                        'toName'    => 'Support Webqom',
                        'subject'   => 'Conact Us Notification'
                    ];
                    Mail::send('emails.contactus', ['contact' => $contact], function ($message) use ($messageData) {
                        $message->from($messageData['fromEmail'], $messageData['fromName']);
                        $message->to($messageData['toEmail'], $messageData['toName']);
                        $message->subject($messageData['subject']);
                    });

            } else {
                Session::flash('save', 'failed');
                Session::put('fail', '1');
                Session::flash('captcha', '0');
            }
                return Redirect::to(URL::previous() . "#head"); //Redirect::back("#head");

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
