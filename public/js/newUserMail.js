$(document).ready(function() { 


//   window.onerror = function(msg, url, linenumber) {
//     console.error('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
//     return true;
// }
        setTimeout(function () {
          // $('#smsPhone').attr('placeholder', $('#smsPhone').attr('placeholder') + "7");
  
          const smsPhone = document.getElementById('smsPhone');
          const password = document.getElementById('password');
          const repeat_password = document.getElementById('repeat_password');

          const newUserMailForm = document.getElementById('newUserMailForm');
  
        //   let errorLongMap = [ "Invalid number", "The phone number has an invalid country code", "The phone number is too short", "The phone number is too long", "Invalid number"];
        let errorLongMap = [ _messagesLocalization.invalid_number, _messagesLocalization.the_phone_number_has_an_invalid_country_code, _messagesLocalization.the_phone_number_is_too_short, _messagesLocalization.the_phone_number_is_too_long, _messagesLocalization.invalid_number];
  
  
          newUserMailForm.addEventListener('submit', (e) => {
            let messages = [];
  
            if (smsPhone.value === '' || smsPhone.value == null) {
              messages.push(_messagesLocalization.the_phone_number_is_required);
            }
  
            if (input.value.trim()){
                if (!intl.isValidNumber()){
                    let errorCode = intl.getValidationError();
                    let code = errorLongMap[errorCode];
                    if (!code){
                        code = _messagesLocalization.invalid_number;
                    }
                    messages.push(code);
                }
            }

            if (password.value !== repeat_password.value){
              messages.push(_messagesLocalization.passwords_do_not_match);
            }

            if (password.value.length < 6 || repeat_password.value.length < 6){
              messages.push(_messagesLocalization.password_needs_to_have_at_least_6_characters);
            }
  
            if (messages.length > 0) {
              e.preventDefault();
              showInlineError(1, messages.join(', '), 10);             
            }
  
            let title = $('.iti__selected-flag').attr('title');
            let phoneCode = title.replace(/[^\d\+]/g, '');
            // let countryCodeShort = $(".iti__selected-flag").data("countrycodename");
            let countryCodeLong = title.substr(0, title.indexOf(':')); 
            $("<input />").attr("type", "hidden")
            .attr("name", "hiddenPhoneCode")
            .attr("value", phoneCode)
            .appendTo("#newUserMailForm");
            $("<input />").attr("type", "hidden")
            .attr("name", "hiddenCountryCodeLong")
            .attr("value", countryCodeLong)
            .appendTo("#newUserMailForm");
          })
  
      }, 100);    

});


let input = document.querySelector("#smsPhone");
let errorMsg = document.querySelector("#error-msg");
let validMsg = document.querySelector("#valid-msg");

// let errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

let errorMap = [ _messagesLocalization.no_valid_number, _messagesLocalization.invalid_country_code, _messagesLocalization.too_short, _messagesLocalization.too_long, _messagesLocalization.no_valid_number];


let intl = window.intlTelInput(input, {
    // initialCountry: "auto",
    initialCountry: "es",
    geoIpLookup: function(successful, failure){
        $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp){
            let countryCode = (resp && resp.country) ? resp.country : "";
            console.log("codigo", countryCode);
            successful(countryCode);
        });
    },
    utilsScript: _publicUrl + "vendor/intl-tel-input-master/js/utils.js"
});

let reset = function(){
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
};

let messageValidate = function (event) {
    reset();
    if (input.value.trim()){
        if (intl.isValidNumber()){
            validMsg.classList.remove("hide");
            // $('#valid-msg').html("&#10004; Valid number");
            $('#valid-msg').html("&#10004; "+_messagesLocalization.valid_number);
        }
    else{
        $('#valid-msg').text("");
        input.classList.add("error");
        let errorCode = intl.getValidationError();
        let code = errorMap[errorCode];
        if (!code){
            // code = "Not valid";
            code = _messagesLocalization.no_valid_number;
        }
        errorMsg.innerHTML = code;
        errorMsg.classList.remove("hide");
    }
}};

// Validate on blur keyup and change event
input.addEventListener('blur', messageValidate, false);
input.addEventListener('keyup', messageValidate, false);
input.addEventListener('change', messageValidate, false);

$('#smsPhone').on('change', function(e) {
    $(e.target).val($(e.target).val().replace(/[^\d\-]/g, ''))
});
$('#smsPhone').on('keypress', function(e) {
    keys = ['0','1','2','3','4','5','6','7','8','9','-']
    return keys.indexOf(event.key) > -1
});




