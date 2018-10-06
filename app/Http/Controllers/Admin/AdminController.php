<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Paginator;
use App\Http\Controllers\Controller;
use App\PopUp;
use App\NewBooking;
use App\Http\Models\User;
use App\Http\Models\Admin\Orders;
use App\Http\Models\Admin\Banner;
use App\Http\Models\Admin\RoomBookDate as RoomBookDate;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use App\Http\Models\Admin\Category;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Illuminate\Http\Request as Request1;
//use App\Http\Requests\Request;
use Request;
use View;
use Response;
use Carbon\Carbon;

class AdminController extends Controller {

    private $data = array();
    private $BannerModel = null;
    private $CategoryModel = null;
    private $RoomBookDateModel = null;

    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {



        $this->middleware('auth');

        $this->BannerModel = new Banner();

        $this->CategoryModel = new Category();
        //echo "3"; exit;
    }

    function index() {
        // echo "2"; exit;
        return redirect('web88cms/dashboard');
    }

    function login() {

        //return "dfdsfgsdgfsdgfs";

        return redirect('/web88cms/dashboard');
    }

    function logout() {
        //return redirect('/auth/logout/');
        Auth::logout();
        return redirect('web88cms/login');
    }

    function booking(){
        $data['book'] = NewBooking::all();
        return view('admin.booking.index',$data);
    }
    function updateBooking(){
        NewBooking::where(['id'=>Input::get('booking_id')])->update([
                'description'=>Input::get('description'),
                'status'=>Input::get('status')?1:0,
            ]);
        Session::flash('flash_message', 'The data has been updated');

        return Redirect::back();

    }
    function destroyBooking(){
        NewBooking::where(['id'=>Input::get('booking_id')])->delete();
        Session::flash('flash_message', 'The data has been deleted');

        return Redirect::back();

    }
    function storeOnScreenMessage(){
        NewBooking::create([
                'description'=>Input::get('description'),
                'status'=>Input::get('status')?1:0,
            ]);
        Session::flash('flash_message', 'The data has been Added');

        return Redirect::back();

    }

    function popUp(){
        $data['pop'] = PopUp::all();
        return view('admin.popup.index',$data);
    }
    function storePopUp(){
        if(Input::hasFile('image')){
            $file=Input::file('image');
            $name = time() . '.'.$file->getClientOriginalName();
            $file->move(
                base_path() . '/public/images/', $name
            );
            PopUp::where(['id'=>1])->update([
                'title'=>Input::get('title'),
                'status'=>Input::get('status')?1:0,
                'image'=>'/public/images/'.$name
            ]);
        }else{
            PopUp::where(['id'=>1])->update([
                'title'=>Input::get('title'),
                'status'=>Input::get('status')?1:0,
            ]);
        }
        return Redirect::back()->with(['flash_message', 'The data has been updated']);

    }
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function dashboard() {
//echo "sdasdfasfadf"; exit;
        //// Get orders for dashboard order graph
        $data['graphOrders'] = DB::select("SELECT sum(totalPrice) as totalPrice,MONTH(modifydate) as month FROM `orders` where YEAR(modifydate)=YEAR(CURDATE()) and payment_status='Paid' group by MONTH(modifydate) order by MONTH(modifydate)");

        //// Get today sale dashboard order graph
        $data['todaySale'] = DB::select("SELECT sum(totalPrice) as totalPrice, sum(shipping_charge) as shipping_charge FROM `orders` where YEAR(modifydate)=YEAR(CURDATE()) and MONTH(modifydate)=MONTH(CURDATE()) and DAY(modifydate)=DAY(CURDATE()) and payment_status='Paid' group by MONTH(modifydate) order by MONTH(modifydate)");

        //// Get customers for dashboard customer graph
        $data['newCustomers'] = DB::select("SELECT count(id) as countCustomers,MONTH(createdate) as month FROM `customers` where YEAR(createdate)=YEAR(CURDATE()) group by MONTH(createdate) order by MONTH(createdate)");

        //// Get returning customers for dashboard customer graph
        $data['returnCustomers'] = DB::select("SELECT MONTH( modifydate ) AS month, count(customer_id) as countCustomers FROM  `orders` WHERE YEAR( modifydate ) = YEAR( CURDATE( ) ) GROUP BY MONTH( modifydate ) ORDER BY MONTH( modifydate )");

        ///// GET last 5 orders
        //	$data['last5Orders'] = DB::select("select *, sum(order_to_product.quantity) as quantity from orders inner join order_to_product on orders.id = order_to_product.order_id group by order_to_product.order_id order by orders.id desc limit 5 offset 0");
        $last5orders = DB::select("select id from orders order by id desc limit 5");
        $orderModel = new Orders();
        foreach ($last5orders as $last5order) {
            $order = $orderModel->getOrderTax($last5order->id);
            $data['last5Orders'][] = $order;
        }

        ///// GET life time sales
        $data['lifetimesales'] = DB::select("SELECT sum(totalPrice)   as totalsale, sum(shipping_charge) as shipping_charge FROM orders WHERE payment_status='Paid'");

        //////// Get average order
        $data['totalorder'] = DB::select("select AVG(`totalPrice`) as average FROM orders WHERE payment_status='Paid'");

        ////// GET Best Sellers
        $data['bestsellers'] = DB::select("SELECT p.id as product_id,p.type ,p.sale_price, dertable.quantityordered  FROM products p INNER JOIN (SELECT DISTINCT(product_id)  as pro_id ,SUM(quantity) as quantityordered FROM `order_to_product` WHERE `order_id` IN (SELECT id
FROM orders WHERE STATUS = 'Paid') group by product_id ) as dertable ON p.id=dertable.pro_id order by quantityordered DESC limit 0,5");

