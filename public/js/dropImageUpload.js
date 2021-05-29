const inputAvatar = document.getElementById('imgAvatar');

/**
 * Removes the image preview
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @return {void} Nothing
 */
function removePreview(){
  $('.box-body').empty();
  $('.preview-zone').addClass('hidden');
  reset($('.dropzone'));
}

/**
 * Reads the file image given and appends it in the html so it can be shown as a image preview
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {Object} input - The given file.
 * @return {void} Nothing
 */
function readFile(input) {
    if (inputAvatar.files && inputAvatar.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function(e) {
        var htmlPreview =
          '<img class="rounded-circle mx-auto d-block avatar-image" id="previewImage" src="' + e.target.result + '" />' +
          '<p>' + inputAvatar.files[0].name + '</p>';
        var wrapperZone = $(inputAvatar).parent();
        var previewZone = $(inputAvatar).parent().parent().find('.preview-zone');
        var boxZone = $(inputAvatar).parent().parent().find('.preview-zone').find('.settings-box').find('.box-body');
        
        _base64Avatar = e.target.result;
        $("#uploadImage").removeAttr("disabled");
        wrapperZone.removeClass('dragover');
        previewZone.removeClass('hidden');
        boxZone.empty();
        boxZone.append(htmlPreview);
      };

      
  
      reader.readAsDataURL(inputAvatar.files[0]);
    }
  }
  
/**
 * Resets the given element so the preview image won't propagate or duplicate
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {Object} message - The given element.
 * @return {void} Nothing
 */
function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}
  
$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  removePreview();
});
  