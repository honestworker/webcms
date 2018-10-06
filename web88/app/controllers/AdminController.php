<?php

class AdminController extends BaseController
{

    public function login()
    {
        if (Auth::check()) {
            return Redirect::to('admin/dashboard');
        }

        if (Request::isMethod('post')) {
            /*
            // Login as first user
            $user = DB::table('users')->first();
            //echo '<pre>'; var_dump($user); echo '</pre>'; exit;
            Auth::login(new \Illuminate\Auth\GenericUser((array) $user));
            return Redirect::to('admin/dashboard');

            */

            $data = Input::all();


            $rules = [
                'email' => 'required|email|min:3',
                'password' => 'required|min:3'
            ];

            $val = Validator::make($data, $rules);

            if ($val->fails()) {
                return View::make('admin.login')->with(['error' => ['validate' => 0]]);
            }

            if (!Auth::check())
                $user = User::login($data);
            else
                $user = Auth::user();

//echo '<pre>'; var_dump($data, $user, Config::get('database')); echo '</pre>'; exit;
            if (!$user) {

                return View::make('admin.login')->with(['error' => ['login' => 0]]);
            }

            return Redirect::intended('admin/dashboard');
        } else {
            return View::make('admin.login');
        }
    }

    // Page About
    public function anyAbout()
    {
        if (Request::isMethod('post')) {
            try {
                $data = Input::all();
// revert to original
                $search = '<div id="page-header"';
                if (substr($data['about']['title'], 0, strlen($search)) != $search) {
                    $data['about']['title'] = '<div id="page-header"><h1>About Us</h1><p><br></p><h2>Improve people\'s lifestyle by providing high class retail experience</h2><p><br></p></div>';
                }
//dd($data['about']['title']);

                //print_r($data);die();
                $page = Page::where('page', '=', 'about')->firstOrFail();
                $content = serialize($data['about']);

                if ($data['type'] === 'preview') {
                    $page->new_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                    return Redirect::to('about-preview');
                } else if ($data['type'] === 'publish') {
                    $page->new_content = $content;
                    $page->old_content = $content;
                    $page->edit_content = $content;
                }

                if ($page->save()) {
                    Session::put('success', '1');
                } else {
                    Session::put('fail', '1');
                }

                return Redirect::back();
            } catch (Exception $e) {
                Session::put('fail', '1');
                return $e;
                return Redirect::back();
            }
        }

        $data = DB::table('pages')->where('page', 'about')->first();
        $about = [];
        $times = $data->updated_at;
        if (!empty($data->edit_content))
            $about = unserialize($data->edit_content);
//dd($about['title']);
        $item = [];
        if (!empty($data->slider_text))
            $item = unserialize($data->slider_text);
        if (!empty($data->bgimage))
            $bgimg = unserialize($data->bgimage);
        //print_r($about);die();
//dd($about);
        return View::make('admin.about')->with(['about' => $about, 'data' => $item, 'bgimg' => $bgimg, 'times' => $times]);
    }

    // Change photo
    public function postPhoto()
    {
        $data = Input::all();
        $file = Input::file('photo');
        // Size photo
        if (isset($file) && !empty($file)) {
            $info = getimagesize($file);
            if ((int)$info[0] > 100 || (int)$info[1] > 100) {
                Session::put('fail', '1');
                return Redirect::back();
            }

        }

        $rules = [
            'photo' => 'image|max:2048'
        ];
        $val = Validator::make($data, $rules);

        if ($val->fails()) {
            Session::put('fail', '1');
            return Redirect::back();
        }
        $user = User::addPhoto($data);
        if (!$user instanceof Illuminate\Database\Eloquent\Model)
            Session::put('fail', '1');
        else
            Session::put('success', '1');
        return Redirect::back();
    }

    // Change Background
    public function postBgimage()
    {
        $data = Input::all();
        $file = Input::file('bgimage');

        /*
                // Size photo
                if (isset($file) && !empty($file)) {
                    $info = getimagesize($file);
                    if ((int)$info[0] > 1543 || (int)$info[1] > 600) {
                        Session::put('fail', '1');
                        return Redirect::back();
                    }
                }
        */

        $rules = [
            'photo' => 'image|max:1024',
            'page' => 'required',
            'title' => 'required|max:300'
        ];
        $val = Validator::make($data, $rules);

        if ($val->fails()) {
            Session::put('fail', '1');
            return Redirect::back();
        }
        $data['page'] = trim(htmlspecialchars($data['page']));

        $page = Page::upBgImage($data);
        if (!$page instanceof Illuminate\Database\Eloquent\Model)
            Session::put('fail', '1');
        else
            Session::put('success', '1');
        return Redirect::back();
    }

    // Add Objective
    public function postObjtext()
    {
        $data = Input::all();
        $rules = [
            'title' => 'required',
            'page' => 'required'
        ];

        $val = Validator::make($data, $rules);
        if ($val->fails()) {
            Session::put('fail', '1');
            return Redirect::back();
        }
        $data['page'] = trim(htmlspecialchars($data['page']));
        $page = Page::addObjective($data);
        if (!$page instanceof Illuminate\Database\Eloquent\Model)
            Session::put('fail', '1');
        else
            Session::put('success', '1');
        return Redirect::back();
    }

    // Edit Objective
    public function postEditobj()
    {
        $data = Input::all();
        $rules = [
            'text' => 'required',
            'page' => 'required',
            'index' => 'required'
        ];

        $val = Validator::make($data, $rules);
        if ($val->fails()) {
            Session::put('fail', '1');
            return Redirect::back();
        }
        $data['page'] = trim(htmlspecialchars($data['page']));
        $data['index'] = (int)$data['index'];
        $page = Page::editObjective($data);
        if (!$page instanceof Illuminate\Database\Eloquent\Model)
            Session::put('fail', '1');
        else
            Session::put('success', '1');
        return Redirect::back();
    }

    // Delete one objective
    public function postDeloneobj()
    {
        $data = Input::all();
        $rules = [
            'page' => 'required',
            'index' => 'required'
        ];
        $val = Validator::make($data, $rules);
        if ($val->fails()) {
            Session::put('fail', '1');
            return Redirect::back();
        }
        $page = Page::where('page', '=', $data['page'])->firstOrFail();
        $arr = unserialize($page->slider_text);
        if (array_key_exists('type', $data)) {
            unset($arr[$data['type']][(int)$data['index']]);
            $arr[$data['type']] = array_values($arr[$data['type']]);
            //sort($arr[$data['type']]);
            //usort($arr, array('AdminController', 'Datesort'));
        } else {
            unset($arr[(int)$data['index']]);
            //	$arr[(int)$data['index']] = array_values($arr[(int)$data['index']]);
            $arr1 = array_values($arr);
            //sort($arr);
            //usort($arr, array('AdminController', 'Datesort'));
        }
        //usort($arr, array('AdminController', 'Datesort'));
        $page->slider_text = serialize($arr);
        $page->save();
        Session::put('success', '1');
        return Redirect::back();
    }

