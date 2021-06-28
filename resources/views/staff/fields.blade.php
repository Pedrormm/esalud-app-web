<!-- Historic Field -->
<div class="form-group col-sm-6">
    {!! Form::label('historic', 'Historic:') !!}
    {!! Form::text('historic', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- medicalSpeciality Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medicalSpeciality', 'medicalSpeciality:') !!}
    {!! Form::number('medicalSpeciality', null, ['class' => 'form-control']) !!}
</div>

<!-- Shift Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shift', 'Shift:') !!}
    {!! Form::text('shift', null, ['class' => 'form-control']) !!}
</div>

<!-- Office Field -->
<div class="form-group col-sm-6">
    {!! Form::label('office', 'Office:') !!}
    {!! Form::text('office', null, ['class' => 'form-control']) !!}
</div>

<!-- Room Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room', 'Room:') !!}
    {!! Form::text('room', null, ['class' => 'form-control']) !!}
</div>

<!-- H Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('h_phone', 'H Phone:') !!}
    {!! Form::text('h_phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('staff.index') }}" class="btn btn-default">Cancel</a>
</div>
