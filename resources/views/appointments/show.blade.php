<form id="saveEditAppointment" action="{{ route('appointment.update',$appointment->id) }}" method="POST">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    @php
    if(auth()->user()->role_id == \HV_ROLES::DOCTOR) {
        $gridCols = 6;
    }
    else
        $gridCols = 4;
    @endphp
        <div class="row">
            <div class="col-lg-{{ $gridCols }}">
                <label>@lang('messages.patients list') (*)</label>
                <input name="user_id_patient" type="text" class="form-control" value="{{ $patient->name }} {{ $patient->lastname }}" />
            </div>
            
            @if(auth()->user()->role_id == \HV_ROLES::ADMIN)
                <div class="col-lg-{{ $gridCols }}">                      
                    <label>@lang('messages.doctors list') (*)</label>
                    <select required class="form-control" name="user_id_doctor">
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->lastname }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="col-lg-{{ $gridCols }}">
                <label>@lang('messages.appointment date') (*)</label>
                <input id="dateTimeAppointment" min="{{ $fechaHora }}" value="{{ $fechaHoraAppointment }}" required type="datetime-local" class="form-control" name="dt_appointment" />
                {{-- Min max atributo --}}
            </div>

        </div>

        <div class="row">
            @if(auth()->user()->role_id == \HV_ROLES::DOCTOR)
                <div class="col-lg-6">                      
                    <label>@lang('messages.accomplished') (*)</label>
                    <select required class="form-control" name="accomplished">
                        <option @php if($appointment->accomplished == 0) echo "selected" @endphp value="0">@lang('messages.not accomplished')</option>
                        <option @php if($appointment->accomplished == 1) echo "selected" @endphp value="1">@lang('messages.accomplished')</option>
                        <option @php if($appointment->accomplished == 2) echo "selected" @endphp value="2">@lang('messages.on hold')</option>
                    </select>
                </div>

                <div class="col-lg-6">                      
                    <label for="txtComments">@lang('messages.doctor comments')</label>
                    <textarea id="txtComments" class="form-control" name="comments" aria-describedby="commentHelpBlock"></textarea>
                    <small id="commentHelpBlock" class="form-text text-muted">@lang('messages.special patient order')</small>
                </div>
            @endif
        </div>


        {{-- <div class="row mt-3">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">Editar</button>
            </div>
        </div> --}}
  </form>

@section('viewsScripts')
    <script>
        $('#saveEditAppointment').submit(function(e) {
        console.log("submit edit app");
        if(false) {
        //_avoidAllSendings = true;

        }
        else {
            console.log("Wrong something");
            e.preventDefault();
            _avoidAllSendings = false;
        }
    });
    </script>
@endsection