    // Delete all and selected objective
    public function postDeleteobj()
    {
        $data = Input::all();
        $rules = [
            'page' => 'required',
            'index' => 'required'
        ];
        $val = Validator::make($data, $rules);
        if ($val->fails()) {
            Session::put('fail', '1');
            return Redirect::back();
        }
        $page = Page::where('page', '=', $data['page'])->firstOrFail();
        $arr = unserialize($page->slider_text);
        if ($data['index'] === 'all') {
            if (array_key_exists('type', $data)) {
                $arr[$data['type']] = [];
                $page->slider_text = serialize($arr);
            } else {
                $arr = [];
                $page->slider_text = serialize($arr);
            }
        } else {
            // Clean corrupted DB for footer_setup
            if ($data['page'] == 'footer_setup' and isset($arr[0])) {
//echo '<pre>'; var_dump($data, $arr); echo '</pre>';
                $arr['copyright'] = $arr[0];
                unset($arr[0]);
                $arr['image'] = $arr[1];
                unset($arr[1]);
                $arr['icon'] = $arr[2];
                unset($arr[2]);
            }

            $indexes = explode(',', trim($data['index'], ','));
            if (is_array($indexes)) {
                foreach ($indexes as $one) {
                    if (array_key_exists('type', $data)) {
                        unset($arr[$data['type']][$one]);
                    } else {
                        unset($arr[$one]);
                    }
                }
                /*
                if(array_key_exists('type', $data)){
                    sort($arr[$data['type']]);
                    }else{
                    sort($arr);
                    }
                */
                //usort($arr, array('AdminController', 'Datesort'));
                //$arr = array_values($arr);
                if (array_key_exists('type', $data)) {
                    $arr[$data['type']] = array_values($arr[$data['type']]);
                } else {
                    $key = (int)$data['index'];
                    if (array_key_exists($key, $arr)) {
                        $arr[$key] = array_values($arr[$key]);
                    }
                }
//echo '<pre>'; var_dump($arr); echo '</pre>'; exit;
                $page->slider_text = serialize($arr);
            }
        }
        $page->save();
        Session::put('success', '1');
        return Redirect::back();
    }

    // Change password
    public function postPassword()
    {

        $data = Input::all();
        $rules = [
            'password' => 'required|min:6|max:12',
            'repeat_password' => 'required|same:password',
        ];
        $val = Validator::make($data, $rules);

        if ($val->fails()) {
            Session::put('fail', '1');
            return Redirect::back();
        }
        $user = User::changePassword($data);
        if (!$user instanceof Illuminate\Database\Eloquent\Model)
            Session::put('fail', '1');
        else
            Session::put('success', '1');
        return Redirect::back();

    }

    // Insert About
    public function anyInsert()
    {
        if (Request::ajax()) {
            $page = Page::where('page', '=', $_POST['name'])->firstOrFail();

            switch ($_POST['type']) {
                case "preview" :
                    $page->new_content = trim($_POST['page']);
                    break;
                case "publish" :
                    $page->old_content = trim($_POST['page']);
                    break;
            }

            $page->edit_content = trim($_POST['settings']);
            if ($page->save())
                return "OK";
        }
    }

    public function getIcon()
    {
        return View::make('admin.icon');
    }

    /****************************** Services ***********************************/

    public function anyServices()
    {
        ini_set('mbstring.internal_encoding','UTF-8');
        ini_set('mbstring.func_overload',7);
        header('Content-Type: text/html; charset=UTF-8');

        $callbackToHtml = function (&$value, $key) {
            $value = html_entity_decode(html_entity_decode($value));
            $value = stripslashes($value);
        };
        if (Request::isMethod('post')) {
            $callbackToEntities = function (&$value, $key) {
                $value = addslashes(utf8_encode($value));
                $value = htmlentities(htmlentities($value,  ENT_COMPAT, 'UTF-8'), ENT_COMPAT, 'UTF-8');
            };

            $data = Input::all();
            try {
                foreach ($data['icon'] as $key => $item) {
                    foreach ($item as $type => $string) {
                        $data['icon'][$key][$type] = base64_decode($string);
                    }
                }
                $data['header'] = addslashes(base64_decode($data['header']));
                array_walk_recursive($data, $callbackToEntities);

                $page = Page::where('page', '=', 'services')->firstOrFail();
                $arr = ['header' => $data['header'], 'icon' => $data['icon']];

                $content = serialize($arr);
                $decoded = unserialize($content);

                if ($content === false) {
                    Session::put('fail', '1');
                } else if ($data['type'] === 'preview' && !empty($decoded)) {
                    $page->new_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                    return Redirect::to('services-preview');
                } else if ($data['type'] === 'publish' && !empty($decoded)) {
                    $savedNotProperly = true;
                    while ($savedNotProperly) {
                        $page->new_content = $content;
                        $page->old_content = $content;
                        $page->edit_content = $content;
                        $page->save();

                        $data = DB::table('pages')->where('page', 'services')->first();

                        $item = unserialize($data->edit_content);
                        if (empty($item)) {
                            $content = serialize($arr);
                            $savedNotProperly = true;
                        } else {
                            $savedNotProperly = false;
                        }
                    }
                }
            } catch (Exception $e) {
                var_dump($e->getMessage());
                $data = DB::table('pages')->where('page', 'services')->first();
                $item = unserialize($data->edit_content);
                array_walk_recursive($item, $callbackToHtml);

                $item['updated_at'] = $data->updated_at;
                Session::put('fail', '1');
                return View::make('admin.services')->with('data', $item);
            }
            Session::put('success', '1');
            return Redirect::back();
        }

        $data = DB::table('pages')->where('page', 'services')->first();

        $item = unserialize($data->edit_content);
        if (empty($item)) {
            dd($data->edit_content);
        }
        array_walk_recursive($item, $callbackToHtml);

        if (!isset($item['header'])) {
            $item['header'] = '';
        }
        $item['updated_at'] = $data->updated_at;
        return View::make('admin.services')->with('data', $item);
    }


