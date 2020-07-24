@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')


<div class="container-fluid">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">Enviar SMS</h4>
      </div>

      <div class="card-body">
        <div id="smsFormError">

        </div>
        <form method='POST' id="smsForm">
            @if($errors->any())
            <ul>
            @foreach($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
            @endforeach
            <ul>
            @endif
        @if(session('success'))
            <strong>{{ session('success') }}</strong>
        @endif
            <label for="to">Enter Telephone Number:</label>
            <input type='tel' name='to' id='smsPhone' maxlength="12" required/>
            <span id="valid-msg" class="hide"></span>
            <span id="error-msg" class="hide"></span>
            <br/><br/>
            <label>Message/Body:</label>
            <textarea name='messages' id='messagesSms' required></textarea>
            <br/><br/>
            <div class="row mb-3">
                <div class="col-lg-2 offset-5 text-center">
                    <button type='submit' class="btn btn-primary btn-block"><i class="fa fa-sms"></i> Send</button>
                </div>              
            </div>
            @csrf
        </form>
      
      {{-- @if(isset($info))
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-info">
              {{ $info }}
            </div>
          </div>
        </div>
      @endif
      
      @if(isset($danger))
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-danger">
              {{ $danger }}
            </div>
          </div>
        </div>
      @endif --}}

      </div>
    </div>

  </div>

<script>
    let input = document.querySelector("#smsPhone");

    let errorMsg = document.querySelector("#error-msg");
    let validMsg = document.querySelector("#valid-msg");

    let errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    let intl = window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: function(sucess, failure){
            $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp){
                let countryCode = (resp && resp.country) ? resp.country : "";
                console.log("codigo", countryCode);
                sucess(countryCode);
            });
        },
        utilsScript: PublicURL + "vendor/intl-tel-input-master/js/utils.js"
    });

    let reset = function(){
        input.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.classList.add("hide");
    };
    
    // Validate on blur event
    input.addEventListener('blur', function() {
        reset();
        if (input.value.trim()){
            if (intl.isValidNumber()){
                validMsg.classList.remove("hide");
                $('#valid-msg').html("&#10004; Valid number");
            }
            else{
                $('#valid-msg').text("");
                input.classList.add("error");
                var errorCode = intl.getValidationError();
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.classList.remove("hide");
            }
        }
    });

    // Reset on keyUp change event
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);

    $('#smsPhone').on('change', function(e) {
        $(e.target).val($(e.target).val().replace(/[^\d\-]/g, ''))
    });
    $('#smsPhone').on('keypress', function(e) {
        keys = ['0','1','2','3','4','5','6','7','8','9','-']
        return keys.indexOf(event.key) > -1
    });

    $(document).ready(function() { 
        setTimeout(function () {
            // $('#smsPhone').attr('placeholder', $('#smsPhone').attr('placeholder') + "7");

            const smsPhone = document.getElementById('smsPhone');
            const validMsg = document.getElementById('valid-msg');
            const errorMsg = document.getElementById('error-msg');
            const messagesSms = document.getElementById('messagesSms');
            const smsForm = document.getElementById('smsForm');

            let errorLongMap = [ "Invalid number", "The phone number has an invalid country code", "The phone number is too short", "The phone number is too long", "Invalid number"];


            smsForm.addEventListener('submit', (e) => {

              let messages = [];

              if (smsPhone.value === '' || smsPhone.value == null) {
                messages.push('Phone number is required');
              }

              if (messagesSms.value === '' || messagesSms.value == null) {
                messages.push('Body is required');
              }

              if (input.value.trim()){
                  if (!intl.isValidNumber()){
                      let errorCode = intl.getValidationError();
                      messages.push(errorLongMap[errorCode]);
                  }
              }

              if (messages.length > 0) {
                e.preventDefault();
                showInlineError(1, messages.join(', '), 10);
              }

            })

        }, 100);    
    });


</script>







@endsection

