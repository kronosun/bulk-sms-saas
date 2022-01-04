<?php 
	use App\SiteSetting;
	
	function siteSetting(){
		$siteSetting = SiteSetting::first();
		return $siteSetting;
	}

 ?>