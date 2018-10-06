<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Gstrate;
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

class GstratesController extends Controller {

    private $data = array();
    private $GstrateModel = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->GstrateModel = new Gstrate();
    }

    public function index($limit = 10) {
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

        $this->data['success'] = Session::get('gstrate.success');
        Session::forget('gstrate.success');
        $this->data['warning'] = Session::get('gstrate.warning');
        Session::forget('gstrate.warning');

        $this->data['gstrates'] = $this->GstrateModel->getGstrates($limit, $page, Input::get());
        $this->data['paginate_msg'] = $this->GstrateModel->get_paginate_msg($limit, $page, Input::get());
        $this->data['last_updated'] = $this->GstrateModel->getLastUpdated();
        $this->data['curr_url'] = Request::url() . '?' . $_SERVER['QUERY_STRING'];

        //Sorting URL Start
        $sortingUrl = url('web88cms/gstrates/' . $limit) . '?';
        if (Input::get('name')) {
            $sortingUrl .= '&name=' . Input::get('name');
        }
        //Sorting URL End

        $this->data['limit'] = $limit;
        $this->data['page'] = $page;
        $this->data['sorting_url'] = $sortingUrl;
        $this->data['sort'] = $sort;
        $this->data['sort_by'] = $sort_by;

        $this->data['page_title'] = 'GST Rate:: Listing';

        return view('admin.gstrate.index', $this->data);
    }

    public function delete($gstrate_id) {
        $this->GstrateModel->deleteGstrate($gstrate_id);
        Session::put('gstrate.success', 'GST Rate deleted successfully.');

        if (Input::get('redirect')) {
            return redirect(Input::get('redirect'));
        } else {
            return redirect(Input::get('web88cms/gstrates'));
        }
    }

    public function deleteAllGstrate() {
        $gstrates = Input::get('gstrates');

        if ($gstrates && is_array($gstrates)) {
            foreach ($gstrates as $gstrate_id) {
                $this->GstrateModel->deleteGstrate($gstrate_id);
            }
        }

        Session::put('gstrate.success', 'Gstrate deleted successfully.');
        $json['success'] = 'TRUE';
        return Response::json($json);
    }

    public function newGstrate() {

        $json = array();

        $validation['name'] = 'required';
        $validation['rate'] = 'required';
        if (Input::get('status')) {
            $validation['status'] = 'not_exists:gst_rates,status';
        }
        $messages = [
            'not_exists' => 'Already Active GST Rate record availabe.',
        ];
        Validator::extend('not_exists', function($attribute, $value, $parameters) {
            return DB::table($parameters[0])
                            ->where($parameters[1], '=', 1)
                            ->count() < 1;
        });
        $validator = Validator::make(Request::all(), $validation, $messages);
//        print_r($validation);
//        echo "validation == " . $validator->fails();
//        exit();
        if ($validator->fails()) {
            $json['error'] = $validator->errors()->all();
        } else {
            $this->GstrateModel->addGstrate(Request::all());
            Session::put('gstrate.success', 'New gstrate added successfuly.');
            $json['success'] = 'TRUE';
        }

        return Response::json($json);
    }

    public function editGstrate($gstrate_id) {
        $json = array();
        
        $validation['name'] = 'required';
        $validation['rate'] = 'required';
        if (Input::has('status')) {
            $validation['status'] = 'not_exists:gst_rates,status,id,'.$gstrate_id;
        }
        $messages = [
            'not_exists' => 'Already Active GST Rate record availabe.',
        ];
        Validator::extend('not_exists', function($attribute, $value, $parameters) {
            return DB::table($parameters[0])
                            ->where($parameters[1], '=', 1)
                            ->where($parameters[2], '<>', $parameters[3])
                            ->count() < 1;
        });
        $validator = Validator::make(Request::all(), $validation, $messages);
//        print_r($validation);
//        echo "validation == " . $validator->fails();
//        exit();
        if ($validator->fails()) {
            $json['error'] = $validator->errors()->all();
        } else {
            $this->GstrateModel->editGstrate($gstrate_id, Request::all());
            $json['success'] = 'GST Rate updated successfuly.';
        }

        return Response::json($json);
    }

    /**
     * search site
     * first search for customer name and than customer email
     * if customer not found than search for product
     * if there is no product than set category_id to zero(0) to show no record found page
     */
    function searchSite() {
        //dd(Request::input());
        $keyword = Request::input('keyword');

        //search for customers
        // search customer first name
        $result = DB::table('customers')->where('first_name', 'like', '%' . $keyword . '%')->first();

        if (count($result) > 0)
            return redirect('/web88cms/customers?customer_name=' . $keyword . '&email=');

        // search customer email
        $result = DB::table('customers')->where('email', 'like', '%' . $keyword . '%')->first();

        if (count($result) > 0)
            return redirect('/web88cms/customers?customer_name=&email=' . $keyword . '');

        //end search for customers	
        // search for products		
        // search for product name
        $result = DB::table('products')->where('product_name', 'like', '%' . $keyword . '%')->first();

        if (count($result) > 0)
            return redirect('/web88cms/products/list?product_name=' . $keyword . '&product_code=&price_from=&price_to=&brand_id=all&category_id=all');

        // search for product code	
        $result = DB::table('products')->where('product_code', 'like', '%' . $keyword . '%')->first();

        if (count($result) > 0)
            return redirect('/web88cms/products/list?product_name=&product_code=' . $keyword . '&price_from=&price_to=&brand_id=all&category_id=all');

        // search for products by brand	name
        $result = DB::table('brands')->select('brands.id')->leftJoin('products', 'brands.id', '=', 'products.brand_id')->where('brands.title', 'like', '%' . $keyword . '%')->first();

        if (count($result) > 0)
            return redirect('/web88cms/products/list?product_name=&product_code=&price_from=&price_to=&brand_id=' . $result->id . '&category_id=all');

        // search for products by category name
        $result = DB::table('categories as c')->select('c.id')->leftJoin('product_to_category as pc', 'c.id', '=', 'pc.category_id')->where('c.title', 'like', '%' . $keyword . '%')->first();

        if (count($result) > 0)
            return redirect('/web88cms/products/list?product_name=&product_code=&price_from=&price_to=&brand_id=all&category_id=' . $result->id . '');

        //default (no record found)
        return redirect('/web88cms/products/list?product_name=&product_code=&price_from=&price_to=&brand_id=all&category_id=0');
    }

}
