
		
		 
		
		
		function inputValidation(){
			const password = document.querySelector("#new-pass").value;
			const confirmPassword = document.querySelector("#new-pass-1").value;
			var confimrPasswordWarning = document.querySelector("#confirmPasswordMessage");
			var passwordWarning = document.querySelector("#passwordMessage");

			// if second input field is empty
			if(confirmPassword !==''){
					// if the password field is not empty
				if ( password !==''){
					// if password field matches confirm password
					if ( password === confirmPassword){
						confimrPasswordWarning.textContent = "";

					}else {
						// if password field does not match confirm password
						confimrPasswordWarning.textContent = "Password mismatch";
						passwordWarning.textContent = "";

					}

				}else {
					// if the password field is empty
					passwordWarning.textContent = "This field is compulsory";
				}
			}
			

			
		};
		


		// const error = document.getElementById("error");
		// mainForm.onsubmit = function(){
		// 	if (myForm.value == ""){
		// 	error.innerHTML = "Please enter  a name"; 
		// 	return false;
		// } else { error.innerhtml= ""; 
		// return true; 
		// }};