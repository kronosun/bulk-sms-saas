@extends('layouts.dashboard.app')
@section('title', 'Buy Unit')
@section('content')
	<div class="main-container">
        @include('layouts.shared.alert')
        <div class="content" style="margin-top: 50px;">
            <div class="container">

                <div class="row">
                    <div class="col-md-10 offset-md-1 ">
                        <div class="card" id="paymentSection" style="border-radius: 10px!important;">
                            <div class="card-body" style="border-radius: 10px!important;">
                            
                                <!-- Checkout Form -->
                                
                                <div style="box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 18%) !important; border-radius: 10px;">
                                    <!-- Personal Information -->
                                    <div class="info-widget" style="background-color: #71a4c6; border-top-right-radius: 10px; border-top-left-radius: 10px;">
                                        
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h2 class="mt-3" style="color: white;">Buy Credit</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="text-center summary-amount mt-2"><sup>₦</sup><span id="cost">0</span></h1>
                                    
                                    <div class="px-2 pb-3 row mt-3">
                                       <div class="col-md-6 form-group">
                                        <label>Units</label>
                                           <input type="number" name="units" id="unit-input" class="form-control" placeholder="how many units are you buying">
                                       </div>
                                       <div class="col-md-6 form-group">
                                        <label>Cost (NGN)</label>
                                           <input type="number" name="cost" id="cost-input" class="form-control" placeholder="Amount to spend in NGN">
                                       </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 text-left">
                                        <h4 class="card-title mt-5 ">Payment Method</h4>

                                        <p>Select your preffered payment method to proceed </p>
                                    </div>
                                    <div class="col-12 mt-2">
                                        
                                        <div class="accordion" id="accordionExample">
                                          <div class="card">
                                            <div class="card-header py-1" id="headingOne">
                                              <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#flutterwave-div" aria-expanded="true" aria-controls="flutterwave-div" style="background-color:transparent!important; border:1px solid transparent;">
                                                  <label>
                                                      <input type="radio" name="test" value="big">
                                                        <img src="http://localhost/consult/assets/img/flutterwave.png" width="150">
                                                    </label>
                                                </button>
                                              </h2>
                                            </div>

                                            <div id="flutterwave-div" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                              <div class="card-body py-2">
                                               <form>
                                                    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                                                    <button class="btn btn-navy" type="button" onClick="payWithRave()" id="rave-btn">Pay with Flutterwave</button>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="card">
                                            <div class="card-header py-1" id="headingTwo">
                                              <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#credit-card-div" aria-expanded="false" aria-controls="credit-card-div" style="background-color:transparent!important; border:1px solid transparent;">
                                                  <label class="text-dark">
                                                      <input type="radio" name="test" value="small">
                                                        Credit & Debit Cards 
                                                        <img src="http://localhost/quicklatest/front_assets/media/visa-icon.png" class="mr-2">
                                                        <img src="http://localhost/quicklatest/front_assets/media/master-icon.png" class="mr-2">
                                                        <img src="http://localhost/quicklatest/front_assets/media/amex.png" height="43">
                                                        <img src="http://localhost/quicklatest/front_assets/media/discover.jpg" height="52">
                                                    </label>
                                                </button>
                                              </h2>
                                            </div>
                                            <div id="credit-card-div" class="collaps" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                              <div class="card-body py-2">
                                                <form method="post" id="paymentForm" class="mt-n4">
                                                    <input type="hidden" name="_token" value="y2QmyEbdWP3fmESHgquzER5KnbvX9YsLNEyV0sTi">                                            <div class="payment-widget">
                                                        <h4 class="card-title mt-5">Card Details</h4>
                                                        
                                                        <!-- Credit Card Payment -->
                                                        <div class="payment-list">
                                                            
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group card-label">
                                                                        <label for="card_name">Name on Card</label>
                                                                        <input class="form-control" id="card_name" name="name_on_card" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group card-label">
                                                                        <label for="card_number">Card Number</label>
                                                                        <input class="form-control" maxlength="20" id="card_number" name="card_number" placeholder="1234  5678  9876  5432" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group card-label">
                                                                        <label for="expiry_month">Expiry Month</label>
                                                                        <input class="form-control" id="expiry_month" name="expiry_month" placeholder="MM" type="text" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group card-label">
                                                                        <label for="expiry_year">Expiry Year</label>
                                                                        <input class="form-control" id="expiry_year" name="expiry_year" placeholder="YYYY" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group card-label">
                                                                        <label for="cvv">CVV</label>
                                                                        <input class="form-control" id="cvv" type="text" name="cvv" placeholder="123">
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="card_type" id="card_type" value=""/>
                                                                <input type="hidden" name="plan_id" id="plan_id" value="1"/>
                                                            </div>
                                                        </div>
                                                        <!-- /Credit Card Payment -->
                                                        
                                                        <!-- Paypal Payment -->
                                                        
                                                        
                                                        <!-- Submit Section -->
                                                        <div class="submit-section mt-4">
                                                            <button type="button" class="btn btn-navy submit-btn payment-btn" id="cardSubmitBtn">Confirm and Pay</button>
                                                        </div>
                                                        <!-- /Submit Section -->
                                                        
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="card">
                                            <div class="card-header py-1" id="headingTwo">
                                              <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bank-transfer-div" aria-expanded="false" aria-controls="bank-transfer-div" style="background-color:transparent!important; border:1px solid transparent;">
                                                  <label class="text-dark">
                                                      <input type="radio" name="test" value="small">
                                                        Bank transfer
                                                       
                                                    </label>
                                                </button>
                                              </h2>
                                            </div>
                                            <div id="bank-transfer-div" class="collaps" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                              <div class="card-body py-2">
                                                Bank Detail Goes in here
                                              </div>
                                            </div>
                                          </div>
                                          
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <p style="font-size: 12px;">
                                            Your plan will auto-renew unless cancelled before the next renewal date. By proceeding, I agree to the <a style="color:blue;" href="">Terms of Service</a>, <a style="color:blue;" href="">Privacy Policy</a>, and <a style="color:blue;" href="">Anti-Spam Policy</a>. I want to receive promotional emails, including product updates, special offers, and best practices, unless I opt out.
                                        </p>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    
    <div id="loading" class="d-none">
      <img id="loading-image" src="" alt="Loading..." />
      <p>
          <span>Please wait...</span>
      </p>
    </div>

    <style>
        #loading {
          position: fixed;
          display: block;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          text-align: center;
          opacity: 0.7;
          background-color: black;
          z-index: 99;
        }

        #loading-image {
          position: absolute;
          top: 30%;
          left: 40%;
          z-index: 100;
        }
        #loading p {
            /*float: left;*/
            font-size: 1em;
            font-weight: bold;
            padding: 6px 0 0 12px;
            white-space: nowrap;
            left: 44%; 
            margin-top: 21%;
            position: absolute;
            opacity: 1;
        }

            @media(max-width:  992px){
               #loading-image {
                  position: absolute;
                  top: 15%;
                  left: 40%;
                  z-index: 100;
                  height: 200px;
                }

                #loading p {
                /*float: left;*/
                font-size: 1em;
                font-weight: bold;
                padding: 6px 0 0 12px;
                white-space: nowrap;
                left: 45%; 
                margin-top: 34%;
                position: absolute;
                opacity: 1;
            }

             @media(max-width:  768px){
               #loading-image {
                  position: absolute;
                  top: 15%;
                  left: 37%;
                  z-index: 100;
                  height: 200px;
                }

                #loading p {
                /*float: left;*/
                font-size: 1em;
                font-weight: bold;
                padding: 6px 0 0 12px;
                white-space: nowrap;
                left: 43%; 
                margin-top: 40%;
                position: absolute;
                opacity: 1;
            }

            @media(max-width:  576px){
               #loading-image {
                  position: absolute;
                  top: 15%;
                  left: 30%;
                  z-index: 100;
                  height: 200px;
                }

                #loading p {
                /*float: left;*/
                font-size: 1em;
                font-weight: bold;
                padding: 6px 0 0 12px;
                white-space: nowrap;
                left: 37%; 
                margin-top: 50%;
                position: absolute;
                opacity: 1;
            }

            @media(max-width:  575px){
               #loading-image {
                  position: absolute;
                  top: 15%;
                  left: 30%;
                  z-index: 100;
                  height: 150px;
                }

                #loading p {
                /*float: left;*/
                font-size: 1em;
                font-weight: bold;
                padding: 6px 0 0 12px;
                white-space: nowrap;
                left: 32%; 
                margin-top: 70%;
                position: absolute;
                opacity: 1;
            }
        }
    </style>

    <script>
    function cardFormValidate(){
    var cardValid = 0;
      
    // Card number validation
    $('#card_number').validateCreditCard(function(result) {
        console.log(result)
        var cardType = (result.card_type == null)?'':result.card_type.name;
        if(cardType == 'Visa'){
            var backPosition = result.valid?'2px -163px, 260px -87px':'2px -163px, 260px -61px';
        }else if(cardType == 'MasterCard'){
            var backPosition = result.valid?'2px -247px, 260px -87px':'2px -247px, 260px -61px';
        }else if(cardType == 'Maestro'){
            var backPosition = result.valid?'2px -289px, 260px -87px':'2px -289px, 260px -61px';
        }else if(cardType == 'Discover'){
            var backPosition = result.valid?'2px -331px, 260px -87px':'2px -331px, 260px -61px';
        }else if(cardType == 'Amex'){
            var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
        }else{
            var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
        }
        $('#card_number').css("background-position", backPosition);
        if(result.valid){
            $("#card_type").val(cardType);
            $("#card_number").removeClass('required');
            cardValid = 1;
        }else{
            $("#card_type").val('');
            $("#card_number").addClass('required');
            cardValid = 0;
        }
    });
      
    // Card details validation
    var cardName = $("#name_on_card").val();
    var expMonth = $("#expiry_month").val();
    var expYear = $("#expiry_year").val();
    var cvv = $("#cvv").val();
    var regName = /^[a-z ,.'-]+$/i;
    var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
    var regCVV = /^[0-9]{3,3}$/;
    if(cardValid == 0){
        $("#card_number").addClass('required');
        $("#card_number").focus();
        return false;
    }else if(!regMonth.test(expMonth)){
        $("#card_number").removeClass('required');
        $("#expiry_month").addClass('required');
        $("#expiry_month").focus();
        return false;
    }else if(!regYear.test(expYear)){
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").addClass('required');
        $("#expiry_year").focus();
        return false;
    }else if(!regCVV.test(cvv)){
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").addClass('required');
        $("#cvv").focus();
        return false;
    }else if(!regName.test(cardName)){
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").addClass('required');
        $("#name_on_card").focus();
        return false;
    }else{
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").removeClass('required');
        $('#cardSubmitBtn').prop('disabled', false);  
        return true;
    }
}
const ravePubKey = "{{ env('RAVE_PUB_KEY') }}";
 function payWithRave() {
    $('#rave-btn').html('<i class="fa fa-spin fa-spinner"></i> connecting...');
    $('#rave-btn').prop('disabled', true);
    $.ajax({
        type:'POST',
        url: "{{ route('create-payment') }}",
        data:{
            description:"Unit Purchase by {{ Auth::user()->username }}",
            currency: "NGN",
            gateway: "rave",
            amount: $('#cost-input').val(),
            purpose: "credit_purchase",
            _token:universal_token,
        },
        success:function(data){
            feedback = JSON.parse(data);
            if (feedback.status == 'success') {

                var x = getpaidSetup({
                    PBFPubKey: ravePubKey,
                    customer_email: "{{ Auth::user()->email }}",
                    amount: feedback.amount,
                    currency: "NGN",
                    txref: feedback.reference,
                    meta: [{
                        metaname: "SkezzoleRef",
                        metavalue: feedback.reference,
                    }],
                    onclose: function(){
                        $('#rave-btn').html(oldHtml);
                        $('#rave-btn').prop('disabled', false);
                    },
                    callback: function(response) {
                       
                        console.log(response.data);
                        // return;
                        if(response.data.data.responsecode == "00" || response.data.data.responsecode == "0"){
                            
                            $.ajax({
                                type:'POST',
                                url: "{{ route('update-payment') }}",
                                data:{
                                    reference:response.data.tx.txRef,
                                    id:response.data.tx.id,
                                    amount: response.data.tx.amount,
                                    payResponse: response.tx,
                                    _token: universal_token
                                },
                                success:function(updateData){
                                    updateData = JSON.parse(updateData)
                                    if(updateData.status =='success'){
                                        window.location.replace("{{ url('home') }}");
                                    }else{
                                       console.log(updateData)
                                        alert('payment failed. Something went wrong');
                                    }
                                },
                                error:function(xhr,status,error){
                                    alert(error)
                                },
                            });

                        }else {

                            if (response.data.respcode == "00" || response.data.respcode == "0") {
                                $.ajax({
                                    type:'POST',
                                    url: "{{ route('update-payment') }}",
                                    data:{
                                        reference:response.data.tx.txRef,
                                        id:response.data.tx.id,
                                        amount: response.data.tx.amount,
                                        payResponse: response.tx,
                                        _token: universal_token
                                    },
                                    success:function(updateData){
                                        updateData = JSON.parse(updateData)
                                        if(updateData.status =='success'){
                                            window.location.replace("{{ url('home') }}");
                                        }else{
                                           console.log(updateData)
                                            alert('payment failed. Something went wrong');
                                        }
                                    },
                                    error:function(xhr,status,error){
                                        alert(error)
                                    },
                                });
                            }else{
                                alert('Something went wrong. It seems there is something wrong with your card. and try the following: <ul> <li> Check if your card is funded. If not, reload page, fund card and try again</li> <li>Try another card</li> <i>If Error Persists, Contact support with error code: JAV-002</i>');
                            }
                            
                        }
                        $('#rave-btn').html(oldHtml)
                        $('#rave-btn').prop('disabled', false)
                        // x.close(); // use this to close the modal immediately after payment.
                    }       
                })
            }
            
        },
        error:function(param1, param2, param3){
             $('#rave-btn').html(oldHtml);
            $('#rave-btn').prop('disabled', false);
            alert(param3);
        }
   });
}
    

    $(document).ready(function(){
        
        // Initiate validation on input fields
        $('#card_number, #expiry_month, #expiry_year, #cvv').on('keyup',function(){
            cardFormValidate();
        });


        // Submit card form
        $("#cardSubmitBtn").on('click',function(){
            var oldHtml = $(this).html();
            $("#cardSubmitBtn").prop('disabled', true)
            $('.status-msg').remove();
            if(cardFormValidate()){
                // var formData = $('#paymentForm').serialize();
                var card_holder = $('#name_on_card').val();

                var card_number = $('#card_number').val();
                var expiry = $('#expiry_year').val()+'-'+$('#expiry_month').val();
                var cvv = $('#cvv').val();
                var card_type = $('#card_type').val();
                $.ajax({
                    type:'POST',
                    url: "",
                    data:{
                        card_holder:card_holder,
                        expiry: expiry,
                        cvv: cvv,
                        card_number: card_number,
                        card_type: card_type,
                        plan_id: "",
                        amount: $('cost-input').val(),
                        plan: "",
                        qty: '1',
                        plan_unique_id: ""
                    },
                    beforeSend: function(){
                        $("#cardSubmitBtn").prop('disabled', true);
                        $("#cardSubmitBtn").html('Processing....');
                    },
                    success:function(data){
                        // console.log(data);
                        data = JSON.parse(data)

                        if (data.status == 'success') {

                            $('#loading').removeClass('d-none')
                            setTimeout(function(){ 
                                 activateStatus();
                               
                             }, 15000);
                             
                             
                        }
                        // console.log(data['ResponseMetadata']);
                       

                        $("#cardSubmitBtn").prop('disabled', false);
                        $("#cardSubmitBtn").html(oldHtml);
                    },
                    error:function(xhr,status,error){
                        alert(error)
                        $("#cardSubmitBtn").prop('disabled', false);
                        $("#cardSubmitBtn").html(oldHtml);
                    }
                });
            }
        });

        // calcultae cost once unit is inputed
        $('#unit-input').on('input', function(){

            calculateCost();
        })

        $('#cost-input').on('input', function(){

            calculateUnit();
        })
       function calculateCost(){
        var unitCost = parseFloat({{ siteSetting()->cost_per_unit }});
        let unit = parseFloat($('#unit-input').val());
        $('#cost-input').val(unit*unitCost);
        $('#cost').text(unit*unitCost);
       }


        function calculateUnit(){
            var unitCost = parseFloat({{ siteSetting()->cost_per_unit }});
            let cost = parseFloat($('#cost-input').val());
            $('#unit-input').val(cost/unitCost);
            $('#cost').text(cost);
       }

        function activateStatus(){
            $.ajax({
                url: "",
                type: "POST",
                data: {
                },
                success:function(data){
                    
                    if (data == '1') {
                        window.location.replace("");
                    }else{
                        console.log('nothing');
                    }
                    
                }
            })
        }


    });
</script>

@endsection