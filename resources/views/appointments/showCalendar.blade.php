<div class="row">
    <div class="col-lg-12">
        <label><b>@lang('messages.patient_type'):</b> {{ App\User::find($appointment->user_id_patient)->name }} {{ App\User::find($appointment->user_id_patient)->lastname }}</label>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>@lang('messages.doctor_type'):</b> {{ App\User::find($appointment->user_id_doctor)->name }} {{ App\User::find($appointment->user_id_doctor)->lastname }}</label>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>@lang('messages.specialty_stat'):</b> {{ $especialidad[0]->name }}</label> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>@lang('messages.appointment_date'):</b> {{ date("d/m/Y H:i",strtotime($appointment->dt_appointment)) }}</label> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>@lang('messages.doctor_approval'):</b> {{ App\Models\Appointment::getChecked($appointment->checked) }}</label> 
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label><b>@lang('messages.state_stat'):</b> {{ App\Models\Appointment::getAccomplished($appointment->accomplished) }}</label> 
    </div>
</div>

@if(!is_null($appointment->comments))
    <div class="row">
        <div class="col-lg-12">
            <label><b>@lang('messages.comment_stat'):</b> {{ $appointment->comments }}</label> 
        </div>
    </div>
@endif