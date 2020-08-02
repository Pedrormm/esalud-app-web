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
                  let code = errorLongMap[errorCode];
                  if (!code){
                      code = "The phone number is not valid";
                  }
                  messages.push(code);
              }
          }

          if (messages.length > 0) {
            e.preventDefault();
            showInlineError(1, messages.join(', '), 10);
          }

          let title = $('.iti__selected-flag').attr('title');
          let phoneCode = title.replace(/[^\d\+]/g, '')
        //   phoneCode = phoneCode.replace("+", "00");
        //   console.log(phoneCode);
          $("#smsPhone").val(function() {
            return phoneCode + this.value;
          });
        })

    }, 100);    
});

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
                let errorCode = intl.getValidationError();
                let code = errorMap[errorCode];
                if (!code){
                    code = "Not valid";
                }
                errorMsg.innerHTML = code;
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



