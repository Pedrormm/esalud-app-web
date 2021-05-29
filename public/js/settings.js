$(function() {

  $("#snapshot-container" ).hide();

});

function convertCanvasToImage() {
  let canvas = document.getElementById("canvas");
  let image = new Image();
  image.src = canvas.toDataURL();
  return image;
}
   

   $('#editSettings').on("click",function(e){
      e.preventDefault();
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
          showInlineMessage(response.message, 30);
      });
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
        $("#capturerText").text("Ocultar capturarador de imagen de la cámara");
      }
      else{
        $("#capturerText").text("Mostrar capturarador de imagen de la cámara");
      }
    });
  });

  $('#deleteImage').on("click",function(e){
    showModal('¿Borrar la imagen de perfil?', 
    '¿Seguro que desea borrar la imagen de perfil?',
    false, _publicUrl+'settings/avatar/confirmAvatarDelete' , 'modal-xl', true, true, false, null, null, "No", "Sí"); 

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
      showInlineError(1, "There is no image to upload", 5);
    }
});




