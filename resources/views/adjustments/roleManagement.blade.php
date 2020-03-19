@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

<select class="selectpicker" multiple data-max-options="2">
@foreach ($roles as $rol)
  <option>{{ $rol-> }}</option>
@endforeach
</select>

    
@endsection