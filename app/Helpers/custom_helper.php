<?php


//http://stackoverflow.com/questions/28290332/best-practices-for-custom-helpers-on-laravel-5
/*function testHelper()
{
	echo 'helper called'; exit;	
}

function productImage($fileName)
{
	// thumbnail name
	$file_name = explode('.',$fileName);
	$file_ext = array_pop($file_name);
	$thumb_name = implode('.',$file_name).'_thumb.'.$file_ext;

	return $thumb_name;	
}
*/
use Illuminate\Support\Facades\Route;
function getIndex()
{	
	echo Route::getCurrentRoute()->getActionName();
	print_r(Route::getCurrentRoute()->getAction());
}

?>