    public function getUpdateServices()
    {

        $stringBig = 'a:2:{s:6:"header";s:1993:"<!--{cke_protected}{C}%3C!%2D%2D%3Cdiv%20id%3D%22page-header%22%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Ch1%3EOur%20Services%3C%2Fh1%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cdiv%20class%3D%22sm-margin%22%3E%3C%2Fdiv%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Ch2%3EThe%20TBM%20Shopping%20Experience%3C%2Fh2%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cp%20class%3D%22line%22%3E%26nbsp%3B%3C%2Fp%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fdiv%3E%2D%2D%3E--><!--{cke_protected}{C}%3C!%2D%2D%3Cdiv%20id%3D%22page-header%22%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Ch1%3EOur%20Services%3C%2Fh1%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cdiv%20class%3D%22sm-margin%22%3E%3C%2Fdiv%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Ch2%3EThe%20TBM%20Shopping%20Experience%3C%2Fh2%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cp%20class%3D%22line%22%3E%26nbsp%3B%3C%2Fp%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fdiv%3E%2D%2D%3E--><!--{cke_protected}{C}%3C!%2D%2D%3Cdiv%20id%3D%22page-header%22%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Ch1%3EOur%20Services%3C%2Fh1%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cdiv%20class%3D%22sm-margin%22%3E%3C%2Fdiv%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Ch2%3EThe%20TBM%20Shopping%20Experience%3C%2Fh2%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cp%20class%3D%22line%22%3E%26nbsp%3B%3C%2Fp%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fdiv%3E%2D%2D%3E--><div><h1>Our Services</h1><div><br></div><h2>The TBM Shopping Experience</h2><p><br></p></div>";s:4:"icon";a:7:{i:0;a:4:{s:3:"img";s:2328:"
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
                                        <a href="#" data-placement="top" data-target="#modal-edit-icon" data-toggle="modal" title="Edit">
                                        	<div class="circle"><i class="fa fa-truck"></i></div>
                                        </a>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"title";s:1193:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h3>Delivery & Installation hamza</h3>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:8:"sm-descr";s:1305:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<p>We deliver your goods to where you want it to be and install it the way it should be.</p><p>safasfasdfasdfasdfasdfasfsadfffffffffffffffffffffff</p>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"descr";s:1523:"
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <h4>Delivery & Installation</h4><ul><li><strong>Free delivery</strong> will be available within Klang Valley for large item. This is Chrome Test </li><li><strong>Same day delivery</strong> has to be requested at the point of purchase and is subjected to the availability of transporter.</li><li>ss</li></ul>
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     ";}i:1;a:4:{s:3:"img";s:3604:"
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <a href="#" data-placement="top" data-target="#modal-edit-icon" data-toggle="modal" title="Edit">
                                        	<div class="circle"><i class="fa  icon-comment"></i></div>
                                        </a>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"title";s:1191:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h3>Product Reservation Updated</h3>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:8:"sm-descr";s:1325:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<p>We can keep your order for you and deliver your purchase when you are ready. Meanwhile, we will also update you if there is a newer version of the purchased model.</p>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"descr";s:1341:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h4>Product Reservation Updated<br></h4><ul><li>Ordered items can be reserved up to THREE months. </li></ul>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";}i:2;a:4:{s:3:"img";s:3606:"
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                         <a href="#" data-placement="top" data-target="#modal-edit-icon" data-toggle="modal" title="Edit">
                                        	<div class="circle"><i class="fa icon-code-fork"></i></div>
                                        </a>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"title";s:1192:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h3>Credit Card Point Redemption</h3>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:8:"sm-descr";s:1257:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<p>We can help you to spend less. Earn and redeem your Credit Card or Genting Rewards points here!</p>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"descr";s:1770:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h4>Credit Card Point Redemption</h4><ul><li><strong>Credit card points</strong> are earned automatically according to bank terms for any payment with a credit card</li><li><strong>Genting Rewards points</strong> can be earned by presenting Membership card at the point of purchase.</li><li>You are allowed to fully or partially redeem items with<ul><li>Credit card points from specific banks, or</li><li>Genting Rewards points</li></ul></li><li>Conversion rate of points when earning or redeeming is solely based on bank terms.</li></ul>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";}i:3;a:4:{s:3:"img";s:3600:"
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                         <a href="#" data-placement="top" data-target="#modal-edit-icon" data-toggle="modal" title="Edit">
                                        	<div class="circle"><i class="fa fa-money"></i></div>
                                        </a>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"title";s:1188:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h3>Instalment Plans changed</h3>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:8:"sm-descr";s:1315:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<p>We can understand how much you need something and we can help you with your finances. Bring your purchase home today and worry about your payments later.</p>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"descr";s:1744:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h4>Instalment Plans</h4><ul><li><strong>Interest-free instalment plans</strong> are available for payment with credit cards from selected banks.</li><li>You are responsible to provide all necessary documentation for the application of instalment plans or personal loans from third-party financial institutions.</li><li>The application of instalment plans or personal loans is subjected to the procedures, requirements, terms and conditions set by respective financing institutions. The approval of such applications is based on the sole discretion of the financing institutions.</li></ul>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";}i:4;a:4:{s:3:"img";s:3600:"
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <a href="#" data-placement="top" data-target="#modal-edit-icon" data-toggle="modal" title="Edit">
                                        	<div class="circle"><i class="fa fa-shield"></i></div>
                                        </a>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"title";s:1181:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h3>Extended Warranty</h3>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:8:"sm-descr";s:1337:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<p>We treat your purchase like an investment. We want to help you buy a piece of mind against manufacturing defects by extending the warranty on your product to up to five years.</p>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"descr";s:1640:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h4>Extended Warranty</h4><ul><li>You may extend the warranty of products from selected categories for up to 5 years at the point of purchase.</li><li>You may choose to add an<ul><li>Extended Warranty (up to 5 years), or</li><li>All risk insurance</li></ul> to your product from selected categories.</li><li>Original purchase receipt and Certificate of Extended Warranty must be presented for any claims or repair services. Kindly visit or contact our outlets for assistance.</li></ul>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";}i:5;a:4:{s:3:"img";s:3601:"
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <a href="#" data-placement="top" data-target="#modal-edit-icon" data-toggle="modal" title="Edit">
                                        	<div class="circle"><i class="fa fa-refresh"></i></div>
                                       	</a>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"title";s:1180:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h3>Product Exchange</h3>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:8:"sm-descr";s:1280:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<p>It is our duty to help you make the right purchase. If you did not, just let us know and we shall exchange it for you.</p>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"descr";s:2697:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h4>Product Exchange</h4><ul><li>Products can be exchanged within 10 days of purchase ONLY IF it is in complete and brand new condition (with its original packaging, accessories, user manual and warranty card). All free gifts and vouchers associated with the purchased must also be returned.</li><li>Original purchase receipt must be presented at the point of exchange. Only one exchange is allowed per purchase unless the exchanged product is faulty.</li><li>Delivery charges may apply for exchange that requires additional delivery services.</li><li>The following products are not exchangeable<ul><li>Once used: All electrical appliances (including, but not limited to, kitchen, beauty & healthcare, digital, home appliances), I.T. and telecommunication products, and Consumables</li><li>Once installed: Air conditioner, Wall-mounted TV, Built-in appliances, Accessories and Consumables.</li><li>Once sold: Display set</li></ul></li></ul><div><br></div><h4>Refund</h4><ul><li>All refund or cancellation will be made in the following forms:<ul><li>Credit Card Payment: Cancellation of credit card transaction.</li><li>Other payment methods with amount of RM500 or less: Refund by cash.</li><li>Other payment methods with amount above RM500: Refund by cheque.</li></ul></li><li>Refund or cancellation of order is not applicable to special orders and display sets.</li><li>Delivery and installation charges are not refundable if the service has taken place.</li><li>Terms and conditions pertaining to Product Exchange are applicable.</li></ul>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";}i:6;a:4:{s:3:"img";s:3601:"
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <a href="#" data-placement="top" data-target="#modal-edit-icon" data-toggle="modal" title="Edit">
                                        	<div class="circle"><i class="fa icon-globe"></i></div>
                                        </a>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"title";s:1189:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h3>Accessories & Spare Parts</h3>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:8:"sm-descr";s:1293:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<p>We care about the maintenance of your product in the long run. Contact us directly if you need to replace any parts or accessories.</p>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";s:5:"descr";s:1734:"
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	
                                    	<h4>Accessories & Spare Parts</h4><ul><li>The availability and lead time to deliver specific accessories and spare parts is subjected to its supply in the market and by the manufacturer.</li><li>You are required to provide the exact brand and model of the product in order to obtain the correct parts. It is strongly recommended to show the actual part to be replaced, if possible, in order to ensure that the correct accessories or spare part is being ordered.</li><li>Special orders of accessories and spare parts is not allowed to be cancelled, returned or refunded.</li></ul>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    ";}}}';
        $stringBig = unserialize($stringBig);
        $callback = function (&$value, $key) {
            $value = htmlentities(htmlentities($value));
        };

        array_walk_recursive($stringBig, $callback);

        $stringBig = serialize($stringBig);

        $data = DB::table('pages')->where('page', 'services')->update(['edit_content' => $stringBig]);

        return $data;
    }

