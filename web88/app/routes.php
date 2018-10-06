<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Index page
Route::get('/', function () {
    return View::make('newsletter.index');
});

// Page about
Route::get('about', function () {
    $data = Page::where('page', '=', 'about')->firstOrFail();
    $image = unserialize($data->bgimage);
    $abbgimage = substr($image['image'], 3);
    $item = unserialize($data->slider_text);
    $about = unserialize($data->old_content);
    return View::make('about.index')->with(['textslider' => $item, 'abbgimage' => $abbgimage, 'about' => $about]);
});

// Preview about
Route::get('about-preview', function () {
    $data = Page::where('page', '=', 'about')->firstOrFail();
    $image = unserialize($data->bgimage);
    $abbgimage = substr($image['image'], 3);
    $item = unserialize($data->slider_text);
    $about = unserialize($data->old_content);
    return View::make('about.index')->with(['textslider' => $item, 'abbgimage' => $abbgimage, 'about' => $about]);

    /*
    $data = Page::where('page', '=', 'about')->firstOrFail();
    $data->bgimage = unserialize($data->bgimage);
        $data->slider_text = unserialize($data->slider_text);
        // Insert slider
        $image = "none";
        if(isset($data->bgimage['image']) && !empty($data->bgimage['image']))
            $image = substr($data->bgimage['image'], 3);
        $slider = '<style>#testimonials-section{background-image:url("' . $image . '")}</style><div id="testimonials-section"><div class="container"><div class="row"><div class="col-md-8 col-md-offset-2"><h1>Objective</h1><p class="line">&nbsp;</p><div class="about-us-testimonials flexslider"><ul class="slides">';
        if(isset($data->slider_text) && !empty($data->slider_text)){
            foreach($data->slider_text as $index => $item){
                if($item['active'])
                    $slider .= '<li><h2>' . $item['title'] . '</h2></li>';
            }
        }
        $slider .= '</ul></div></div></div></div></div><div class="xlg-margin"></div>';

        $data->new_content = str_replace("[~+Slider+~]", $slider, $data->new_content);
    return View::make('about.preview')->with( 'data', $data );
    */
});

/******************************************** Services **********************************************/

Route::get('services', function () {
    $data = DB::table('pages')->where('page', 'services')->first();
    $item = json_decode($data->new_content, true);
    return View::make('services.index')->with('data', $item);
});

Route::get('services-preview', function () {
    $data = DB::table('pages')->where('page', 'services')->first();
    $item = unserialize($data->new_content);
    $callbackToHtml = function (&$value, $key) {
        $value = html_entity_decode(html_entity_decode($value));
        $value = stripslashes($value);
    };
    array_walk_recursive($item, $callbackToHtml);
    return View::make('services.preview')->with('data', $item);
});

/******************************************** Contact **********************************************/

Route::get('contact', function () {
    $data = DB::table('pages')->where('page', 'contact')->first();

    $item = unserialize($data->old_content);
    return View::make('contact.index')->with('data', $item);
});

Route::post('contact', 'AdminController@postFeedback');

Route::get('contact-preview', function () {
    $data = DB::table('pages')->where('page', 'contact')->first();
    $item = unserialize($data->new_content);
    return View::make('contact.preview')->with('data', $item);
});

/******************************************** Stores **********************************************/

Route::get('stores', function () {
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
    //print_r($stores);die();
    return View::make('stores.index')->with(['data' => $item, 'stores' => $stores, 'names' => $names]);
});

Route::get('stores-preview', function () {
    $data = DB::table('pages')->where('page', 'stores')->first();
    $item = unserialize($data->new_content);
    $stores = [];
    if (!empty($data->slider_text)) {
        $stores = unserialize($data->slider_text);
        foreach ($stores as $key => $value) {
            $location = Location::find((int)$value['state']);
            $stores[$key]['location'] = $location->state;
        }
    }

    return View::make('stores.preview')->with(['data' => $item, 'stores' => $stores]);
});

/******************************************** Vacancy **********************************************/

Route::any('vacancy', function () {
    // Load Main Menu Categories from shop.tbm.com.my
    $categories = Categories::getCategories();
//dd($categories); die;

    $data = DB::table('pages')->where('page', 'vacancy')->first();
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
    return View::make('vacancy.index')->with([
        'categories' => $categories,
        'url_tbm' => 'http://shops3.tbm.com.my/shop',        // 'http://shop.tbm.com.my'
        'data' => $header,
        'vacancy' => $vacancy,
        'list_location' => $list_location,
        'list_title' => $list_title,
        'info' => $info,
    ]);
});

Route::any('vacancy-preview', function () {
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

    return View::make('vacancy.preview')->with([
        //	'shop_categories' => $categories,
        'page_title' => 'Careers',
        'url_tbm' => 'http://shops3.tbm.com.my/shop',        // 'http://shop.tbm.com.my'
        'data' => $header,
        'vacancy' => $vacancy,
        'list_location' => $list_location,
        'list_title' => $list_title,
        'info' => $info,
    ]);
});

// Settings

Route::post('admin/addapplicant', 'AdminController@Addapplicant');
Route::any('admin/forgot_password', 'AdminController@Newpassword');
Route::get('admin/forgot/{data}', 'AdminController@Forgot');


Route::get('admin/postEditobj', 'AdminController@postEditobj');
Route::post('admin/bgimage', 'AdminController@postBgimage');

/*
Route::get('admin/refresh_array', function(){
	$page = Page::where('page', '=', 'footer_setup')->firstOrFail();
	$arr = [];
	$new_arr['copyright'] = ['copyright' => 'В© 2014 Tan Boon Ming Sdn Bhd (494355-D). All Rights Reserved.'];
	$new_arr['image'] =  ['active' => '1', 'title' => 'bg image', 'fg' => 'footer_bg2.jpg'];
	$new_arr['icon'][] =  ['active' => '1', 'title' => 'Facebook', 'icon' => 'icon-facebook', 'link' => 'http://facebook.com'];
	$page->slider_text = serialize($new_arr);
	if($page->save())
		echo "OK";
});
*/

// Exit Admin
Route::get('admin/logout', function () {
    Auth::logout();
    return Redirect::to('admin/login');
});

// Page login for Admin
Route::any('admin/login', 'AdminController@login');

// admins
Route::group(array('before' => 'admin.auth'), function () {
    Route::any('admin/header_setup', 'AdminController@Headersetup');
    Route::any('admin/footer_setup', 'AdminController@Footersetup');
    Route::any('admin/bottom_animated_services_list', 'AdminController@Animatedlist');
    Route::any('admin/newsletter_subscription_list', 'AdminController@Newsletter');

    Route::post('admin/addvacancy', 'AdminController@postAddvacancy');
    Route::post('admin/editvacancy', 'AdminController@postEditvacancy');

    Route::post('admin/TermCondition', 'AdminController@postTermCondition');
    Route::get('admin/UpdateServices', 'AdminController@getUpdateServices');

    Route::controller('admin', 'AdminController');
});

// admins login filter
Route::filter('admin.auth', function () {
    if (Auth::guest()) {
        return Redirect::to('admin/login');
    }
});


