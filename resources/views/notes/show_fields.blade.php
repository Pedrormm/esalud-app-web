<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $note->user_id }}</p>
</div>

<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', 'Text:') !!}
    <p>{{ $note->text }}</p>
</div>

<!-- Event Field -->
<div class="form-group">
    {!! Form::label('event', 'Event:') !!}
    <p>{{ $note->event }}</p>
</div>

<!-- Visible Field -->
<div class="form-group">
    {!! Form::label('visible', 'Visible:') !!}
    <p>{{ $note->visible }}</p>
</div>