    public function postTermCondition()
    {
        $data = Input::all();

        $data['content'] = base64_decode($data['content']);
        $page = Page::where('page', '=', 'services')->firstOrFail();
        $content = unserialize($page->new_content);
        if (isset($content['icon'][$data['term_id']]['descr'])) {
            $content['icon'][$data['term_id']]['descr'] = $data['content'];
            $page->new_content = serialize($content);
            $page->edit_content = serialize($content);
            $page->old_content = serialize($content);
            $page->save();
            return ['status' => 'success'];
        } else {
            return ['status' => 'failed'];
        }
    }

    /****************************** Contact ***********************************/

    public
    function anyContact()
    {
        if (Request::isMethod('post')) {
            $data = Input::all();

            try {
                $page = Page::where('page', '=', 'contact')->firstOrFail();
                $arr = $data['contacts'];
                $content = serialize($arr);
                if ($data['type'] === 'preview') {
                    $page->new_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                    return Redirect::to('contact-preview');
                } else if ($data['type'] === 'publish') {
                    $page->new_content = $content;
                    $page->old_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                }
            } catch (Exception $e) {
                Session::put('fail', '1');
                //return $e;
                return Redirect::back();
            }
            Session::put('success', '1');
            return Redirect::back();
        }
        $data = DB::table('pages')->where('page', 'contact')->first();
        $item = unserialize($data->edit_content);
        $item['updated_at'] = $data->updated_at;
        $feedback = '';
        if (!empty($data->slider_text)) {
            $feedback = unserialize($data->slider_text);
            $feedback = array_reverse($feedback, true);
        }
        //print_r($feedback);die();
        return View::make('admin.contact')->with(['data' => $item, 'feedback' => $feedback]);
    }

    public
    function postFeedback()
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

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $post_data = array(
            "secret" => "6Lf05gUTAAAAAHj1kPrRYmmjwzVFh2hnO_ZQw8q0",
            "response" => $data['g-recaptcha-response']
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// указываем, что у нас POST запрос
        curl_setopt($ch, CURLOPT_POST, 1);
// добавляем переменные
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $output = curl_exec($ch);

        curl_close($ch);

        if (preg_match('/true/', $output)) {
            $page = Page::where('page', '=', 'contact')->firstOrFail();
            $arr = [];
            if (!empty($page->slider_text)) {
                $arr = unserialize($page->slider_text);
            }
            $data['message']['time'] = time();
            $arr[] = $data['message'];
            $page->slider_text = serialize($arr);
            if ($page->save()) {
                dd('aaa');
                Session::put('success', '1');
            } else
                Session::put('fail', '1');
        } else {
            Session::put('fail', '1');
        }
        return Redirect::back();
    }

    /****************************** Stores ***********************************/

    public
    function anyStores()
    {

        if (Request::isMethod('post')) {
            $data = Input::all();

            try {
                $page = Page::where('page', '=', 'stores')->firstOrFail();
                $arr = $data['stores'];
                $content = serialize($arr);
                if ($data['type'] === 'preview') {
                    $page->new_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                    return Redirect::to('stores-preview');
                } else if ($data['type'] === 'publish') {
                    $page->new_content = $content;
                    $page->old_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                }
            } catch (Exception $e) {
                Session::put('fail', '1');
                //return $e;
                return Redirect::back();
            }
            Session::put('success', '1');
            return Redirect::back();
        }

        $data = DB::table('pages')->where('page', 'stores')->first();
        $item = unserialize($data->edit_content);
        $item['updated_at'] = $data->updated_at;
        $stores = [];
        if (!empty($data->slider_text)) {
            $stores = unserialize($data->slider_text);
            foreach ($stores as $key => $value) {
                $location = Location::find((int)$value['state']);
                $stores[$key]['location'] = $location->state;
            }
        }

        return View::make('admin.stores')->with(['data' => $item, 'stores' => $stores]);
    }

