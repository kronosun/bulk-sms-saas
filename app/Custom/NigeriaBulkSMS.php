<?php 
	/**
	 * summary
	 */
	namespace App\Custom;

	use App\Models\ApiIntegration;
	
	class NigeriaBulkSMS
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        $this->$apiData = ApiIntegration::where('name', 'nigerian_bulk_sms')->first();
	    }

	    function send($arr, $msg){
	    	$numbers = implode(',', $arr);
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$this->apiData->api_token.'&from=Skezzole&to='.$numbers.'&body='.$msg.'&dnd=1',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			));

			$response = curl_exec($curl);

	        $err = curl_error($curl);
	        curl_close($curl);
	        if ($err) {

	            return $err;
	        }else{
	            return $response;
	        }

	    }
	}


 ?>