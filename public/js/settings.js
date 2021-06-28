$(function() {

  $("#snapshot-container" ).hide();

});

function convertCanvasToImage() {
  let canvas = document.getElementById("canvas");
  let image = new Image();
  image.src = canvas.toDataURL();
  return image;
}

  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });

   $('#editSettings').on("click",function(e){
      e.preventDefault();


      setTimeout(function () {
  
        const smsPhone = document.getElementById('smsPhone');

        const settingsForm = document.getElementById('settingsForm');

        let errorLongMap = [ _messagesLocalization.invalid_number, _messagesLocalization.the_phone_number_has_an_invalid_country_code, _messagesLocalization.the_phone_number_is_too_short, _messagesLocalization.the_phone_number_is_too_long, _messagesLocalization.invalid_number];

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
        .appendTo("#settingsForm");
        $("<input />").attr("type", "hidden")
        .attr("name", "hiddenCountryCodeLong")
        .attr("value", countryCodeLong)
        .appendTo("#settingsForm");


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url:_publicUrl+'settings/update',
            type:"POST",
            data: $("#settingsForm").serialize(),
            dataType:"json",
            contenttype: "application/json; charset=utf-8",
        }).done(function(response){
            // console.log("respuesta ", response);
            
            if(response.status == 0) {
              showInlineMessage(response.message, 20);
            }
            else {
              showInlineError(response.status, response.message, 10);
            }

        });

  }, 100);    

  });


  'use strict';

const video = document.getElementById('videoSnap');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');
var w, h, ratio;

const constraints = {
  audio: false,
  video: {
    width: 1280, height: 720
  }
};

// Access webcam
async function init() {

  video.addEventListener('loadedmetadata', function() {
    ratio = video.videoWidth / video.videoHeight;
    w = video.videoWidth - 100;
    h = parseInt(w / ratio, 10);
    canvas.width = w;
    canvas.height = h;
  }, false);

  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }

  // Draw image
  var context = canvas.getContext('2d');
  snap.addEventListener("click", function() {
          // context.drawImage(video, 0, 0, 640, 480);
          context.fillRect(0, 0, w, h);
          context.drawImage(video, 0, 0, w, h);
          // console.log(w, h, ratio);
          const image = convertCanvasToImage(context);
          image.classList.add('rounded-circle','mx-auto','d-block','avatar-image');
          image.setAttribute("id", "previewImage");
          // console.log("src ",image.src);
          _base64Avatar = image.src;
          $("#uploadImage").removeAttr("disabled");

          let boxBody = $('.box-body');
          removePreview();
          boxBody.append(image);
  });
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

  $( "#takeScreenshot" ).one( "click", function() {
    $("#snapshot-container").removeClass( "d-none" );
    init();
  });

  $('#takeScreenshot').on("click",function(e){
    $( "#snapshot-container" ).toggle( "slow", function() {
      if($("#snapshot-container").is(":visible")){
        $("#capturerText").text(_messagesLocalization.hide_image_grabber_from_camera);
      }
      else{
        $("#capturerText").text(_messagesLocalization.show_image_grabber_from_camera);
      }
    });
  });

  $('#deleteImage').on("click",function(e){
    showModal(_messagesLocalization.would_you_like_to_delete_the_profile_picture, 
      _messagesLocalization.are_you_sure_you_want_to_delete_the_profile_picture,
      false, _publicUrl+'settings/avatar/confirmAvatarDelete' , 'modal-xl', true, true, false, null, null,
      _messagesLocalization.no_response, _messagesLocalization.yes_response); 

  });

  $('#uploadImage').on("click",function(e){
    e.preventDefault();
    if (_base64Avatar){

      // let form = document.querySelector("#form-new-avatar");
      // let formData = new FormData(form);
      // let entires = formData.entries();  
      // for (var input of entires) {
      //   console.log(input[0]);
      //   console.log(input[1]);
      // }
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url:_publicUrl+'settings/avatar/update',
        method:"POST",
        data: {
          data:_base64Avatar
        },
        dataType:"json",
        contenttype: "application/json; charset=utf-8",
        // processData: false,
        // contentType: false
      }).done(function(response){
          // console.log("resp ", response);
          if (response.status == 1){
            showInlineError(response.status, response.message, 15);
          }
          else if (response.status == 0){
            showInlineMessage(response.message, 30);
            if(response.obj){
              $("#profilePicture").attr("src",_publicUrl+'images/avatars/'+response.obj);
          }
          }
      })
      .fail(function(xhr, st, err) {
        console.error("error in settings/avatar/update " + xhr, st, err);
      }); 
    }
    else{
      showInlineError(1, _messagesLocalization.there_is_no_image_to_upload, 5);
    }
});







let input = document.querySelector("#smsPhone");
let errorMsg = document.querySelector("#error-msg");
let validMsg = document.querySelector("#valid-msg");


let errorMap = [ _messagesLocalization.no_valid_number, _messagesLocalization.invalid_country_code, _messagesLocalization.too_short, _messagesLocalization.too_long, _messagesLocalization.no_valid_number];


let intl = window.intlTelInput(input, {
    initialCountry: shortNameCountryCode,
    geoIpLookup: function(successful, failure){
        $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp){
            let countryCode = (resp && resp.country) ? resp.country : "";
            // console.log("codigo", countryCode);
            successful(countryCode);
        });
    },
    utilsScript: _publicUrl + "vendor/intl-tel-input-master/js/utils.js"
});

let phoneReset = function(){
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
};

let messageValidate = function (event) {
  phoneReset();
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





