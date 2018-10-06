<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB;
class Categories extends Model{

	

	/*REFACTOR*/
	protected $table = 'categories';

	
	public function getAll($parent_id = 0)
	{
		$data = $this->where('parent_id', $parent_id)->orderBy('order_no', 'ASC')->get();
		foreach($data as $cat) {
			$cat->category_id = $cat->id;
		}
		return $data;
	}
	/*END REFACTOR*/
	
	function getCategories($parent_id = 0)
	{
		$categories = array();
		$results = DB::table('categories')->select('*', 'id as category_id')->where('parent_id', '=', $parent_id)->orderBy('order_no', 'ASC')->get();
		
		foreach($results as $result){
			$categories[] = array(
				'category_id'			=> $result->category_id,
				'title'					=> $result->title,
				'iconKeyword'			=> $result->iconKeyword,
				'image'					=> $result->image,
				'alt_text'				=> $result->alt_text,
				'image2'				=> $result->image2,
				'alt_text2'				=> $result->alt_text2,
				'parent_id'				=> $result->parent_id,
				'order_no'				=> $result->order_no,
				'code'					=> $result->code,
				'status'				=> $result->status,
				'sub_categories'		=> $this->getCategories($result->category_id),
			);
		}
				
		return $categories;	
	}
	
	function getParentCategories()
	{
		return DB::table('categories')->where('parent_id',0)->where('status','1')->get();	
	}
	/****************************HOME FEATURED PRODUCTS*************************************************************/

/*catlog products*/



function getcategory_home_list_enabletab()
	{
		$gettaballdata=array();
		$getcatdata=DB::select("SELECT * FROM `category_home_list` WHERE `status`=1 and`enable_tab`=1 order by 'created' asc ");
		$cattotal= count($getcatdata);
		
		for($k=0;$k<=$cattotal;$k++){
			if(isset($getcatdata[$k]->id) && $getcatdata[$k]->id!=''){
				$catid= $getcatdata[$k]->id;
				$cat_title= $getcatdata[$k]->cat_title;
				$gettaballdata[$k]['category']['title'] =$cat_title;
				$gettaballdata[$k]['category']['id'] =$catid;
				$gettabdata=DB::select("SELECT * FROM `category_home_list_tablisting` WHERE `status`=1 and category_id='".$catid."' order by `display_order` asc");
				$tabtotal= count($gettabdata);
				
				for($i=0;$i<=$tabtotal;$i++){
					if(isset($gettabdata[$i]->id) && $gettabdata[$i]->id!=''){
						
						$gettaballdata[$k]['tabs'][$i]['id'] = $gettabdata[$i]->id;
						$gettaballdata[$k]['tabs'][$i]['title'] = $gettabdata[$i]->title;
						
						$tabid= $gettabdata[$i]->id;
				
						$getRecs=DB::select("SELECT * FROM category_home_addtabproductsdata WHERE tabid=".$tabid." order by display_order asc");
								
						$j=0;
						foreach($getRecs as $getRec){				
								$getProductDetail = DB::select("SELECT * FROM products WHERE status =1 and id=".$getRec->productid."");
								if(isset($getProductDetail[0])){
									$gettaballdata[$k]['tabs'][$i]['productDetail'][$j] = $getProductDetail[0];
									$j++;
								}
						}
								
					}
				}
			}
		}
		return $gettaballdata;
	}
	
	
	function getcategory_home_list_disabletab()
	{
		
		$getcatdata=DB::select("SELECT * FROM category_home_list WHERE status=1 and enable_tab='0' order by created asc ");
		$total= count($getcatdata);
		$getcatalldata=array();
		for($i=0;$i<=$total;$i++)
		{
			if(isset($getcatdata[$i]->id) && $getcatdata[$i]->id!='')
			{
			 	$catid= $getcatdata[$i]->id;
				
				$getRecs=DB::select("SELECT * FROM category_home_addtabproductsdata WHERE tabid=0 and homecatid=".$catid." order by display_order asc");
				
				$j=0;
				foreach($getRecs as $getRec){				
					$getProductDetail = DB::select("SELECT * FROM products WHERE status = 1 and id=".$getRec->productid."");
					if(isset($getProductDetail[0])){
						$getcatalldata[$i]['productDetail'][$j] = $getProductDetail[0];
						$j++;
					}
				}
				
				$getcatalldata[$i]['catName'] = $getcatdata[$i]->cat_title;
				$getcatalldata[$i]['catid'] = $getcatdata[$i]->id;
				
				
			}
		}
		return $getcatalldata;
	}


	
}

?>