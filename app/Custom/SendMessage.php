<?php 
	namespace App\Custom;

	use Pnlinh\InfobipSms\Facades\InfobipSms;
	use App\UnitPurchase;

	class SendMessage
	{


		public function sendMulti($array, $message, $units, $user_id){

			// return $units;
			$this->deductTime($units, $user_id);
			return 'done';
			
	        // $response = InfobipSms::send($array, $message);
	        // return $response;
	    }


		function deductTime($units, $user_id){
			// while ($balance > 0) {
			    $availableUnits = UnitPurchase::where('user_id', $user_id)->where('available_units', '>', '0')->first();
			    if ($availableUnits >= $units) {
			    	$availableUnitBal = $availableUnits - $units;
			    	$availableUnits->available_units = $availableUnitBal;
			    	$unitBal = 0;
			    	$availableUnits->save();
			    }else{
			    	$availableUnitBal =  0;
			    	$unitBal = $units - $availableUnits->available_units;
			    	$availableUnits->save();
			    	$this->deductTime($unitBal, $user_id)
			    }
			    

			    // $unitBal = $
			// }
			// $availableUnits = UnitPurchase::where('user_id', $user_id)->where('available_units', '>', '0')->get();
			// foreach($availableUnits as $availableUnit){

			// 	// if avaiable units in the row can sort out the messages
			// 	if ($availableUnit->available_units > $units) {
			// 		dd('yes';)
			// 		$availableUnit->available_units = $availableUnit->available_units - $units;
			// 		$availableUnit->save();
					
			// 	}else{
			// 		$unitBal = $units - $availableUnit->available_units;
					
			// 		$availableUnit->available_units = $availableUnit->available_units-$unitBal;
			// 		$availableUnit->save();
					
			// 		if ($unitBal > 0) {
			// 			dd('ait');
			// 			$this->deductTime($unitBal, $user_id);
			// 		}
					
			// 	}


			// }
		}

	}






 ?>