    public
    function postAddstore()
    {
        try {
            $data = Input::all();

            //print_r($data);die();
            foreach ($data["store"] as $key => $item) {

                if ($key == 'info') $data["store"]['info'] = base64_decode($item);  //

                if ($key == 'time') $data["store"]['time'] = base64_decode($item);

                if ($key === 'new_state' && !empty($data["store"]['new_state'])) {
                    $id = DB::table('locations')->insertGetId(array('state' => $item));
                    $data["store"]['state'] = $id;
                    continue;
                }
                if ($key === 'map' || $key === 'new_state')
                    continue;
                if (!isset($item) || empty($item)) {
                    Session::put('fail', '1');
                    return Redirect::to('admin/stores');
                }
            }


            $page = Page::where('page', '=', $data['type'])->firstOrFail();
            $arr = [];
            if (!empty($page->slider_text)) {
                $arr = unserialize($page->slider_text);
            }
            $arr[] = $data['store'];
            $page->slider_text = serialize($arr);
            if ($page->save())
                Session::put('success', '1');
            else
                Session::put('fail', '1');


            return Redirect::to('admin/stores');
        } catch (Exception $e) {
            return Redirect::to('admin/stores');
        }

        // return Response::json(array('response' => $page->save()), 200);
    }


    public
    function anyEditstore()
    {
        $data = Input::all();
        foreach ($data["store"] as $key => $item) {

            if ($key == 'info') $data["store"]['info'] = base64_decode($item);

            if ($key == 'time') $data["store"]['time'] = base64_decode($item);


            if ($key === 'new_state' && !empty($data["store"]['new_state'])) {
                $id = DB::table('locations')->insertGetId(array('state' => $item));
                $data["store"]['state'] = $id;
                continue;
            }
            if ($key === 'map' || $key === 'new_state')
                continue;
            if (!isset($item) || empty($item)) {
                Session::put('fail', '1');
                return Redirect::back();
            }
        }


        $page = Page::where('page', '=', $data['type'])->firstOrFail();
        $arr = [];
        if (!empty($page->slider_text)) {
            $arr = unserialize($page->slider_text);
        }
        $arr[(int)$data['key']] = $data['store'];
        $page->slider_text = serialize($arr);
        if ($page->save())
            Session::put('success', '1');
        else
            Session::put('fail', '1');
        return Redirect::back();
    }

    /****************************** Careers ***********************************/

    public
    function anyVacancy()
    {

        if (Request::isMethod('post')) {
            $data = Input::all();

            try {
                $page = Page::where('page', '=', 'vacancy')->firstOrFail();
                $arr = $data['vacancy'];
                $content = serialize($arr);
                if ($data['type'] === 'preview') {
                    $page->new_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                    return Redirect::to('vacancy-preview');
                } else if ($data['type'] === 'publish') {
                    $page->new_content = $content;
                    $page->old_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                }
            } catch (Exception $e) {
                Session::put('fail', '1');
                //return $e;
                return Redirect::back();
            }
            Session::put('success', '1');
            return Redirect::back();
        }

        $data = DB::table('pages')->where('page', 'vacancy')->first();
        $item = [];
        if (!empty($data->edit_content))
            $item = unserialize($data->edit_content);
        $item['updated_at'] = $data->updated_at;
        $vacancy = [];
        if (!empty($data->slider_text)) {

//            dd($data->id);
            $dataFromDb = 'a:8:{i:0;a:6:{s:6:"active";s:1:"1";s:5:"title";s:18:"Service Technician";s:8:"location";s:16:"Jalan Klang Lama";s:4:"date";s:10:"2015/05/27";s:11:"requirement";s:118:"<ul class="contact-details-list fa-ul"><li>Basic computer skills<br></li><li>SPM qualification or equivalent</li></ul>";s:9:"preferred";s:127:"<ul class="contact-details-list fa-ul"><li>2 years of related working experience or more</li><li>Possess Goods Driver</li></ul>";}i:1;a:6:{s:6:"active";s:1:"1";s:5:"title";s:20:"Warehouse Supervisor";s:8:"location";s:16:"Jalan Klang Lama";s:4:"date";s:10:"2015/05/30";s:11:"requirement";s:199:"<ul class="contact-details-list fa-ul"><li><i class="fa-li fa fa-check-square-o"></i> SPM qualification or equivalent</li><li><i class="fa-li fa fa-check-square-o"></i>Basic computer skills</li></ul>";s:9:"preferred";s:224:"<ul class="contact-details-list fa-ul"><li><i class="fa-li fa fa-check-square-o"></i> 1 year of related working experience or more<br></li><li><i class="fa-li fa fa-check-square-o"></i> Able to carry up to 30kg<br></li></ul>";}i:2;a:6:{s:6:"active";s:1:"1";s:5:"title";s:23:"Project Sales Executive";s:8:"location";s:16:"Jalan Klang Lama";s:4:"date";s:10:"2015/05/29";s:11:"requirement";s:316:"<ul class="contact-details-list fa-ul"><li><i class="fa-li fa fa-check-square-o"></i>College diploma qualification or equivalent<br></li><li><i class="fa-li fa fa-check-square-o"></i> Basic computer skills<br></li><li><i class="fa-li fa fa-check-square-o"></i> Able to communicate in multiple languages<br></li></ul>";s:9:"preferred";s:228:"<ul class="contact-details-list fa-ul"><li><i class="fa-li fa fa-check-square-o"></i> 1 year of related working experience or more<br></li><li><i class="fa-li fa fa-check-square-o"></i>Able to travel on own vehicle<br></li></ul>";}i:4;a:6:{s:6:"active";s:1:"1";s:5:"title";s:14:"Sale Executive";s:8:"location";s:48:"Jalan Klang Lama, KL Festival City (Wangsa Maju)";s:4:"date";s:10:"2015/05/24";s:11:"requirement";s:304:"<ul class="contact-details-list fa-ul"><li><i class="fa-li fa fa-check-square-o"></i> SPM qualification or equivalent<br></li><li><i class="fa-li fa fa-check-square-o"></i> Basic computer skills<br></li><li><i class="fa-li fa fa-check-square-o"></i>Able to communicate in multiple languages<br></li></ul>";s:9:"preferred";s:158:"<ul class="contact-details-list fa-ul"><li><i class="fa-li fa fa-check-square-o"></i> 1 year of related working experience or more<br></li><li> <br></li></ul>";}i:5;a:6:{s:6:"active";s:1:"1";s:5:"title";s:8:"asdfasdf";s:8:"location";s:8:"asdfasdf";s:4:"date";s:10:"2016/02/11";s:11:"requirement";s:493:"
                                      <ul class="contact-details-list fa-ul">

                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                      </ul>
                                      ";s:9:"preferred";s:493:"
                                      <ul class="contact-details-list fa-ul">

                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                      </ul>
                                      ";}i:6;a:6:{s:6:"active";s:1:"1";s:5:"title";s:15:"Sales Executive";s:8:"location";s:4:"KLCC";s:4:"date";s:10:"2016/03/02";s:11:"requirement";s:393:"<ul class="contact-details-list fa-ul">
	<li><i class="fa-li fa fa-check-square-o"></i><em class="fa fa-check-square-o fa-li"></em> Sample text11111</li>
	<li><i class="fa-li fa fa-check-square-o"></i><em class="fa fa-check-square-o fa-li"></em> Sample text11111</li>
	<li><i class="fa-li fa fa-check-square-o"></i><em class="fa fa-check-square-o fa-li"></em> Sample text11111</li>
</ul>
";s:9:"preferred";s:393:"<ul class="contact-details-list fa-ul">
	<li><i class="fa-li fa fa-check-square-o"></i><em class="fa fa-check-square-o fa-li"></em> Sample text1111</li>
	<li><i class="fa-li fa fa-check-square-o"></i><em class="fa fa-check-square-o fa-li"></em> Sample text11111</li>
	<li><i class="fa-li fa fa-check-square-o"></i><em class="fa fa-check-square-o fa-li"></em> Sample text111111</li>
</ul>
";}i:7;a:6:{s:6:"active";s:1:"1";s:5:"title";s:7:"asdfadf";s:8:"location";s:3:"asd";s:4:"date";s:10:"2016/02/29";s:11:"requirement";s:493:"
                                      <ul class="contact-details-list fa-ul">

                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                      </ul>
                                      ";s:9:"preferred";s:493:"
                                      <ul class="contact-details-list fa-ul">

                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                      </ul>
                                      ";}i:8;a:6:{s:6:"active";s:1:"1";s:5:"title";s:10:"dafadsfasd";s:8:"location";s:9:"fasdfasdf";s:4:"date";s:10:"2016/03/06";s:11:"requirement";s:493:"
                                      <ul class="contact-details-list fa-ul">

                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                      </ul>
                                      ";s:9:"preferred";s:493:"
                                      <ul class="contact-details-list fa-ul">

                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                            <li><i class="fa-li fa fa-check-square-o"></i> Sample text</li>
                                      </ul>
                                      ";}}';

//            $data = DB::table('pages')->where('id', '5')->update(array('slider_text' => $dataFromDb));
//
//            dd($data);
            /*$data->slider_text = $dataFromDb;

            DB::table('users')
                ->where('id', 1)
                ->update(array('votes' => 1));*/
            $vacancy = unserialize($data->slider_text);
//            $vacancy = unserialize($dataFromDb);
            krsort($vacancy);
        }

        return View::make('admin.vacancy')->with(['data' => $item, 'vacancy' => $vacancy]);
    }

