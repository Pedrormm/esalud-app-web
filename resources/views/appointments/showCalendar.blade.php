<div class="row">
    <div class="col-lg-12">
        <label><b>Paciente:</b> {{ App\User::find($appointment->user_id_patient)->name }} {{ App\User::find($appointment->user_id_patient)->lastname }}</label>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>Doctor:</b> {{ App\User::find($appointment->user_id_doctor)->name }} {{ App\User::find($appointment->user_id_doctor)->lastname }}</label>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>Especialidad:</b> {{ $especialidad[0]->name }}</label> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>Fecha Cita:</b> {{ date("d/m/Y H:i",strtotime($appointment->dt_appointment)) }}</label> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>Aprobación Doctor:</b> {{ App\Models\Appointment::getChecked($appointment->checked) }}</label> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>Estado:</b> {{ App\Models\Appointment::getAccomplished($appointment->accomplished) }}</label> 
    </div>
</div>

@if(!is_null($appointment->comments))
    <div class="row">
        <div class="col-lg-12">
            <label><b>Comentario:</b> {{ $appointment->comments }}</label> 
        </div>
    </div>
@endif