        //dd($data['bestsellers']);
        ///// Get New Customers
        $data['newcustomers'] = DB::select("SELECT `first_name` ,id, `email`, `createdate`FROM `customers` order by`createdate` desc limit 0,5");

        ///// GET most viwed product
//echo "SELECT * FROM products inner join viewProduct on products.id = viewProduct.product_id order by viewProduct.views_count desc limit 5 offset 0";
        $data['mostViwedProducts'] = DB::select("SELECT * FROM products inner join viewproduct on products.id = viewproduct.product_id order by viewproduct.views_count desc limit 5 offset 0");

        /* $data['search_terms'] = DB::select("select DISTINCT keyword from search_terms   order by last_searched desc limit 5"); */

        $data['search_terms'] = DB::select("SELECT keyword, MAX(results) AS results, last_searched FROM search_terms GROUP BY keyword order by last_searched desc limit 5");
//echo "sdasdfasfadf"; exit;
        $today_date = Carbon::today();
        $data['today_date'] = $today_date->toDateString();
        $data['checkins_count'] = RoomBookDate::with('order.customer')->where('date_checkin', '=', $data['today_date'])->orderBy('date_checkin', 'DESC')->count();
        $data['checkouts_count'] = RoomBookDate::with('order.customer')->where('date_checkout', '=', $data['today_date'])->orderBy('date_checkout', 'DESC')->count();

