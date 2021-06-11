  
  <form id="confirmChecked">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label id="sureAppointment" data-ap-id="{{ $appointment->id }}"
                                    data-accept-or-reject-id="{{ $appointment->id }}">
                                    @lang('messages.are_you_sure_you_want_to') {{ $checkedText }} @lang('messages.the_appointment') {{ $appointment->id }}?
                                </label>   
                                @if ($checked == 2)
                                    <textarea id="apComments"></textarea>   
                                    <div id="commentsValidity" class="d-none">
                                        <span aria-hidden='true' class='fas fa-exclamation-triangle'></span> Comments are required
                                    </div>    
                                @endif
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
        let sureId = $('#sureAppointment').data("ap-id");
        let datum = sureId;
        
        // Modal rechazar:2
        @if ($checked == 2)
            let apComments = ($('#apComments').val());
                if (!apComments){
                    console.log(apComments);
                    $("#commentsValidity").removeClass("d-none");
                    return false;
                }
            datum = {
                sureId,
                apComments
            };
        @endif
        saveModalActionAjax(_publicUrl+"appointment/"+sureId+"/setChecked/"+{{ $checked }},datum , 'POST', 'json', function(res) {
            if(res.status == 0) {
                $('#mainTableAllAppointments').DataTable().ajax.reload();
                showInlineMessage(res.message, 10);
            }
            else {
                $('#mainTableAllAppointments').DataTable().ajax.reload();
                showInlineError(res.status, res.message, 10);
            }
            $('#saveModal').off("click");
        });
    });
  </script>
  