    public
    function postAddvacancy()
    {

        try {
            $data = Input::all();

            foreach ($data["vacancy"] as $key => $item) {

                if ($key == 'requirement') $data['vacancy']['requirement'] = base64_decode($item);
                if ($key == 'preferred') $data['vacancy']['preferred'] = base64_decode($item);
                if ($key === 'date')
                    continue;
                if (!isset($item) || empty($item)) {
                    dd('empty');
                    Session::put('fail', '1');
                    return Redirect::to('admin/vacancy');
                }
            }
            // print_r($data);die();

            $page = Page::where('page', '=', $data['type'])->firstOrFail();
            $arr = [];
            if (!empty($page->slider_text)) {
                $arr = unserialize($page->slider_text);
            }
            $time = explode('/', $data['vacancy']['date']);
            $new_time = array_reverse($time);
            $data['vacancy']['date'] = implode('/', $new_time);
            $arr[] = $data['vacancy'];
            $page->slider_text = serialize($arr);
            if ($page->save())
                Session::put('success', '1');
            else
                Session::put('fail', '1');

            return Redirect::to('admin/vacancy');
        } catch (Exception $e) {
            Session::put('fail', '1');
            return Redirect::to('admin/vacancy');
        }
    }

    public
    function postEditvacancy()
    {
        $data = Input::all();

        foreach ($data["vacancy"] as $key => $item) {

            if ($key == 'requirement') $data['vacancy']['requirement'] = base64_decode($item);
            if ($key == 'preferred') $data['vacancy']['preferred'] = base64_decode($item);

            if ($key === 'date')
                continue;
            if (!isset($item) || empty($item)) {
                Session::put('fail', '1');
                return Redirect::back();
            }
        }

        $page = Page::where('page', '=', $data['type'])->firstOrFail();
        $arr = [];
        if (!empty($page->slider_text)) {
            $arr = unserialize($page->slider_text);
        }
        $time = explode('/', $data['vacancy']['date']);
        $new_time = array_reverse($time);
        $data['vacancy']['date'] = implode('/', $new_time);
        $arr[(int)$data['key']] = $data['vacancy'];
        $page->slider_text = serialize($arr);
        if ($page->save())
            Session::put('success', '1');
        else
            Session::put('fail', '1');
        return Redirect::back();
    }

// Add aplicant
    public
    function Addapplicant()
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

// Check Captcha

            $url = "https://www.google.com/recaptcha/api/siteverify";

            $post_data = array(
                "secret" => "6Lf05gUTAAAAAHj1kPrRYmmjwzVFh2hnO_ZQw8q0",
                "response" => $data['g-recaptcha-response']
            );

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// указываем, что у нас POST запрос
            curl_setopt($ch, CURLOPT_POST, 1);
// добавляем переменные
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

            $output = curl_exec($ch);

