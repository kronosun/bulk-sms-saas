<?php 
	namespace App\Custom;
	use App\Suspicion;

	class Generic
	{
		public function raiseSuspicion($arr){
	        // insert into suspicion table.
	        $suspicion = new Suspicion;
	        foreach ($arr as $key => $value) {
	            $suspicion->$key = $value;
	        }
	        // $suspicion->type = $arr['type'];
	        // $suspicion->description = $arr['description'];
	        $suspicion->save();
	            // send a mail
	    }
	}


 ?>