        return view('admin.dashboard')->with('data', $data);
    }

    function updatePassword($user_id) {
        if (Request::isMethod('post')) {
            //DB::table('password_resets')->insert(array('token' => Input::get('_token')));// exit;

            $password = Input::get('password');
            $passwordconf = Input::get('password_confirmation');

            $validator = Validator::make(Request::all(), [
                        'password' => 'required|confirmed|min:6',
                        'password_confirmation' => 'required_with:password|min:6',
                            ]
            );

            if ($validator->fails()) {
                $json['error'] = $validator->errors()->all();
                echo json_encode($json);
                exit;
                //return Redirect::back()->withErrors($validator);
                //echo Redirect::back()->withErrors($validator); exit;
            } else {
                //echo Hash::make($password); // hash password
                $user = User::find($user_id);
                $user->password = Hash::make($password);
                $user->save();

                echo json_encode(array('success' => 'success'));
                exit;
            }
        }
        return view('admin.updatePassword');
    }

    function updateAvtar($user_id) {
        if (Request::isMethod('post')) {
            //DB::table('password_resets')->insert(array('token' => Input::get('_token')));// exit;

            $messages = [
                //'required' => 'The :attribute field is required.',
                'max' => 'Max file size should be less than 2MB.',
            ];

            $validator = Validator::make(Request::all(), [
                        'avtarImage' => 'required|image|mimes:jpeg,png,gif|max:2000',
                            ], $messages
            );

            if ($validator->fails()) {
                $json['error'] = $validator->errors()->all();
                echo json_encode($json);
                exit;
                //return Redirect::back()->withErrors($validator);
                //echo Redirect::back()->withErrors($validator); exit;
            } else {
                //echo '<pre>'; print_r($_FILES); exit;
                $imageName = time() . '_' . $_FILES['avtarImage']['name'];
                Request::file('avtarImage')->move(
                        base_path() . '/public/admin/avtar/', $imageName
                );

                $user = User::find($user_id);
                $user->image = $imageName;
                $user->save();

                echo json_encode(array('success' => $imageName));
                exit;
            }
        }
        return view('admin.updatePassword');
    }

    /* function getUserDetails($id)
      {
      $user = new User();
      $data['userDetails'] = $user->getUser($id);
      return view('admin.profile', $data);
      }

      function getAlbums()
      {
      $user = new User();
      $data['albums'] = $user->getAlbums();
      return view('admin.albums', $data);
      }

      public function checkSession()
      {
      Session::put('session_key', 'sad adl lasdla');
      echo Session::get('session_key');
      exit;
      //return view('admin.dashboard');
      } */

    public function bannertop() {

        $currentdate = date('Y-m-d');
        $resultsdata = DB::update("UPDATE banner_top SET status= 0 WHERE end_date <'" . $currentdate . "' ");

        if ((isset($_GET['rec']) && $_GET['rec'] != '')) {
            $data['num_rec_per_page'] = $num_rec_per_page = $_GET['rec'];
        } else {
            $data['num_rec_per_page'] = $num_rec_per_page = 10;
        }
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $num_rec_per_page;
        $pagedata = DB::table('banner_top');
        $total_records = $pagedata->count();
        $data['total_pages'] = ceil($total_records / $num_rec_per_page);
        $data['start_from'] = $start_from = (($page - 1) * ($num_rec_per_page));
        $data['banner_alltopdata'] = DB::select("SELECT * FROM banner_top");
        $data['banner_topdata'] = DB::select("SELECT * FROM banner_top LIMIT $start_from, $num_rec_per_page");

        /* Showing 3 to 4 of 8 entries */

        $page_to = (($page * $num_rec_per_page) > $total_records) ? $total_records : ($page * $num_rec_per_page);
        if ($page_to == 0) {
            $data['msg'] = 'Showing ' . $page_to . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        } else {
            $data['msg'] = 'Showing ' . ((($page - 1) * $num_rec_per_page) + 1) . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        }
        //$data['msg'] = 'Showing '. ((($page-1) * $num_rec_per_page) + 1) .' to '. $page_to .' of '. $total_records .' entries';
        /* Showing 3 to 4 of 8 entries end */

        $data['page_title'] = 'Index Top Banners:: Listing';

        $data['lastUpdated'] = $this->BannerModel->getLastUpdatedtop();
        return View::make('admin.index_banner_top_list')->with('result', $data);
    }

    public function bannermiddletop() {
        $currentdate = date('Y-m-d');
        $resultsdata = DB::update("UPDATE banner_middle_top SET status= 0 WHERE end_date <'" . $currentdate . "' ");

        if ((isset($_GET['rec']) && $_GET['rec'] != '')) {
            $data['num_rec_per_page'] = $num_rec_per_page = $_GET['rec'];
        } else {
            $data['num_rec_per_page'] = $num_rec_per_page = 10;
        }
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $num_rec_per_page;
        $pagedata = DB::table('banner_middle_top');
        $total_records = $pagedata->count();
        $data['total_pages'] = ceil($total_records / $num_rec_per_page);
        $data['start_from'] = $start_from = (($page - 1) * ($num_rec_per_page));
        $data['banner_allmiddletopdata'] = DB::select("SELECT * FROM banner_middle_top");
        $data['banner_middletopdata'] = DB::select("SELECT * FROM banner_middle_top LIMIT $start_from, $num_rec_per_page");

        /* Showing 3 to 4 of 8 entries */

        $page_to = (($page * $num_rec_per_page) > $total_records) ? $total_records : ($page * $num_rec_per_page);
        if ($page_to == 0) {
            $data['msg'] = 'Showing ' . $page_to . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        } else {
            $data['msg'] = 'Showing ' . ((($page - 1) * $num_rec_per_page) + 1) . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        }
        //$data['msg'] = 'Showing '. ((($page-1) * $num_rec_per_page) + 1) .' to '. $page_to .' of '. $total_records .' entries';
        /* Showing 3 to 4 of 8 entries end */

        $data['page_title'] = 'Index Middle Top Banners:: Listing';

        //$data['banner_middletopdata']= DB::table('banner_middle_top')->select('*')->take($num_rec_per_page)->get();
        $data['lastUpdated'] = $this->BannerModel->getLastUpdatedmiddletop();
        return View::make('admin.index_middle_top_list')->with('result', $data);
    }

    public function bannermiddlebottom() {

        $currentdate = date('Y-m-d');
        $resultsdata = DB::update("UPDATE banner_middle_bottom SET status= 0 WHERE end_date <'" . $currentdate . "' ");
        //$data['banner_middlebottomdata']= DB::table('banner_middle_bottom')->select('*')->get();
        if ((isset($_GET['rec']) && $_GET['rec'] != '')) {
            $data['num_rec_per_page'] = $num_rec_per_page = $_GET['rec'];
        } else {
            $data['num_rec_per_page'] = $num_rec_per_page = 10;
        }
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $num_rec_per_page;
        $pagedata = DB::table('banner_middle_bottom');

        $data['banner_allmiddlebottomdata'] = DB::select("SELECT * FROM banner_middle_bottom");

        $total_records = $pagedata->count();
        $data['total_pages'] = ceil($total_records / $num_rec_per_page);
        $data['start_from'] = $start_from = (($page - 1) * ($num_rec_per_page));
        $data['banner_middlebottomdata'] = DB::select("SELECT * FROM banner_middle_bottom LIMIT $start_from, $num_rec_per_page");



        /* Showing 3 to 4 of 8 entries */

        $page_to = (($page * $num_rec_per_page) > $total_records) ? $total_records : ($page * $num_rec_per_page);

        if ($page_to == 0) {
            $data['msg'] = 'Showing ' . $page_to . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        } else {
            $data['msg'] = 'Showing ' . ((($page - 1) * $num_rec_per_page) + 1) . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        }
        //$data['msg'] = 'Showing '. ((($page-1) * $num_rec_per_page) + 1) .' to '. $page_to .' of '. $total_records .' entries';


        $data['page_title'] = 'Index Middle Bottom Banners:: Listing';

        $data['lastUpdated'] = $this->BannerModel->getLastUpdatedmiddlebottom();
        return View::make('admin.index_middle_bottom_list')->with('result', $data);
    }

    public function leftbanner() {
        $currentdate = date('Y-m-d');
        $resultsdata = DB::update("UPDATE banner_left SET status= 0 WHERE end_date <'" . $currentdate . "' ");
        //return view('admin.left_banner_list');
        //$data['banner_leftdata']= DB::table('banner_left')->select('*')->get();

        if ((isset($_GET['rec']) && $_GET['rec'] != '')) {
            $data['num_rec_per_page'] = $num_rec_per_page = $_GET['rec'];
        } else {
            $data['num_rec_per_page'] = $num_rec_per_page = 10;
        }
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $num_rec_per_page;
        $pagedata = DB::table('banner_left');
        $total_records = $pagedata->count();
        $data['total_pages'] = ceil($total_records / $num_rec_per_page);
        $data['start_from'] = $start_from = (($page - 1) * ($num_rec_per_page));
        $data['banner_allleftdata'] = DB::select("SELECT * FROM banner_left");
        $data['banner_leftdata'] = DB::select("
			SELECT banner_left.*, group_concat(blc.category_id) as categories FROM banner_left 
			LEFT JOIN banner_left_categories as blc ON blc.banner_id = banner_left.id
			GROUP BY banner_left.id
			LIMIT $start_from, $num_rec_per_page");

        /* Showing 3 to 4 of 8 entries */

        $page_to = (($page * $num_rec_per_page) > $total_records) ? $total_records : ($page * $num_rec_per_page);
        if ($page_to == 0) {
            $data['msg'] = 'Showing ' . $page_to . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        } else {
            $data['msg'] = 'Showing ' . ((($page - 1) * $num_rec_per_page) + 1) . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        }
        //$data['msg'] = 'Showing '. ((($page-1) * $num_rec_per_page) + 1) .' to '. $page_to .' of '. $total_records .' entries';
        /* Showing 3 to 4 of 8 entries end */




        $data['page_title'] = 'Left Banners:: Listing';

        $data['lastUpdated'] = $this->BannerModel->getLastUpdatedleft();

        $data['categories'] = $this->CategoryModel->getSelectedCategoriesTree(array(Input::get('categories')));

        return View::make('admin.left_banner_list')->with('result', $data);
    }

    public function leftpromotionbanner() {
        $currentdate = date('Y-m-d');
        $resultsdata = DB::update("UPDATE banner_left_promotion SET status= 0 WHERE end_date <'" . $currentdate . "' ");
        //return view('admin.left_promotion_banner_list');
        //$data['banner_leftpromotiondata']= DB::table('banner_left_promotion')->select('*')->get();
        if ((isset($_GET['rec']) && $_GET['rec'] != '')) {
            $data['num_rec_per_page'] = $num_rec_per_page = $_GET['rec'];
        } else {
            $data['num_rec_per_page'] = $num_rec_per_page = 10;
        }
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $num_rec_per_page;
        $pagedata = DB::table('banner_left_promotion');
        $total_records = $pagedata->count();
        $data['total_pages'] = ceil($total_records / $num_rec_per_page);
        $data['start_from'] = $start_from = (($page - 1) * ($num_rec_per_page));
        $data['banner_allleftpromotiondata'] = DB::select("SELECT * FROM banner_left_promotion");
        $data['banner_leftpromotiondata'] = DB::select("SELECT * FROM banner_left_promotion LIMIT $start_from, $num_rec_per_page");

        /* Showing 3 to 4 of 8 entries */

        $page_to = (($page * $num_rec_per_page) > $total_records) ? $total_records : ($page * $num_rec_per_page);
        if ($page_to == 0) {
            $data['msg'] = 'Showing ' . $page_to . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        } else {
            $data['msg'] = 'Showing ' . ((($page - 1) * $num_rec_per_page) + 1) . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        }
        //$data['msg'] = 'Showing '. ((($page-1) * $num_rec_per_page) + 1) .' to '. $page_to .' of '. $total_records .' entries';
        /* Showing 3 to 4 of 8 entries end */




        $data['page_title'] = 'Left Promotion Banners:: Listing';

        $data['lastUpdated'] = $this->BannerModel->getLastUpdatedleftpromotion();
        return View::make('admin.left_promotion_banner_list')->with('result', $data);
    }

    public function productbanner() {
        //return view('admin.product_banner_list');
        //$data['banner_productdata']= DB::table('product_banner_list')->select('*')->get();

        $currentdate = date('Y-m-d');
        $resultsdata = DB::update("UPDATE product_banner_list SET status= 0 WHERE end_date <'" . $currentdate . "' ");

        if ((isset($_GET['rec']) && $_GET['rec'] != '')) {
            $data['num_rec_per_page'] = $num_rec_per_page = $_GET['rec'];
        } else {
            $data['num_rec_per_page'] = $num_rec_per_page = 10;
        }
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $num_rec_per_page;
        $pagedata = DB::table('product_banner_list');
        $total_records = $pagedata->count();
        $data['total_pages'] = ceil($total_records / $num_rec_per_page);
        $data['start_from'] = $start_from = (($page - 1) * ($num_rec_per_page));
        $data['banner_productdata'] = DB::select("SELECT * FROM product_banner_list LIMIT $start_from, $num_rec_per_page");

        $page_to = (($page * $num_rec_per_page) > $total_records) ? $total_records : ($page * $num_rec_per_page);

        if ($page_to == 0) {
            $data['msg'] = 'Showing ' . $page_to . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        } else {
            $data['msg'] = 'Showing ' . ((($page - 1) * $num_rec_per_page) + 1) . ' to ' . $page_to . ' of ' . $total_records . ' entries';
        }
        //$data['msg'] = 'Showing '. ((($page-1) * $num_rec_per_page) + 1) .' to '. $page_to .' of '. $total_records .' entries';
        /* Showing 3 to 4 of 8 entries end */


        $data['page_title'] = 'Product Banners:: Listing';

        $this->data['page_title'] = 'tes';
        $data['lastUpdated'] = $this->BannerModel->getLastUpdatedproduct();
        $data['getcategories'] = $this->BannerModel->getcategorydata();
        $data['categories'] = $this->CategoryModel->getCategoriesTree();
        return View::make('admin.product_banner_list')->with('result', $data);
    }

    public function aboutusEdit() {
        $data['content'] = DB::select('select * from aboutus where id = 1');
        $data['obj'] = DB::select('select * from aboutusobjective');
        return View::make('admin.aboutusEdit')->with('result', $data);

        //return view::make('admin.aboutusEdit', $data);
    }

    public function aboutusUpdate() {
        if (Request::isMethod('post')) {
            $content1 = Request::input('content1');
            $content2 = Request::input('content2');
            $content3 = Request::input('content3');
            $content4 = Request::input('content4');
            $content5 = Request::input('content5');
            $content6 = Request::input('content6');
            $content7 = Request::input('content7');
            $content8 = Request::input('content8');
            $content9 = Request::input('content9');
            $content10 = Request::input('content10');
            $content11 = Request::input('content11');
            $content12 = Request::input('content12');
            $content13 = Request::input('content13');
            $content14 = Request::input('content14');
            $content15 = Request::input('content15');
            $content16 = Request::input('content16');
            $content17 = Request::input('content17');
            $content18 = Request::input('content18');
            $content19 = Request::input('content19');
            $content20 = Request::input('content20');
            $icon1 = Request::input('icon1');
            $icon2 = Request::input('icon2');
            $affected = DB::update("update aboutus set content1 = ?,
		   												content2 = ?,
														content3 = ?,
														content4 = ?,
														content5 = ?,
														content6 = ?,
														content7 = ?,
														content8 = ?,
														content9 = ?,
														content10 = ?,
														content11 = ?,
														content12 = ?,
														content13 = ?,
														content14 = ?,
														content15 = ?,
														content16 = ?,
														content17 = ?,
														content18 = ?,
														content19 = ?,
														content20 = ?,
														icon1 = ?,
														icon2 = ?
														 where id = 1", [$content1, $content2, $content3, $content4, $content5, $content6, $content7, $content8, $content9, $content10, $content11, $content12, $content13, $content14, $content15, $content16, $content17, $content18, $content19, $content20, $icon1, $icon2]);
        } else {
            return view('admin.aboutusEdit');
        }
    }

    public function aboutusObjective() {
        if (Request::isMethod('post')) {
            $validator = Validator::make(Request::all(), [
                        'objText' => 'required',
            ]);

            if ($validator->fails()) {
                $json['error'] = $validator->errors()->all();
                echo json_encode($json);
                exit;
            } else {
                $objText = Request::input('objText');
                $status = Request::input('status');
                if ($status == 1) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                $affected = DB::update("insert into aboutusObjective set objText = ?,
		   												status = ? ", [$objText, $status]);

                echo json_encode(array('success' => 'success'));
                exit;
            }
        }
    }

    public function aboutusUpdateObjective() {
        if (Request::isMethod('post')) {
            $validator = Validator::make(Request::all(), [
                        'objText' => 'required',
            ]);

            if ($validator->fails()) {
                $json['error'] = $validator->errors()->all();
                echo json_encode($json);
                exit;
            } else {
                $objId = Request::input('objId');
                $objText = Request::input('objText');
                $status = Request::input('status');
                if ($status == 1) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                $affected = DB::update("Update aboutusObjective set objText = ?,
		   												status = ? where id=?", [$objText, $status, $objId]);

                echo json_encode(array('success' => 'success'));
                exit;
            }
        }
    }

    public function aboutusDeleteObjective() {
        if (Request::isMethod('post')) {
            $objId = Request::input('objId');

            $deleted = DB::delete("delete from aboutusObjective where id='" . $objId . "'");

            echo json_encode(array('success' => 'success'));
            exit;
        }
    }

    public function postAddvacancy() {
        try {
            $data = Input::all();
            foreach ($data["vacancy"] as $key => $item) {

                if ($key == 'requirement')
                    $data['vacancy']['requirement'] = base64_decode($item);
                if ($key == 'preferred')
                    $data['vacancy']['preferred'] = base64_decode($item);

                if ($key === 'date')
                    continue;
                if (!isset($item) || empty($item)) {
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
            return Redirect::to('web88/admin/vacancy');
        } catch (Exception $e) {
            Session::put('fail', '1');
            return Redirect::to('web88/admin/vacancy');
        }
    }

    public function checkInOutListing(Request1 $request,$limit = 10) {
        $page = 0;

        if (Input::get('page')) {
            $page = Input::get('page');
        }
        if (Input::get('sort')) {
            $sort = Input::get('sort');
        } else {
            $sort = 'ASC';
        }
        if (Input::get('sort_by')) {
            $sort_by = Input::get('sort_by');
        } else {
            $sort_by = 'createdate';
        }

        $this->data['success'] = Session::get('checkinout.success');
        Session::forget('checkinout.success');
        $this->data['warning'] = Session::get('checkinout.warning');
        Session::forget('checkinout.warning');

        //Sorting URL Start
        $sortingUrl = url('web88cms/checkInOut/' . $limit) . '?';
        if (Input::get('name')) {
            $sortingUrl .= '&name=' . Input::get('name');
        }
        //Sorting URL End

        $this->data['limit'] = $limit;
        $this->data['page'] = $page;
        $this->data['sorting_url'] = $sortingUrl;
        $this->data['sort'] = $sort;
        $this->data['sort_by'] = $sort_by;

        //$this->data['checkins'] = $this->RoomBookDateModel->getGstrates($limit, $page, Input::get());
//        $this->data['checkins'] =  RoomBookDate::with('order.customer')->where("room_booked_date.id","=","156")->paginate($limit);
        $input = Input::all();
        $checkin_date = Carbon::today();
        $checkout_date = Carbon::today();
        if (!empty($input['checkin_date'])) {
            $checkin_date = Carbon::createFromFormat('Y-m-d', $input['checkin_date']);
        }
        if (!empty($input['checkout_date'])) {
            $checkout_date = Carbon::createFromFormat('Y-m-d', $input['checkout_date']);
        }
        //echo "date = ".$mytime->toDateString();
        $this->data['current_date_chackin'] = $checkin_date->toDateString();
        $this->data['current_date_chackout'] = $checkout_date->toDateString();

        //$checkin_previous_date = Carbon::yesterday();
        $checkin_previous_date = $checkin_date->addDays(-1);
        $this->data['checkin_previous_date'] = $checkin_previous_date->toDateString();
//        $checkin_next_date = Carbon::tomorrow();
        $checkin_next_date = $checkin_date->addDays(2);
        $this->data['checkin_next_date'] = $checkin_next_date->toDateString();

        //$checkout_previous_date = Carbon::yesterday();
        $checkout_previous_date = $checkout_date->addDays(-1);
        $this->data['checkout_previous_date'] = $checkout_previous_date->toDateString();
        //$checkout_previous_date = Carbon::tomorrow();
        $checkout_next_date = $checkout_date->addDays(2);
        $this->data['checkout_next_date'] = $checkout_next_date->toDateString();

        if (!empty($input['checkin_from']) && !empty($input['checkin_to'])) {
            $checkin_from = Carbon::createFromFormat('d-m-Y', $input['checkin_from'])->toDateString();
            $checkin_to = Carbon::createFromFormat('d-m-Y', $input['checkin_to'])->toDateString();
            $this->data['checkins'] = RoomBookDate::has('order.customer')->with('order.customer')->whereBetween('date_checkin', [$checkin_from, $checkin_to])->orderBy('date_checkin', 'DESC')->paginate($limit);
        } else {
            $this->data['checkins'] = RoomBookDate::has('order.customer')->with('order.customer')->where('date_checkin', '=', $this->data['current_date_chackin'])->orderBy('date_checkin', 'DESC')->paginate($limit);
        }
        if (!empty($input['checkout_from']) && !empty($input['checkout_to'])) {
            $checkout_from = Carbon::createFromFormat('d-m-Y', $input['checkout_from'])->toDateString();
            $checkout_to = Carbon::createFromFormat('d-m-Y', $input['checkout_to'])->toDateString();
            $this->data['checkouts'] = RoomBookDate::has('order.customer')->with('order.customer')->whereBetween('date_checkout', [$checkout_from, $checkout_to])->orderBy('date_checkout', 'DESC')->paginate($limit);
        } else {
            $this->data['checkouts'] = RoomBookDate::has('order.customer')->with('order.customer')->where('date_checkout', '=', $this->data['current_date_chackout'])->orderBy('date_checkout', 'DESC')->paginate($limit);
        }
//        echo "<pre>";
//        foreach ($this->data['checkins'] as $value){
//            print_r($value->order->customer);    
//        }    
//        exit;
        $currentQueries = $request->query();
        $csv_url = $request->fullUrl();
        if(count($currentQueries) > 0){
            $csv_url .= "&csv=true";
        }  else {
            $csv_url .= "?csv=true";
        }
//        $this->data['csv_url']=$request->fullUrl();
        $this->data['csv_url']=$csv_url;
        if (Input::has('csv')) {
            $filename = "orders.csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('Booking ID', 'Customer Name', 'Checking In', 'Checking Out'));

            foreach ($this->data['checkins'] as $row) {
                fputcsv($handle, array($row->order_id, $row->order->customer->first_name." ".$row->order->customer->last_name,$row->date_checkin,''));
            }
            foreach ($this->data['checkouts'] as $row) {
                fputcsv($handle, array($row->order_id, $row->order->customer->first_name." ".$row->order->customer->last_name,'',$row->date_checkout));
            }

            fclose($handle);

            $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            );

            return Response::download($filename, $filename, $headers);
        } else {
            return view('admin.checkinout_listing', $this->data);
        }
    }
}