            curl_close($ch);

// if captcha is OK
            if (preg_match('/true/', $output)) {
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

                $arr[] = ['name' => $data['name'],
                    'birth' => $data['birth'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'postcode' => $data['postcode'],
                    'state' => $data['state'],
                    'country' => $data['country'],
                    'level' => $data['level'],
                    'cv' => $file,
                    'date' => time(),
                    'position' => $data['position'],
                    'location' => $data['location']];
                $page->slider_text = serialize($arr);
                if ($page->save())
                    Session::put('success', '1');
                else
                    Session::put('fail', 'empty');
            }

        }
        return Redirect::to('vacancy');
    }

    /****************************** Applicants ***********************************/

    public
    function anyApplicants()
    {

        if (Request::isMethod('post')) {
            $data = Input::all();

            try {
                $page = Page::where('page', '=', 'applicants')->firstOrFail();
                $arr = $data['applicants'];
                $content = serialize($arr);
                if ($data['type'] === 'preview') {
                    $page->new_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                    return Redirect::to('vacancy-preview');
                } else if ($data['type'] === 'publish') {
                    $page->new_content = $content;
                    $page->old_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                }
            } catch (Exception $e) {
                Session::put('fail', '1');
                //return $e;
                return Redirect::back();
            }
            Session::put('success', '1');
            return Redirect::back();
        }

        $data = DB::table('pages')->where('page', 'applicants')->first();
        $item = [];
        if (!empty($data->edit_content))
            $item = unserialize($data->edit_content);
        $item['updated_at'] = $data->updated_at;
        $applicants = [];
        if (!empty($data->slider_text)) {
            $applicants = unserialize($data->slider_text);
            krsort($applicants);
        }
        return View::make('admin.applicants')->with(['applicants' => $applicants, 'data' => $item]);
    }

    /****************************** Header Setup ***********************************/

    public
    function Headersetup()
    {
        if (Request::isMethod('post')) {
            $data = Input::all();
            try {
                $page = Page::where('page', '=', 'header_setup')->firstOrFail();
                $page->slider_text = serialize($data['header']['info']);
                $page->save();
            } catch (Exception $e) {
                Session::put('fail', '1');
                //return $e;
                return Redirect::back();
            }
            Session::put('success', '1');
            return Redirect::back();
        }
        $data = DB::table('pages')->where('page', 'header_setup')->first();

        $item = [];
        if (!empty($data->slider_text))
            $item['info'] = unserialize($data->slider_text);
        $item['updated_at'] = $data->updated_at;
        return View::make('admin.header-setup')->with(['data' => $item]);
    }

    /****************************** Footer Setup ***********************************/

    public
    function Footersetup()
    {
        if (Request::isMethod('post')) {
            $data = Input::all();
            try {
                $arr = [];
                $page = Page::where('page', '=', 'footer_setup')->firstOrFail();
                if (!empty($page->slider_text))
                    $arr = unserialize($page->slider_text);
                switch ($data['footer']['type']) {
                    case "copyright":
                        $arr['copyright'] = $data['footer'];
                        break;
                    case "image":

                        if (!empty($data['fg'])) {
                            $file = Input::file('fg');
                            if (isset($file) && !empty($file)) {
                                $info = getimagesize($file);
                                $name = Input::file('fg')->getClientOriginalName();
                                $size = Input::file('fg')->getSize();
                                if ($size > 1048576 || !preg_match('/.jpg|.jpeg|.gif|.png$/', $name) || (int)$info[0] > 1920 || (int)$info[1] > 175) {
                                    Session::put('fail', '1');
                                    return Redirect::back();
                                }

                                //  $destinationPath = base_path() . "/images/";
                                $destinationPath = static::tbmImgPath() . '/index/';
                                //  $ret = Input::file('fg')->move($destinationPath, $destinationPath . $name);
                                $ret = Input::file('fg')->move($destinationPath, $name);
//echo '<pre>'; var_dump($ex, $ret, $destinationPath, $name); echo '</pre>'; exit;
                                $data['footer']['fg'] = 'index/' . $name;
                            }
                        } else {
                            $old_img = unserialize($page->slider_text);
                            if ($old_img['image']['fg'])
                                $data['footer']['fg'] = $old_img['image']['fg'];
                        }

                        $arr['image'] = $data['footer'];
                        break;
                    case "icon":
                        // Edit or Add
                        if (isset($data['footer']['edit-icon']))
                            $arr['icon'][$data['footer']['edit-icon']] = $data['footer'];
                        else
                            $arr['icon'][] = $data['footer'];
                        break;
                }
                //print_r($arr);die();
                $page->slider_text = serialize($arr);
                if ($page->save())
                    Session::put('success', '1');
                else
                    Session::put('fail', '1');
            } catch (Exception $e) {
                Session::put('fail', '1');
                //return $e;
                return Redirect::back();
            }
            Session::put('success', '1');
            return Redirect::back();
        }
        $data = DB::table('pages')->where('page', 'footer_setup')->first();

        $item = [];
        if (!empty($data->slider_text))
            $info = unserialize($data->slider_text);
        $item['updated_at'] = $data->updated_at;

        //print_r($info);die();
        return View::make('admin.footer-setup')->with(['data' => $item, 'info' => $info]);
    }

    /****************************** Animatedlist ***********************************/

    public
    function Animatedlist()
    {
        if (Request::isMethod('post')) {
            $data = Input::all();

            try {
                $page = Page::where('page', '=', 'animated_list')->firstOrFail();
                $arr = $data['animated'];
                $content = serialize($arr);
                if ($data['type'] === 'preview') {
                    $page->new_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                    return Redirect::to('contact-preview');
                } else if ($data['type'] === 'publish') {
                    $page->new_content = $content;
                    $page->old_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                }
            } catch (Exception $e) {
                Session::put('fail', '1');
                //return $e;
                return Redirect::back();
            }
            Session::put('success', '1');
            return Redirect::back();
        }

        $data = DB::table('pages')->where('page', 'animated_list')->first();
        $item = [];
        if (!empty($data->edit_content))
            $item = unserialize($data->edit_content);
        $item['updated_at'] = $data->updated_at;
        $animated = [];
        if (!empty($data->slider_text)) {
            $animated = unserialize($data->slider_text);
        }
        //print_r($animated);die();
        return View::make('admin.bottom_animated_services_list')->with(['animated' => $animated, 'data' => $item]);
    }

    public
    function postAddanimicon()
    {
        $data = Input::all();

        if (isset($data['image']['activeStatus'])) {
            $data['image']['active'] = $data['image']['activeStatus'];
            unset($data['image']['activeStatus']);

        }

        $page = Page::where('page', '=', 'animated_list')->firstOrFail();


        $arr = [];
        if (!empty($page->slider_text))
            $arr = unserialize($page->slider_text);

        if ($data['type'] == 'image') {

            if (!empty($data['img'])) {
                $file = Input::file('img');

                if (isset($file) && !empty($file)) {

                    $info = getimagesize($file);
                    $name = Input::file('img')->getClientOriginalName();
                    $size = Input::file('img')->getSize();

                    if ($size > 1048576 || !preg_match('/.jpg|.jpeg|.gif|.png$/', $name) || intval($info[0]) > 1450 || intval($info[1]) > 550) {

                        Session::put('fail', '1');
                        return Redirect::back();
                    }

                    //  $destinationPath = base_path() . "/images/";
                    $destinationPath = static::tbmImgPath() . '/index/';
                    $ret = Input::file('img')->move($destinationPath, $destinationPath . $name);
//echo '<pre>'; var_dump($ret, $destinationPath, $name); echo '</pre>'; exit;
                    $data['image']['img'] = 'index/' . $name;
                }

                $arr['image'] = $data['image'];

            } else {

                $old_img = unserialize($page->slider_text);
                if ($old_img['image']['img'])
                    $data['image']['img'] = $old_img['image']['img'];
            }
            $arr['image']['active'] = $data['image']['active'];
            $arr['image']['title'] = $data['image']['title'];

        } else if ($data['type'] == 'icon') {
            if (isset($data['animated']['edit-icon']))
                $arr['icons'][$data['animated']['edit-icon']] = $data['animated'];
            else
                $arr['icons'][] = $data['animated'];
        }


        $page->slider_text = serialize($arr);


        if ($page->save())
            Session::put('success', '1');
        else
            Session::put('fail', '1');
        return Redirect::back();
    }


    public
    function Newsletter()
    {
        if (Request::isMethod('post')) {
            try {
                $data = Input::all();
                //print_r($data);die();
                $arr = [];
                $page = Page::where('page', '=', 'newsletter')->firstOrFail();
                if (!empty($page->slider_text))
                    $arr = unserialize($page->slider_text);
                if (!array_key_exists('index', $data)) {
                    $arr[] = $data['newsletter'];
                } else {
                    $arr[$data['index']] = $data['newsletter'];
                }

                $page->slider_text = serialize($arr);
                if ($page->save())
                    Session::put('success', '1');
                return Redirect::back();
            } catch (Exception $e) {
                Session::put('fail', '1');
                //return $e;
                return Redirect::back();
            }
        }

        $data = DB::table('pages')->where('page', 'newsletter')->first();
        $item = [];
        $item['updated_at'] = $data->updated_at;
        $newsletter = [];
        if (!empty($data->slider_text))
            $newsletter = unserialize($data->slider_text);


        return View::make('admin.newsletter_subscription_list')->with(['newsletter' => $newsletter, 'data' => $item]);
    }


