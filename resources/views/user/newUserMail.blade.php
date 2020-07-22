@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

  <div class="container-fluid">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">Crear Usuario</h4>
      </div>

      <div class="card-body">
        
        <form action="/user/createUserNew" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-lg-12">
                    <h3>Datos de Usuario</h3>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-4">
                    <input type="hidden" value="{{ $email }}" name="email" />
                    <input disabled class="form-control disabled" value="{{ $email }}" />
                </div>
                <div class="col-lg-4">
                    <input type="hidden" value="{{ $dni }}" name="dni" />
                    <input disabled class="form-control disabled" value="{{ $dni }}" />
                </div>
                <div class="col-lg-4">
                    <input type="hidden" value="{{ $rol->id }}" name="rol_id" />
                    <input disabled class="form-control disabled" value="{{ $rol->name }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-4">
                    <input type="text" class="form-control" placeholder="Nombre" name="name" />
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control" placeholder="Apellidos" name="lastname" />
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control" placeholder="Dirección" name="address" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-4">
                    <input type="text" class="form-control" placeholder="País" name="country" />
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control" placeholder="Ciudad" name="city" />
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control" placeholder="Código Postal" name="zipcode" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-3">
                    <input type="text" class="form-control" placeholder="Teléfono" name="phone" />
                </div>
                <div class="col-lg-3">
                    <input type="date" class="form-control" placeholder="Fecha Nacimiento" name="birthdate" />
                </div>
                <div class="col-lg-3">
                    <select name="sex" class="form-control">
                        <option value="female">Femenino</option>
                        <option value="male">Masculino</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select name="blood" class="form-control">
                        <option value="0-">0-</option>
                        <option value="0+">0+</option>
                        <option value="A-">A-</option>
                        <option value="A+">A+</option>
                        <option value="B-">B-</option>
                        <option value="B+">B+</option>
                        <option value="AB-">AB-</option>
                        <option value="AB+">AB+</option>
                    </select>                    
                </div>
            </div>

            @if($rol->id == 1)
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <hr>
                        <h3>Datos del Paciente</h3>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder="Histórico" name="historic" />
                    </div>
                    <div class="col-lg-4">
                        <input type="number" class="form-control" placeholder="Altura" name="height" />
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder="Peso" name="weight" />
                    </div>
                </div>
            @endif

            @if($rol->id == 2)
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <hr>
                        <h3>Datos del Doctor</h3>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder="Rama" name="branch" />
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder="Shift" name="shift" />
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder="Oficina" name="office" />
                    </div>
                </div>
                <div class="row mb-3">                    
                    <div class="col-lg-6">
                        <input type="text" class="form-control" placeholder="Puerta" name="room" />
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" placeholder="Teléfono" name="h_phone" />
                    </div>
                </div>
            @endif
            
            <div class="row mb-3">
                <div class="col-lg-12">
                    <hr>
                    <h3>Datos de Acceso</h3>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <input type="password" class="form-control" placeholder="Contraseña" name="password" />
                </div>
                <div class="col-lg-6">
                    <input type="password" class="form-control" placeholder="Repetir contraseña" name="repeat_password" />
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-lg-2 offset-5 text-center">
                    <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Crear</button>
                </div>
            </div>

        </form>

      </div>
    </div>

  </div>

@endsection