<form id="saveEditAppointment" action="{{ route('appointment.update',$appointment->id) }}" method="POST">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    @php
    if(auth()->user()->role_id == \HV_ROLES::PERM_DOCTOR) {
        $gridCols = 6;
    }
    else
        $gridCols = 4;
    @endphp
        <div class="row">
            <div class="col-lg-{{ $gridCols }}">
                <label>Listado de pacientes (*)</label>
                <input name="user_id_patient" type="text" class="form-control" value="{{ $patient->name }} {{ $patient->lastname }}" />
            </div>
            
            @if(auth()->user()->role_id == \HV_ROLES::PERM_ADMIN)
                <div class="col-lg-{{ $gridCols }}">                      
                    <label>Listado de doctores (*)</label>
                    <select required class="form-control" name="user_id_doctor">
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->lastname }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="col-lg-{{ $gridCols }}">
                <label>Fecha de la Cita (*)</label>
                <input id="dateTimeAppointment" min="{{ $fechaHora }}" value="{{ $fechaHoraAppointment }}" required type="datetime-local" class="form-control" name="dt_appointment" />
                {{-- Min max atributo --}}
            </div>

        </div>

        <div class="row">
            @if(auth()->user()->role_id == \HV_ROLES::PERM_DOCTOR)
                <div class="col-lg-6">                      
                    <label>Cumplido (*)</label>
                    <select required class="form-control" name="accomplished">
                        <option @php if($appointment->accomplished == 0) echo "selected" @endphp value="0">No Cumplido</option>
                        <option @php if($appointment->accomplished == 1) echo "selected" @endphp value="1">Cumplido</option>
                        <option @php if($appointment->accomplished == 2) echo "selected" @endphp value="2">En Espera</option>
                    </select>
                </div>

                <div class="col-lg-6">                      
                    <label for="txtComments">Comentarios del doctor</label>
                    <textarea id="txtComments" class="form-control" name="comments" aria-describedby="commentHelpBlock"></textarea>
                    <small id="commentHelpBlock" class="form-text text-muted">Aquí puedes poner alguna indicación especial para el paciente</small>
                </div>
            @endif
        </div>


        {{-- <div class="row mt-3">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">Editar</button>
            </div>
        </div> --}}
  </form>
  <script>
      $('#saveEditAppointment').submit(function(e) {
         console.log("submit edit app");
      if(false) {
        //mostrar en rojo los fallos
        //_avoidAllSendings = true;

      }
      else {
          console.log("Wrong something");
            e.preventDefault();
          _avoidAllSendings = false;
      }
    });
  </script>