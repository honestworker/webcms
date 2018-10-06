<?php namespace App\Http\Controllers;
//use Illuminate\Auth\GenericUser;
use Auth;
use DB;
use Redirect;
use Request;
use View;

class AdminController extends Controller
{

    public function login()
    {
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
                return View::make('web88.admin.login')->with(['error' => ['validate' => false]]);
            }


            $user = User::login($data);

            if (!$user) {

                return View::make('web88.admin.login')->with(['error' => ['login' => false]]);
            }

            return Redirect::to('admin/dashboard');
        } else {
//echo '!!!'; exit;
//$view = View::make('web88.admin.login');
//echo '<pre>'; var_dump($view); echo '</pre>'; exit;
            return View::make('web88.admin.login');
        }
    }

    // Page About
    public function anyAbout()
    {

        if (Request::isMethod('post')) {
            try {
                $data = Input::all();
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
        $item = [];
        if (!empty($data->slider_text))
            $item = unserialize($data->slider_text);
        if (!empty($data->bgimage))
            $bgimg = unserialize($data->bgimage);

        //print_r($about);die();
        return View::make('web88.admin.about')->with(['about' => $about, 'data' => $item, 'bgimg' => $bgimg, 'times' => $times]);
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

        // Size photo
        if (isset($file) && !empty($file)) {
            $info = getimagesize($file);
            if ((int)$info[0] > 1543 || (int)$info[1] > 600) {
                Session::put('fail', '1');
                return Redirect::back();
            }

        }
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
            //sort($arr[$data['type']]);
            //usort($arr, array('AdminController', 'Datesort'));
        } else {
            unset($arr[(int)$data['index']]);
            //sort($arr);
            //usort($arr, array('AdminController', 'Datesort'));
        }
        //usort($arr, array('AdminController', 'Datesort'));
        $arr = array_values($arr);
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
                $arr = array_values($arr);
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
        return View::make('web88.admin.icon');
    }

    /****************************** Services ***********************************/

    public function anyServices()
    {
        if (Request::isMethod('post')) {
            $data = Input::all();
            if($data['type']=='saveTermCondition'){

                $page = Page::where('page', '=', 'services')->firstOrFail();
                $content = unserialize($page->new_content);
                if(isset($content['icon'][$data['term_id']]['descr'])){
                    $content['icon'][$data['term_id']]['descr'] = $data['content'];
                    $page->new_content = serialize($content);
                    $page->edit_content = serialize($content);
                    $page->old_content = serialize($content);
                    $page->save();
                    echo json_encode(
                        array(
                            'status'=>'success'
                        )
                    );
                    return ;

                }else{
                    echo json_encode(
                        array(
                            'status'=>'failed'
                        )
                    );
                    return ;
                }
            }

            try {
                $page = Page::where('page', '=', 'services')->firstOrFail();
                $arr = ['header' => $data['header'], 'icon' => $data['icon']];
                $content = serialize($arr);
                if ($data['type'] === 'preview') {
                    $page->new_content = $content;
                    $page->edit_content = $content;
                    $page->save();
                    return Redirect::to('services-preview');
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
        $data = DB::table('pages')->where('page', 'services')->first();
        $item = unserialize($data->edit_content);
        $item['updated_at'] = $data->updated_at;
        return View::make('web88.admin.services')->with('data', $item);
    }

    /****************************** Contact ***********************************/

    public function anyContact()
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
        return View::make('web88.admin.contact')->with(['data' => $item, 'feedback' => $feedback]);
    }

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
            if ($page->save())
                Session::put('success', '1');
            else
                Session::put('fail', '1');
        } else {
            Session::put('fail', '1');
        }
        return Redirect::back();
    }

    /****************************** Stores ***********************************/

    public function anyStores()
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

        return View::make('web88.admin.stores')->with(['data' => $item, 'stores' => $stores]);
    }

    public function postAddstore()
    {
        $data = Input::all();
        //print_r($data);die();
        foreach ($data["store"] as $key => $item) {
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
        $arr[] = $data['store'];
        $page->slider_text = serialize($arr);
        if ($page->save())
            Session::put('success', '1');
        else
            Session::put('fail', '1');
        return Redirect::back();
    }

    public function postEditstore()
    {
        $data = Input::all();
        foreach ($data["store"] as $key => $item) {
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

    public function anyVacancy()
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
            $vacancy = unserialize($data->slider_text);
            krsort($vacancy);
        }

        return View::make('web88.admin.vacancy')->with(['data' => $item, 'vacancy' => $vacancy]);
    }

    public function postAddvacancy()
    {
        $data = Input::all();
        foreach ($data["vacancy"] as $key => $item) {

            if ($key === 'date')
                continue;
            if (!isset($item) || empty($item)) {
                Session::put('fail', '1');
                return Redirect::back();
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
        return Redirect::back();
    }

    public function postEditvacancy()
    {
        $data = Input::all();

        foreach ($data["vacancy"] as $key => $item) {

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
                    $destinationPath = base_path() . "/images/";
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

    public function anyApplicants()
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
        return View::make('web88.admin.applicants')->with(['applicants' => $applicants, 'data' => $item]);
    }

    /****************************** Header Setup ***********************************/

    public function Headersetup()
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
        return View::make('web88.admin.header-setup')->with(['data' => $item]);
    }

    /****************************** Footer Setup ***********************************/

    public function Footersetup()
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
                                $destinationPath = base_path() . "/images/";
                                $name = Input::file('fg')->getClientOriginalName();
                                $size = Input::file('fg')->getSize();
                                if ($size > 1048576 || !preg_match('/.jpg|.jpeg|.gif|.png$/', $name) || (int)$info[0] > 1920 || (int)$info[1] > 175) {
                                    Session::put('fail', '1');
                                    return Redirect::back();
                                }
$destinationPath = '/home/staging3/public_html/shop/public/front/images/index/';
$name = 'footer_bg1.jpg';
//dd($fname);
                            //    Input::file('fg')->move($destinationPath, $destinationPath . $name);
                                Input::file('fg')->move($destinationPath, $name);
                            //    Input::file('fg')->move($fname);
                                $data['footer']['fg'] = $name;
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
                return $e;
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
        return View::make('web88.admin.footer-setup')->with(['data' => $item, 'info' => $info]);
    }

    /****************************** Animatedlist ***********************************/

    public function Animatedlist()
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
        return View::make('web88.admin.bottom_animated_services_list')->with(['animated' => $animated, 'data' => $item]);
    }

    public function postAddanimicon()
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
                    $destinationPath = base_path() . "/images/";
                    $name = Input::file('img')->getClientOriginalName();
                    $size = Input::file('img')->getSize();

                    if ($size > 1048576 || !preg_match('/.jpg|.jpeg|.gif|.png$/', $name) || intval($info[0]) > 1450 || intval($info[1]) > 550) {

                        Session::put('fail', '1');
                        return Redirect::back();
                    }

                    Input::file('img')->move($destinationPath, $destinationPath . $name);
                    $data['image']['img'] = $name;
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


    public function Newsletter()
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


        return View::make('web88.admin.newsletter_subscription_list')->with(['newsletter' => $newsletter, 'data' => $item]);
    }


    // CSV file
    protected function download_send_headers($filename)
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

    protected function array2csv(array &$array, $titles)
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

    public function getCsv()
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
    public function Newpassword()
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
                return View::make('web88.admin.forgot_password');
            }

            $data = trim(htmlspecialchars($data['email']));
            $user = User::where('email', '=', $data)->first();

            if (!$user)
                return Redirect::back();
            $email = $user->email;
            $data = [];
            $password = $user->pass;
            //$part1 = substr($password, -7, 4 );
            //$part2 = substr($password, 3, 3);
            //$hash = $part1 . base64_encode($email) . $part2;
            $data['site'] = $_SERVER['SERVER_NAME'];
            //$data['body'] = "You have requested a password recovery on the site " . $data['site'] . "<br/><br/> To change the password go to <a href='http://" . $data['site'] . "/web88/admin/forgot/" . $hash . "'>Change password</a>";
            $data['body'] = "Request for password recovery. Your data to access the site " . $data['site'] . "<br/><br/>ID: " . $email . "<br/><br/>Password: " . $password;
            //Отправляем письмо
            Mail::send('emails.forgot', $data, function ($message) use ($email) {
                $message->to($email, 'info@web88.com')->subject('Forgot password');
            });
            return Redirect::back();
        }

        return View::make('web88.admin.forgot_password');

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
    public function getDashboard()
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

        $data3 = DB::table('pages')->where('page', 'vacancy')->first();
        $jobs = [];
        if (!empty($data3->slider_text)) {
            $jobs = unserialize($data3->slider_text);
            foreach ($jobs as $job) {
                if (key_exists('active', $job))
                    $count['jobs']++;
            }

        }
        //print_r($count);die();
        return View::make('web88.admin.dashboard')->with(['applicants' => $applicants, 'feedback' => $feedback, 'count' => $count]);
    }

    protected static function Datesort($num1, $num2)
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

}