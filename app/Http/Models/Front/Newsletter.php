<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
use URL;
class Newsletter extends Model{

	/**
	 * Insert Subscriber to DB Table
	 */
	function addSubscriber($formData)
	{
		$results = DB::table('newsletter')->where('email',$formData['email'])->get();

		if(count($results)!=0){
			$json['error'] = "This Email Id is already in use."; 
			echo json_encode($json);
			exit;
		}else{
			$data['email'] = $formData['email'];
			$data['status']=1;
			
			
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['created_at'] = date('Y-m-d H:i:s');

			
			DB::table('newsletter')->insert($data);
			$this->sendsubscriptionmailtocustomer($data);
			return true;
		}
	}
	function sendsubscriptionmailtocustomer($formData)
	{  

		$mail=$formData['email'];;
		$to = $formData['email'];
		$to_name = $formData['email'];
		$from = 'registration@ritzgardenhotel.com';
		$from_name = 'Ritz Garden Hotel Ipoh';
		$subject = " Newsletter Subscription with Ritz Garden Hotel Ipoh";
		$url=URL::to('/');
		$url.="/public/front/images/index/logo.png";
				
		$message = "Dear ".$formData['email'].",<br><br>";
		$message .= "This is  confirmation on your successful Newsletter Subscription with Ritz Garden Hotel Ipoh.<br/>";
				
		$message .= "<br><br>Hi there!<br>
		You have now been added to the mailing list and will receive the next email informtion in the coming days or weeks. if <br>
		you ever wish to unsbscribe , simply use the unsubscribe link included in each newsletter. We're excited that we'll have <br>
		you as a customer soon!<br>
		in the meantime, come and like us on Facebook!<br><br>
		
		https://www.facebook.com/RitzGardenHotelIpoh/<br><br>
		
		Thanks again for signing up!<br><br>
		<img src=".$url." alt='Ritz Garden Hotel' class='logo'><br>
		Thank you.<br>
		Best regards,<br>
		Ritz Garden Hotel Online Registration Manager<br>
		Ritz Garden Hotel<br>
		No. 86 & 88, Jalan Yang Kalsom, 30250 Ipoh Perak Darul Ridzuan, Malaysia.<br>
		Tel: (05) 242-7777<br>
		Fax: (603) 242-5845<br>
		sales@ritzgardenhotel.com<br>
		lily@ritzgardenhotel.com<br>
		 <br/>";
		$headers = "From:".$from . "\r\n" ;
		$headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      //  print_r("to--".$to."subject--".$subject."message--".$message."headers---".$headers);die();
		mail($to,$subject,$message,$headers);
		return true;
	}
}