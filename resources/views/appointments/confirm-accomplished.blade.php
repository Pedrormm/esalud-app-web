  
  <form id="deleteRole">
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
                                    @lang('messages.are_you_sure_you_want_to') {{ $accomplishedText }} @lang('messages.the_appointment') {{ $appointment->id }}?
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
        let sureId = $('#sureAppointment').data("ap-id");
        saveModalActionAjax(_publicUrl+"appointment/"+sureId+"/setAccomplished/"+{{ $accomplished }}, sureId, 'POST', 'json', function(res) {
            if(res.status == 0) {
                $('#mainTableAllAppointments').DataTable().ajax.reload();
                showInlineMessage(res.message, 5);
            }
            else {
                showInlineError(res.status, res.message, 5);
            }
            $('#saveModal').off("click");
        });
    });
  </script>
  


