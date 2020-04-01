@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')
<div class="table-responsive">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Nombre de rol</th>
        <th>Permisos</th><!-- boton ver -->
        <th>Usuario creador</th><!-- El nick o nombre y apellidos solamente -->
        <th>Usuarios aplicados</th><!-- numero de usuarios que se le aplica este rol -->
        <th>Editar</th><!-- boton actualizar (solo disponible si somos nosotros mismos) -->
      </tr>
    </thead>



<select class="selectpicker" multiple data-max-options="2">
@foreach ($roles as $rol)
  <option>{{ $rol-> }}</option>
@endforeach
</select>

    
@endsection