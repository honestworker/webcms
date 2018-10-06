<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

class GlobalSettings extends Model{

	protected $table = 'global_setting';



	public static function saveSettings($key, $value)
	{
		if($key == 'global_open_close'){
			$settings = GlobalSettings::findOrNew(1);
			$settings->key = $key;
			$settings->value = $value;
			return $settings->save();
		} else if ($key == 'product_global'){
			$settings = GlobalSettings::findOrNew(2);
			$settings->key = $key;
			$settings->value = $value;
			return $settings->save();
		}
	}

	public static function getSettings($key){
		if($key == 'global_open_close'){
			return GlobalSettings::find(1);
		} else if ($key == 'product_global'){
			return GlobalSettings::find(2);
		}

	}


}