// CSV file
    protected
    function download_send_headers($filename)
    {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    protected
    function array2csv(array &$array, $titles)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, $titles, ';');
        foreach ($array as $row) {
            fputcsv($df, $row, ';');
        }
        fclose($df);
        return ob_get_clean();
    }

    public
    function getCsv()
    {

        $data = DB::table('pages')->where('page', 'newsletter')->first();
        $newsletter = [];
        if (!empty($data->slider_text)) {
            $newsletter = unserialize($data->slider_text);
            $arr = [];
            foreach ($newsletter as $key => $value) {
                if (array_key_exists('active', $value))
                    $arr[] = [iconv('UTF-8', 'Windows-1251', $value['name']), iconv('UTF-8', 'Windows-1251', $value['email'])];
            }
            $titles = ["Name", "Email"];
            $this->download_send_headers("data_export.csv");
            echo $this->array2csv($arr, $titles);
            die();
        }
    }

// Forgot password
    public
    function Newpassword()
    {
        if (Request::isMethod('post')) {

            // Принимаем данные
            $data = Input::all();
            //Проверяем данные и отправляем в модель
            $rules = [
                'email' => 'required|email'
            ];

            $val = Validator::make($data, $rules);

            //Если данные не прошли валидацию
            if ($val->fails()) {
                return View::make('admin.forgot_password');
            }

            $data = trim(htmlspecialchars($data['email']));

            $user = User::where('email', '=', $data)->first();

            if (!$user) {
                return Redirect::back()->with('error', "Sorry! We don't find you, please try again.");
            }
            $email = $user->email;
            $data = [];

            $password = $user->password;

            $data['site'] = $_SERVER['SERVER_NAME'];
            // $data['body'] = "Request for password recovery. Your data to access the site " . $data['site'] . "<br/><br/>ID: " . $email . "<br/><br/>Password: " . $password;
            // $data['body'] = "Click here to reset your password: http://www3.ritzgardenhotel.com/password/reset/".$password;
            $data['body'] = "Click here to reset your password: http://www1.ritzgardenhotel.com/password/reset/".csrf_token();
            //Отправляем письмо
            Mail::send('emails.forgot', $data, function ($message) use ($email) {
                $message->to($email, 'web88support@webqom.com')->subject('Forgot password');
            });
            return Redirect::back()->with('success', 'Please check your email for password. Thank you.');
        }

        return View::make('admin.forgot_password');

    }

    /*
    public function Forgot($data){

        $email = base64_decode(substr($data, 4, strlen($data) - 7));
        $user = User::where('email', '=', $email)->first();
        //print_r($user);die();
        if(!$user || !$user->active)
            return ('not found');
            //return Redirect::to('admin/forgot_password');
        if ( Auth::loginUsingId($user->id) ){
            //return ('not login');
            return Redirect::to('admin/about');
        }else{
            return ('not login');
            return Redirect::to('admin/forgot_password');
        }

    }
    */
    /*********************************************** Dashboard ***********************************************/
    public
    function getDashboard()
    {


        $count = ['jobs' => 0, 'applicants' => 0];
        $data1 = DB::table('pages')->where('page', 'applicants')->first();
        $applicants = [];
        if (!empty($data1->slider_text)) {
            $applicants = unserialize($data1->slider_text);
            $count['applicants'] = count($applicants);
            $applicants = array_reverse($applicants);
            if (count($applicants) > 5)
                $applicants = array_slice($applicants, 0, 5);

        }

        $data2 = DB::table('pages')->where('page', 'contact')->first();
        $feedback = '';
        if (!empty($data2->slider_text)) {
            $feedback = unserialize($data2->slider_text);
            $feedback = array_reverse($feedback);
            if (count($feedback) > 5)
                $feedback = array_slice($feedback, 0, 5);
        }

        $jobs_data = DB::table('pages')->where('page', 'vacancy')->get();
        foreach ($jobs_data as $data3) {
            $jobs = [];
            if (!empty($data3->slider_text)) {
                $jobs = unserialize($data3->slider_text);
                foreach ($jobs as $job) {
                    if (key_exists('active', $job))
                        $count['jobs']++;
                }

            }
        }
        //print_r($count);die();
        return View::make('admin.dashboard')->with(['applicants' => $applicants, 'feedback' => $feedback, 'count' => $count]);

    }

    protected
    static function Datesort($num1, $num2)
    {
        $num1 = strtotime($num1['date']);
        $num2 = strtotime($num2['date']);
        if ($num1 > $num2) {
            return 1;
        } else if ($num1 < $num2) {
            return -1;
        } else if ($num1 === $num2) {
            return 0;
        }
    }

    /*
        The problem is: this application (web88 admin) change images for another app (main tbm) in the different domain,
        which is external and unknown for this app.
        Returns abs path for the TBM public folder (without trailing slash)
    */
    protected
    static function tbmImgPath()
    {
        $path = realpath(base_path() . '/../shop/public/front/images');
//echo '<pre>'; var_dump($path); echo '</pre>'; exit;
        return $path;
    }


    public
    function getRoutes()
    {
        $routeCollection = \Route::getRoutes();

        foreach ($routeCollection as $value) {
            echo '<p>' . $value->getPath() . '</p>';
        }
    }

}