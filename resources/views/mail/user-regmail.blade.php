<div class="row">
	<div  class="col-12 text-left">
		<img src="{{ asset('front-assets/images/logo_new.png') }}"  style="width: 200px; margin-left: 2%; margin-top: 20px;">
	</div>
</div>
<h3>Welcome!</h3>
{{-- <p>To get started, please click the button below to verify your email address.</p> --}}
<p>Thank you for joining JAVAT 365. Kindly verify your email address and complete your registration by clicking the link below.</p>
@php
	$email = $user->email;
	$verification_code = $user->verification_code;
@endphp

	<a style="background-color: #5c449b; color:white; padding: 7px; text-decoration: none; border-radius: 5px; "  href="{{ url('verify-email/'.$email.'/'.$verification_code) }}">Verify Email</a>

	<p>If the button does not work, please click the link below or copy and paste it in your browser to get verified.</p>

	<p><a href="{{ url('verify-email/'.$email.'/'.$verification_code) }}">{{ url('verify-email/'.$email.'/'.$verification_code) }}</a></p>
	<p>If you did not make this request, you can ignore this email. No account will be created without verification</p>
<hr>
	<p>This message was sent to you by JAVAT 365</p>

	<p>For support, contact us via <a href="mail-to:support@java365.com"></a>support@javat365.com</p>
	<img src="{{ asset('front-assets/images/logo_new.png') }}"  style="width: 60px;">
	<p style="font-size:12px;">Copyright &copy; JAVAT 365 - 2021 </p>
