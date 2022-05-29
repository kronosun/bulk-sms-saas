<?php 
	/**
	 * summary
	 */
	namespace App\Custom;

	use App\ApiIntegration;
	use App\SmsLog;
	
	class NigeriaBulkSMS
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        $this->apiData = ApiIntegration::where('name', 'nigerian_bulk_sms')->first();
	    }

	    function send($arr, $msg, $msg_id){
	    	$numbers = implode(',', $arr);
			$curl = curl_init();

			/*curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://www.bulksmsnigeria.com/api/v2/sms/create?api_token='.$this->apiData->api_token.'&from=BulkSMSNG&to='.$numbers.'&body='.$msg.'&dnd=1',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			));*/


			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://www.bulksmsnigeria.com/api/v2/sms/create?=',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array('api_token' => $this->apiData->api_token,'from' => 'Skezzole','to' => $numbers,'body' => $msg, 'gateway' => '0','append_sender' => '0'),
			  CURLOPT_HTTPHEADER => array(
			    'Accept: application/json'
			  ),
			));

			$response = curl_exec($curl);

	        $err = curl_error($curl);
	        curl_close($curl);
	        if ($err) {
	            return $err;
	        }else{
	        	$log = new SmsLog;
	        	$log->log = $response;
	        	$log->message_id = $msg_id;
	        	$log->save();
	            return $response;
	        }


	    }
	}


 ?>