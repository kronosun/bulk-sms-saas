<?php 
	use App\SiteSetting;
	use App\Custom\SanitizeInput;

	function clean($input){
		$clean = new SanitizeInput;
		return $clean->sanitizeInput($input);
	}
	
	function siteSetting(){
		$siteSetting = SiteSetting::first();
		return $siteSetting;
	}


 ?>