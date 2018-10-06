<?php
namespace App\Http\Models\Admin; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB;
Use REQUEST; // used for queries like DB::table('table_name')->get();
class Banner extends Model{

	function getMiddleTopBanner()
	{
		$results = DB::table('banner_middle_top')->orderBy('id','desc')->get();
		return $results;
	}

	function addMiddleTopBanner($formData)
	{

		/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		//$results = DB::table('banner_middle_top')->get();

		$imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/middletop', $imageName
					);
				}

				$enlargebannerdata = null;
				if(isset($_FILES['enlarge_banner']['name']) && $_FILES['enlarge_banner']['name']!='')
				{

					$enlargebannerdata = time().'_'.$_FILES['enlarge_banner']['name'];
					Request::file('enlarge_banner')->move(
						base_path() . '/public/admin/images/banner/middletop', $enlargebannerdata
					);
				}

				$pdf_link_data = null;
				if(isset($_FILES['pdf_link']['name']) && $_FILES['pdf_link']['name']!='')
				{

					$pdf_link_data = time().'_'.$_FILES['pdf_link']['name'];
					Request::file('pdf_link')->move(
						base_path() . '/public/admin/images/banner/middletop', $pdf_link_data
					);
				}
			  if(isset($formData['start_date'])){ $input= $formData['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	      if(isset($formData['end_date'])){$input2= $formData['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));

	       }
	     else{$end_date='';}

		   if(isset($formData['title'])){$title = $formData['title'];}else{$title='';}

		   if(isset($formData['display_order'])){$display_order = $formData['display_order'];}else{$display_order='';}
		   if(isset($formData['url'])){$url = $formData['url'];}else{$url='';}
		    if(isset($formData['_token'])){$token = $formData['_token'];}else{$token='';}


	       $data['token'] = $token;
			$data['title'] = $title ;
			 $data['start_date'] = $start_date;
			 $data['end_date'] = $end_date;
			$data['display_order'] = $display_order;
			$data['url'] = $url;

			$data['banner'] = $imageName;
			$data['enlarge_banner'] = $enlargebannerdata;
			$data['pdf_link'] = $pdf_link_data;


			 if(isset($formData['status'])){$status = $formData['status'];}else{$status='';}
			$data['status'] = $status;

			$data['modified'] = date('Y-m-d H:i:s');
			$data['created'] = date('Y-m-d H:i:s');
			DB::table('banner_middle_top')->insert($data);
		}


		/*middle bottom section/*/

	function addMiddleBottomBanner($formData)
	{

		/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		//$results = DB::table('banner_middle_top')->get();

		$imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/middlebottom', $imageName
					);
				}

				$enlargebannerdata = null;
				if(isset($_FILES['enlarge_banner']['name']) && $_FILES['enlarge_banner']['name']!='')
				{

					$enlargebannerdata = time().'_'.$_FILES['enlarge_banner']['name'];
					Request::file('enlarge_banner')->move(
						base_path() . '/public/admin/images/banner/middlebottom', $enlargebannerdata
					);
				}

				$pdf_link_data = null;
				if(isset($_FILES['pdf_link']['name']) && $_FILES['pdf_link']['name']!='')
				{

					$pdf_link_data = time().'_'.$_FILES['pdf_link']['name'];
					Request::file('pdf_link')->move(
						base_path() . '/public/admin/images/banner/middlebottom', $pdf_link_data
					);
				}




				  if(isset($formData['start_date'])){ $input= $formData['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	      if(isset($formData['end_date'])){$input2= $formData['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));

	       }
	     else{$end_date='';}



		   if(isset($formData['title'])){$title = $formData['title'];}else{$title='';}

		   if(isset($formData['display_order'])){$display_order = $formData['display_order'];}else{$display_order='';}
		   if(isset($formData['url'])){$url = $formData['url'];}else{$url='';}
		    if(isset($formData['_token'])){$token = $formData['_token'];}else{$token='';}


	       $data['token'] = $token;
			$data['title'] = $title ;
			 $data['start_date'] = $start_date;
			 $data['end_date'] = $end_date;
			$data['display_order'] = $display_order;
			$data['url'] = $url;

			$data['banner'] = $imageName;
			$data['enlarge_banner'] = $enlargebannerdata;
			$data['pdf_link'] = $pdf_link_data;


			if(isset($formData['status'])){$status = $formData['status'];}else{$status='';}
			$data['status'] = $status;

			$data['modified'] = date('Y-m-d H:i:s');
			$data['created'] = date('Y-m-d H:i:s');
			DB::table('banner_middle_bottom')->insert($data);
		}



	/*add left banner*/
		function addLeftBanner($formData)
	{

	/*	echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		//$results = DB::table('banner_middle_top')->get();

		$imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/left', $imageName
					);
				}

				$enlargebannerdata = null;
				if(isset($_FILES['enlarge_banner']['name']) && $_FILES['enlarge_banner']['name']!='')
				{

					$enlargebannerdata = time().'_'.$_FILES['enlarge_banner']['name'];
					Request::file('enlarge_banner')->move(
						base_path() . '/public/admin/images/banner/left', $enlargebannerdata
					);
				}

				$pdf_link_data = null;
				if(isset($_FILES['pdf_link']['name']) && $_FILES['pdf_link']['name']!='')
				{

					$pdf_link_data = time().'_'.$_FILES['pdf_link']['name'];
					Request::file('pdf_link')->move(
						base_path() . '/public/admin/images/banner/left', $pdf_link_data
					);
				}




				  if(isset($formData['start_date'])){ $input= $formData['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	      if(isset($formData['end_date'])){$input2= $formData['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));

	       }
	     else{$end_date='';}



		   if(isset($formData['title'])){$title = $formData['title'];}else{$title='';}

		   if(isset($formData['display_order'])){$display_order = $formData['display_order'];}else{$display_order='';}
		   if(isset($formData['url'])){$url = $formData['url'];}else{$url='';}
		    if(isset($formData['_token'])){$token = $formData['_token'];}else{$token='';}


	       $data['token'] = $token;
			$data['title'] = $title ;
			 $data['start_date'] = $start_date;
			 $data['end_date'] = $end_date;
			$data['display_order'] = $display_order;
			$data['url'] = $url;

			$data['banner'] = $imageName;
			$data['enlarge_banner'] = $enlargebannerdata;
			$data['pdf_link'] = $pdf_link_data;

			 if(isset($formData['status'])){$status = $formData['status'];}else{$status='';}
			$data['status'] = $status;


			$data['modified'] = date('Y-m-d H:i:s');
			$data['created'] = date('Y-m-d H:i:s');

			$bannerId = DB::table('banner_left')->insertGetId($data);

			if(!empty($formData['categories'])){
				foreach ($formData['categories'] as $categoryId) {
					DB::table('banner_left_categories')->insert(["banner_id" => $bannerId, "category_id" => $categoryId]);
				}
			}
		}


		/*add left  promotionbanner*/
		function addleftpromotionbanner($formData)
	{

	/*	echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		//$results = DB::table('banner_left_promotion')->get();

		$imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/leftpromotion', $imageName
					);
				}

				$enlargebannerdata = null;
				if(isset($_FILES['enlarge_banner']['name']) && $_FILES['enlarge_banner']['name']!='')
				{

					$enlargebannerdata = time().'_'.$_FILES['enlarge_banner']['name'];
					Request::file('enlarge_banner')->move(
						base_path() . '/public/admin/images/banner/leftpromotion', $enlargebannerdata
					);
				}

				$pdf_link_data = null;
				if(isset($_FILES['pdf_link']['name']) && $_FILES['pdf_link']['name']!='')
				{

					$pdf_link_data = time().'_'.$_FILES['pdf_link']['name'];
					Request::file('pdf_link')->move(
						base_path() . '/public/admin/images/banner/leftpromotion', $pdf_link_data
					);
				}


				  if(isset($formData['start_date'])){ $input= $formData['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	      if(isset($formData['end_date'])){$input2= $formData['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));

	       }
	     else{$end_date='';}



		   if(isset($formData['title'])){$title = $formData['title'];}else{$title='';}

		     if(isset($formData['short_description'])){$short_description = $formData['short_description'];}else{$short_description='';}

		   if(isset($formData['display_order'])){$display_order = $formData['display_order'];}else{$display_order='';}
		   if(isset($formData['url'])){$url = $formData['url'];}else{$url='';}
		    if(isset($formData['_token'])){$token = $formData['_token'];}else{$token='';}


	       $data['token'] = $token;
			$data['title'] = $title ;
			$data['short_description']= $short_description;
			 $data['start_date'] = $start_date;
			 $data['end_date'] = $end_date;
			$data['display_order'] = $display_order;
			$data['url'] = $url;

			$data['banner'] = $imageName;
			$data['enlarge_banner'] = $enlargebannerdata;
			$data['pdf_link'] = $pdf_link_data;

			 if(isset($formData['status'])){$status = $formData['status'];}else{$status='';}
			$data['status'] = $status;


			$data['modified'] = date('Y-m-d H:i:s');
			$data['created'] = date('Y-m-d H:i:s');

			DB::table('banner_left_promotion')->insert($data);
		}



		/*add left  product banner*/
		function addproductbannerlist($formData)
	{

	/*	echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		//$results = DB::table('banner_left_promotion')->get();

		$imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/product', $imageName
					);
				}


				  if(isset($formData['start_date'])){ $input= $formData['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	      if(isset($formData['end_date'])){$input2= $formData['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));

	       }
	     else{$end_date='';}


		   if(isset($formData['title'])){$title = $formData['title'];}else{$title='';}
		   if(isset($formData['tick'])){$tick = $formData['tick'];}else{$tick='';}


		   if(isset($formData['_token'])){$token = $formData['_token'];}else{$token='';}

			if(isset($formData['category'])){$category = $formData['category'];}else{$category='';}
	       $data['tick'] = $tick;
		   $data['token'] = $token;
			$data['title'] = $title ;
			$data['category'] = $category ;
			 $data['start_date'] = $start_date;
			 $data['end_date'] = $end_date;

			$data['banner'] = $imageName;

			 if(isset($formData['status'])){$status = $formData['status'];}else{$status='';}
			$data['status'] = $status;


			$data['modified'] = date('Y-m-d H:i:s');
			$data['created'] = date('Y-m-d H:i:s');

			DB::table('product_banner_list')->insert($data);
		}


		function getLastUpdatedtop()
	{
		$results = DB::table('banner_top')->select('modified')->orderBy('modified','desc')->first();
		$count= count($results);

		if($count=='0')
		{
			return false;
		}
		else{

		return $results->modified;
		}
	}

	function getLastUpdatedmiddletop()
	{
		$results = DB::table('banner_middle_top')->select('modified')->orderBy('modified','desc')->first();
		$count= count($results);

		if($count=='0')
		{
			return false;
		}
		else{

		return $results->modified;
		}
	}

	function getLastUpdatedmiddlebottom()
	{
		$results = DB::table('banner_middle_bottom')->select('modified')->orderBy('modified','desc')->first();
		$count= count($results);

		if($count=='0')
		{
			return false;
		}
		else{

		return $results->modified;
		}
	}

	function getLastUpdatedleft()
	{
		$results = DB::table('banner_left')->select('modified')->orderBy('modified','desc')->first();
		$count= count($results);

		if($count=='0')
		{
			return false;
		}
		else{

		return $results->modified;
		}
	}

	function getLastUpdatedleftpromotion()
	{
		$results = DB::table('banner_left_promotion')->select('modified')->orderBy('modified','desc')->first();
		$count= count($results);

		if($count=='0')
		{
			return false;
		}
		else{

		return $results->modified;
		}
	}


	function getLastUpdatedproduct()
	{
		$results = DB::table('product_banner_list')->select('modified')->orderBy('modified','desc')->first();
		$count= count($results);

		if($count=='0')
		{
			return false;
		}
		else{

		return $results->modified;
		}
	}

	function deleteTopbannerm($formData)
	{
		DB::table('banner_top')->whereIn('id',explode(',',$formData['id']))->delete();

	}

	/*
	Delete selected item via ajax post
	 */
	function deleteTopBanners($formData)
	{
		DB::table('banner_top')->whereIn('id',explode(',',$formData))->delete();

	}

		/**
	 * Delete All banner From DB Table
	 */
	function deleteAlltopbannerdata()
	{
		DB::table('banner_top')->delete();

	}

	/**
	 * Delete  selected middle top banner From DB Table
	 */
	function deletemiddletop($formData)
	{
		DB::table('banner_middle_top')->whereIn('id',explode(',',$formData['id']))->delete();

	}


		/**
	 * Delete Allmddle top banner From DB Table
	 */
	function deleteAlltopmidlebannerdata()
	{
		DB::table('banner_middle_top')->delete();

	}



	/**
	 * Delete  selected middle top banner From DB Table
	 */
	function deletemiddlebottom($formData)
	{
		DB::table('banner_middle_bottom')->whereIn('id',explode(',',$formData['id']))->delete();

	}

		/**
	 * Delete Allmddle top banner From DB Table
	 */
	function deleteAllbottommidlebannerdata()
	{
		DB::table('banner_middle_bottom')->delete();

	}



		/**
	 * Delete  selected left banner From DB Table
	 */
	function deleteleftselected($formData)
	{
		DB::table('banner_left')->whereIn('id',explode(',',$formData['id']))->delete();

	}

		/**
	 * Delete Allmddle left banner From DB Table
	 */
	function deleteAllleftbannerdata()
	{
		DB::table('banner_left')->delete();

	}


		/**
	 * Delete  selected left banner From DB Table
	 */
	function deleteleftpromotionselected($formData)
	{
		DB::table('banner_left_promotion')->whereIn('id',explode(',',$formData['id']))->delete();

	}

		/**
	 * Delete Allmddle left banner From DB Table
	 */
	function deleteAllleftpromotionbannerdata()
	{
		DB::table('banner_left_promotion')->delete();

	}



		/**
	 * Delete  selected left banner From DB Table
	 */
	function deleteproductselected($formData)
	{
		DB::table('product_banner_list')->whereIn('id',explode(',',$formData['id']))->delete();

	}

		/**
	 * Delete Allmddle left banner From DB Table
	 */
	function deleteAllproductbannerdata()
	{
		DB::table('product_banner_list')->delete();

	}


	/*get categry data*/

	function getcategorydata()
	{
		$getcategory = DB::table('categories')->get();
		return $getcategory;
	}



}


