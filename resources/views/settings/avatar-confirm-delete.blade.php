  
  <form id="deleteRole">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label id="sureDeleteAvatar" for="sureDeleteAvatar" >
                                    @lang('messages.are_you_certain_you_wish_to_delete_your_profile_image')
                                </label>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>

<script>
    $('#saveModal').click(function() {
        saveModalActionAjax(_publicUrl+"settings/avatar/destroy", "", 'DELETE', 'json', function(res) {
            if (res.status == 1){
                showInlineError(res.status, res.message, 15);
            }
            else if (res.status == 0){
                showInlineMessage(res.message, 30);
                _base64Avatar = "";
                // console.log(res.obj);
                if(res.obj){
                    if (res.obj == "male"){
                        $("#previewImage").attr("src",_publicUrl+'images/avatars/user_man.png');
                        $("#profilePicture").attr("src",_publicUrl+'images/avatars/user_man.png');
                    }
                    else if (res.obj == "female"){
                        $("#previewImage").attr("src",_publicUrl+'images/avatars/user_woman.png');
                        $("#profilePicture").attr("src",_publicUrl+'images/avatars/user_woman.png');
                    }
                }
            }
            $('#saveModal').off("click");
            $("#uploadImage").attr("disabled")
        });
    });
</script>


  


