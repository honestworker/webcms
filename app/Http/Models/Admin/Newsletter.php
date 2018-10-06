<?php
namespace App\Http\Models\Admin; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
class Newsletter extends Model{

	
	/**
	 * Fetch User Subscribers From DB Table
	 */
	function getSubscribers($item, $page)
	{
		if($page>1){
			$startLimit = ($page-1)*$item;
		}else{
			$startLimit = 0;	
		}
		
		$results = DB::table('newsletter')->orderBy('id','desc')->offset($startLimit)->take($item)->get();		
		return $results;
	}
	
	
	/**
	 * Get Last Update Record From DB Table
	 */
	function getLastUpdated()
	{
		$results = DB::table('newsletter')->select('updated_at')->orderBy('updated_at','desc')->first();
		return $results->updated_at;
	}
	
	
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
			$data['name'] = $formData['subscriberName'];
			$data['email'] = $formData['email'];
			$status = $formData['status'];
			if($status==1){
				$data['status']=1;
			}else{
				$data['status']=0;
			}
			
			
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['created_at'] = date('Y-m-d H:i:s');

			
			DB::table('newsletter')->insert($data);
			$this->sendsubscriptionmaildata($data);
			return true;
		}
	}
	function sendsubscriptionmaildata($formData)
	{ 
		$mail=$formData['email'];;
		$to = $formData['email'];
		$to_name = $formData['name'];
		$from = 'shop@tbm.com.my';
		$from_name = 'SHOP TBM';
		$subject = " Newsletter Subscribtion with TBM.";
		$message = "Dear ".$formData['name'].",<br><br>";
		$message .= "This is  confirmation  About  successful Subscribtion with TBM.<br/>";
				
		$message .= "<br><br>HI there!<br>
		You have now been added to the mailing list and will receive the next email informtion in the coming days or weeks. if <br>
		you ever wish to unsbscribe , simply use the unsubscribe link included in each newsletter. We're excited that we'll have <br>
		you as a customer soon!<br>
		in the meantime, come and like us on Facebook!<br><br>
		
		https://www.facebook.com/tbm2u<br><br>
		
		Thanks again for signing up!<br><br>
		
		Thank you,
		Best regards,<br>
		TBM Online Registration Manager<br>
		TAN BOON MING SDN BHD (494355-D)<br>
		PS 4,5,6 & 7, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur.<br>
		Tel: (603) 7983-2020 (Hunting Lines)<br>
		Fax: (603) 7982-8141<br>
		info@tbm.com.my<br>
		Business Hours:<br>
		Mon. - Sat.: 9.30am - 9.00pm<br>
		Sun.: 10.00am - 9.00pm <br/>";
		
		$headers = "From:".$from . "\r\n" ;
		$headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		mail($to,$subject,$message,$headers);
		return true;
	}
	
	/**
	 * Update Subscriber to DB Table
	 */
	function updateSubscriber($formData)
	{
		$results = DB::table('newsletter')->where('email',$formData['email'])->get();

		if(count($results)!=0 && $results[0]->id!=$formData['subscriberId']){
			$json['error'] = "This Email Id is already in use."; 
			echo json_encode($json);
			exit;
		}else{
			$data['name'] = $formData['subscriberName'];
			$data['email'] = $formData['email'];
			$status = (isset($formData['status']) && $formData['status'] == '1') ? '1' : '0';
			$data['status'] = $status;
			
			$data['updated_at'] = date('Y-m-d H:i:s');
		
			DB::table('newsletter')->where('id', $formData['subscriberId'])->update($data);	
		}
	}
	
	
	/**
	 * Delete Subscribers From DB Table
	 */
	function deleteSubscribers($formData)
	{
		DB::table('newsletter')->whereIn('id',explode(',',$formData['subscriberId']))->delete();
		
	}
	
	
	/**
	 * Delete All Subscribers From DB Table
	 */
	function deleteAll()
	{
		DB::table('newsletter')->delete();
		
	}
	
}