<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Front\Banners;
use App\Http\Models\Front\Brands;
use App\Http\Models\Front\Categories;
use App\Http\Models\Front\Location;
use App\Http\Models\Front\Newsletter;
use App\Http\Models\Front\Page;
use App\Http\Models\Front\Product;
use App\Http\Models\Countries;
use View;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
//use App\Http\Requests\Request;
use Request;

class Web88Controller extends Controller
{
    private $data = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
                $this->CategoriesModel = new Categories();
                $this->BrandsModel = new Brands();
                $this->BannersModel = new Banners();
                $this->ProductModel = new Product();
                $this->NewsletterModel = new Newsletter();
        */
    }

    /**
     * Show the about us page to the user.
     *
     * @return Response
     */
    public function about()
    {
        $data = Page::where('page', '=', 'about')->firstOrFail();
        $image = unserialize($data->bgimage);
        //	$abbgimage = substr($image['image'], 3);
        $abbgimage = $image['image'];
        $item = unserialize($data->slider_text);
        $about = unserialize($data->old_content);
//dd($image, $abbgimage, $item, $about);
        /*
                $about['title'] = str_replace(
                    '<div id="page-header">',
                    '<div id="page-header" style="background-image: url('.url('/public/front/images/'.$abbgimage).')">',
                    $about['title']);
        */
//dd($about['title'], $image, $abbgimage);

        return View::make('front.web88.about')->with([
            'page_title' => 'About TBM',
            'textslider' => $item,
            'abbgimage' => $abbgimage,
            'about' => $about,
        ]);
    }

    /**
     * Show the vacancy page to the user.
     *
     * @return Response
     */
    public function vacancy()
    {
        $countries = Countries::orderBy('name')->get();
        $states = (new Countries)->getStatesByCountryName('Malaysia');
        // Load Main Menu Categories from shop.tbm.com.my
//	$categories = $this->CategoriesModel->getCategories();
//dd($categories); die;
//exit('!!!!!');

        $data = DB::table('pages')->where('page', 'vacancy')->first();
//	$data = DB::connection('mysql_web88')->table('pages')->where('page', 'vacancy')->first();
//	$data = DB::connection('mysql_staging')->table('pages')->where('page', 'vacancy')->first();
        $header = unserialize($data->old_content);

        $vacancy = [];
        $title = '';
        $location = '';
        $list_location = '';
        $list_title = '';
        if (!empty($data->slider_text)) {
            $vacancy = unserialize($data->slider_text);
            $list = $vacancy;
            if (Request::isMethod('post')) {
                $title = isset($_POST['title']) ? $_POST['title'] : 'all';
                $location = isset($_POST['location']) ? $_POST['location'] : 'all';
                if ($title != 'all' || $location != 'all') {

                    $new_vacancy = [];
                    foreach ($vacancy as $item) {
                        if ($item['location'] == $location && $item['title'] == $title) {
                            $new_vacancy[] = $item;
                        }
                        if ($location == 'all' && $item['title'] == $title) {
                            $new_vacancy[] = $item;
                        }
                        if ($title == 'all' && $item['location'] == $location) {
                            $new_vacancy[] = $item;
                        }

                    }
                    $vacancy = $new_vacancy;

                }
            }

            $tit = [];
            $loc = [];
            foreach ($list as $one) {
                if (!in_array($one['location'], $loc)) {
                    $loc[] = $one['location'];
                    if ($one['location'] == $location)
                        $list_location .= "<option selected='selected' value='{$one['location']}'>{$one['location']}</option>";
                    else
                        $list_location .= "<option value='{$one['location']}'>{$one['location']}</option>";
                }

                if (!in_array($one['title'], $tit)) {
                    $tit[] = $one['title'];
                    if ($one['title'] == $title)
                        $list_title .= "<option selected='selected' value='{$one['title']}'>{$one['title']}</option>";
                    else
                        $list_title .= "<option value='{$one['title']}'>{$one['title']}</option>";
                }

            }
        }
        $info = Page::where('page', '=', 'applicants')->first();
        $info = unserialize($info->old_content);
        //print_r($vacancy);die();

        return View::make('front.web88.vacancy')->with([
            //	'shop_categories' => $categories,
            'page_title' => 'Careers',
            'url_tbm' => 'http://shops3.tbm.com.my/shop',        // 'http://shop.tbm.com.my'
            'data' => $header,
            'vacancy' => $vacancy,
            'list_location' => $list_location,
            'list_title' => $list_title,
            'info' => $info,
            'countries' => $countries,
            'states' => $states
        ]);
    }


    /**
     * Show the services page to the user.
     *
     * @return Response
     */
    public function services()
    {
        $callbackToHtml = function (&$value, $key) {
            $value = html_entity_decode(html_entity_decode($value));
            $value = stripslashes($value);
        };

        $data = DB::table('pages')->where('page', 'services')->first();
        $items = unserialize($data->new_content);
        array_walk_recursive($items, $callbackToHtml);


        return View::make('front.web88.services')->with([
            'page_title' => 'Our Services',
            'data' => $items,
        ]);
    }

    /**
     * Show the services page to the user.
     *
     * @return Response
     */
    public function stores()
    {
        $data = DB::table('pages')->where('page', 'stores')->first();
        $item = unserialize($data->old_content);
        $stores = [];

        if (!empty($data->slider_text)) {
            $stores = unserialize($data->slider_text);
            $new_stores = [];
            foreach ($stores as $value) {
                if (array_key_exists('active', $value)) {
                    $new_stores[] = $value;
                }
            }
            $stores = $new_stores;
            foreach ($stores as $key => $value) {

                $location = Location::find((int)$value['state']);
                $stores[$key]['location'] = $location->state;

            }
        }
        $names = [];
        foreach ($stores as $value) {
            if (array_key_exists('active', $value) && $value['active'])
                $names[] = $value['location'];
        }
        $names = array_unique($names);

        return View::make('front.web88.stores')->with([
            'page_title' => 'Our Stores',
            'data' => $item,
            'stores' => $stores,
            'names' => $names,
        ]);
    }

    /**
     * Show the services page to the user.
     *
     * @return Response
     */
    public function contact()
    {
        $countries = Countries::orderBy('name')->get();
        $states = (new Countries)->getStatesByCountryName('Malaysia');
        $data = DB::table('pages')->where('page', 'contact')->first();
        $item = unserialize($data->old_content);
        return View::make('front.web88.contact')->with([
            'page_title' => 'Contact Us',
            'data' => $item,
            'countries' => $countries,
            'states' => $states,
        ]);

    }

    public function getStates()
    {
        $countryName = Input::get('country_name');
        return (new Countries)->getStatesByCountryName($countryName);
    }

    /**
     * Handle Request from contact form
     */
    public function postFeedback()
    {

        $data = Input::all();

        foreach ($data["message"] as $key => $item) {
            if ($key === 'fax')
                continue;
            if (!isset($item) || empty($item)) {
                Session::put('fail', '1');
                return Redirect::back();
            }
        }


        $captchaData = array(
//            "secret" => "6Lf05gUTAAAAAHj1kPrRYmmjwzVFh2hnO_ZQw8q0",
            "secret" => '6LeonSEUAAAAAGN3lVpN8a789cQDrzY7fjefjsC4',
            "response" => $data['g-recaptcha-response']
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($captchaData));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        curl_close($verify);


        if (preg_match('/true/', $response)) {
            $page = Page::where('page', '=', 'contact')->firstOrFail();
            $arr = [];
            if (!empty($page->slider_text)) {
                $arr = unserialize($page->slider_text);
                foreach ($arr as $key => $msg) {
                    if (isset($msg['name']) && empty($msg['name'])) {
                        unset($arr[$key]);
                    }
                }
            }
            $message = [
                'name' => '',
                'company' => '',
                'occupation' => '',
                'phone' => '',
                'fax' => '',
                'email' => '',
                'address' => '',
                'city' => '',
                'post' => '',
                'state' => '',
                'country' => '',
                'subject' => '',
                'message' => '',
            ];
            $data['message']['time'] = time();
            $message = array_replace($message, $data['message']);
            $arr[] = $message;

            $page->slider_text = serialize($arr);
            if ($page->save()) {
                Session::put('success', '1');
            } else {
                Session::flash('save', 'failed');
                Session::put('fail', '1');
            }

        } else {
            var_dump('Wrong captcha');
            var_dump($response);
            Session::put('fail', '1');
            Session::flash('captcha', 'failed');
        }
        return Redirect::back();
    }

    // Add aplicant
    public function Addapplicant()
    {
        if (Request::isMethod('post')) {
            // Принимаем данные
            $data = Input::all();

            foreach ($data as $key => $item) {
                if (!isset($item) || empty($item)) {
                    //print_r($data);die();
                    Session::put('fail', 'empty');
                    return Redirect::back();
                }
            }

            $captchaData = array(
//            "secret" => "6Lf05gUTAAAAAHj1kPrRYmmjwzVFh2hnO_ZQw8q0",
                "secret" => '6LeonSEUAAAAAGN3lVpN8a789cQDrzY7fjefjsC4',
                "response" => $data['g-recaptcha-response']
            );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($captchaData));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
            curl_close($verify);

// if captcha is OK
            if (preg_match('/true/', $response)) {
                $page = Page::where('page', '=', 'applicants')->firstOrFail();
                $arr = [];
                if (!empty($page->slider_text)) {
                    $arr = unserialize($page->slider_text);
                }
                // File
                $file = '';
                // If isset img
                if (!empty($data['cv'])) {
                    $name = Input::file('cv')->getClientOriginalName();
                    $size = Input::file('cv')->getSize();
                    if ($size > 2097152) {
                        Session::put('size', 'size');
                        return Redirect::back();
                    }

                    if (!preg_match('/.jpg|.dot|.docx|.doc|.docm|.jpeg|.rtf|.pdf$/', $name)) {
                        Session::put('ext', 'ext');
                        return Redirect::back();
                    }

                    $destinationPath = base_path() . "/images/";
                    Input::file('cv')->move($destinationPath, $destinationPath . $name);
                    $file = "../images/" . $name;
                }


                $arr[] = [
                    'name' => isset($data['name']) ? $data['name'] : '',
                    'birth' => isset($data['birth']) ? $data['birth'] : '',
                    'email' => isset($data['email']) ? $data['email'] : '',
                    'phone' => isset($data['phone']) ? $data['phone'] : '',
                    'address' => isset($data['address']) ? $data['address'] : '',
                    'city' => isset($data['city']) ? $data['city'] : '',
                    'postcode' => isset($data['postcode']) ? $data['postcode'] : '',
                    'state' => isset($data['state']) ? $data['state'] : '',
                    'country' => isset($data['country']) ? $data['country'] : '',
                    'level' => isset($data['level']) ? $data['level'] : '',
                    'cv' => $file,
                    'date' => time(),
                    'position' => isset($data['position']) ? $data['position'] : '',
                    'location' => isset($data['location']) ? $data['location'] : ''
                ];
                $page->slider_text = serialize($arr);
                if ($page->save())
                    Session::put('success', '1');
                else
                    Session::put('fail', 'empty');
            }

        }
        return Redirect::to('vacancy');
    }

    public function get_state($country_id)
    {
        return DB::table("states")->where('country_id', $country_id)->orderBy('name', 'asc')->get();
    }
}
