<?php

class Page extends Eloquent
{
	public static $unguarded = true;

	public static function upBgImage($data)
    {
        try
        {
			$image = '';
			// If isset img
			if($data['bgimage']){
			//	$destinationPath = base_path() . "/images/";
				$destinationPath = realpath(base_path().'/../shop/public/front/images').DIRECTORY_SEPARATOR;
	            $name = Input::file('bgimage')->getClientOriginalName();
			//	Input::file('bgimage')->move($destinationPath, $destinationPath . $name);
			//	$image = "../images/" . $name;
			    Input::file('bgimage')->move($destinationPath, $name);
				$image = $name;
			}
			
            $page = Page::where('page', '=', $data['page'])->firstOrFail();
			
			// If not img
			$old = unserialize($page->bgimage);
			
			if(!$image)
				$image = $old['image'];
			
			if(isset($data['active']) && $data['active'] === '1')
				$active = 1;
			else
				$active = 0;
			
			$background = [ 'active' => $active, 'title' => $data['title'], 'image' => $image ];
			$page->bgimage = serialize($background);
			$page->save();
			
        }
        catch (Exception $e)
        {
            return false;
        }
        return $page;
    }
	
	public static function addObjective($data)
	{
		 try
        {
			
            $page = Page::where('page', '=', $data['page'])->firstOrFail();
			
			if($page->slider_text)
				$objective = unserialize($page->slider_text);
			
			if(isset($data['active']) && $data['active'] === '1')
				$active = 1;
			else
				$active = 0;
			
			$objective[] = [ 'active' => $active, 'title' => strip_tags($data['title']) ];
			$page->slider_text = serialize($objective);
			$page->save();
			
        }
        catch (Exception $e)
        {
            return false;
        }
        return $page;
	}
	
	public static function editObjective($data)
	{
		 try
        {
			
            $page = Page::where('page', '=', $data['page'])->firstOrFail();
			
			if($page->slider_text)
				$objective = unserialize($page->slider_text);
			
			if(isset($data['active']) && $data['active'] === '1')
				$active = 1;
			else
				$active = 0;
			
			$objective[$data['index']] = [ 'active' => $active, 'title' => strip_tags($data['text']) ];
			$page->slider_text = serialize($objective);
			$page->save();
			
        }
        catch (Exception $e)
        {
            return false;
        }
        return $page;
	}
	
	// Page Settings
	// Animate
	public static function getFooteranimate($type = 'old_content')
	{
		$data = DB::table('pages')->where('page', 'animated_list')->first();
		$item = [];
		if(!empty($data->$type))
			$item = unserialize($data->$type);
		$animated = [];
		if(!empty($data->slider_text))
			$animated = unserialize($data->slider_text);
		$arr = [$item, $animated];
		return $arr;
	}
	
	// Footer
	public static function getFooterinfo()
	{
		$data = DB::table('pages')->where('page', 'footer_setup')->first();
		$arr = [];
		if(!empty($data->slider_text))
			$arr = unserialize($data->slider_text);
		return $arr;
	}
	
	// Header
	public static function getHeaderinfo()
	{
		$data = DB::table('pages')->where('page', 'header_setup')->first();
		$arr = [];
		if(!empty($data->slider_text))
			$arr = unserialize($data->slider_text);
		return $arr;
	}
	
	
}