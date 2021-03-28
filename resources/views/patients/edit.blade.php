@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

  <div class="container-fluid">

    <div class="card shadow mb-4" id="mainCardShadow">
      <div class="card-header py-3">
        {{-- <h4 class="m-0 font-weight-bold text-primary text-center">Editar Usuario</h4> --}}
        <div class="row">
            <div class="cHeader col-2">
              <button type="button" class="btn btn-primary">
                  <i class="fas fa-arrow-left"></i>
              </button>
            </div>
            <h4 class="m-0 font-weight-bold text-primary col-7 ml-auto">Editar usuario</h4>
  
          </div>

      </div>

      <div class="card-body" id="mainCardBody">
        
        @if(isset($showError))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <ul class="errorShown">
                                <li>{{ $error }}</li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        @else

            <div id="error-container" class="alert alert-danger dNone"></div>
            <div id="message-container" class="alert alert-success dNone"></div>

            {{ Form::open(array('url' => '/patients/'.$usuario->id, 'method' => 'PUT', 'id'=>'newUserMailForm')) }}
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3>Datos de Usuario</h3>
                    </div>
                </div>
               
                <div class="row mb-3">
                    <input type="hidden" value="{{ $usuario->id }}" name="user_id" />
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->email }}" name="email" placeholder="Email" />
                        
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->dni }}" name="dni" />
                        
                    </div>
                    <div class="col-lg-4">
                        {{-- <input type="text" class="form-control" value="{{ App\Models\Role::find($usuario->role_id)->id }}" name="role_id" /> --}}
                            <select name="role_id" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                                data-live-search="true" title="Rol">
                                @foreach ($roles as $rol)
                                    <option value={{ $rol->id }} {{ $usuario->role_id == $rol->id ? 'selected' : "" }}>{{ $rol->name }}</option>
                                @endforeach
                            </select> 
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->name }}" placeholder="Nombre" name="name" required/>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->lastname }}" placeholder="Apellidos" name="lastname" required/>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->address }}" placeholder="Dirección" name="address" required/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->country }}" placeholder="País" name="country" />
                    </div>
                    <div clas s="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->city }}" placeholder="Ciudad" name="city" />
                    </div>
                    <div class="col-lg-4">
                        <input type="number" class="form-control" value="{{ $usuario->zipcode }}" placeholder="Código Postal" name="zipcode" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3">
                        {{-- <input type="text" class="form-control" placeholder="Teléfono" name="phone" /> --}}
                        <input type='tel' value="{{ $usuario->phone }}" class="form-control" name="phone" id="smsPhone" maxlength="12" />
                        <span id="valid-msg" class="hide"></span>
                        <span id="error-msg" class="hide"></span>
                    </div>
                    <div class="col-lg-3">
                        <input type="date" value="{{ date("Y-m-d", strtotime($usuario->birthdate)) }}" name="birthdate" class="form-control" data-placeholder="Fecha de Nacimiento" required aria-required="true" id="bDate" />
                    </div>
                    <div class="col-lg-3">
                        {{-- <select name="sex" class="form-control" required> --}}                      
                        <select name="sex" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                        data-live-search="true" title="Sexo">
                            @if($usuario->sex == "female")
                            <option selected value="female">Femenino</option>
                            <option value="male">Masculino</option>
                            @else
                            <option value="female">Femenino</option>
                            <option selected value="male">Masculino</option>
                            @endif
                           
                        </select>
                    </div>
                    <div class="col-lg-3">
                        {{-- <select name="blood" class="form-control" required> --}}
                        <select name="blood" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                            data-live-search="true" title="Grupo sanguíneo">
                            <option value="0-" {{ $usuario->blood == "0-" ? 'selected' : "" }}>0-</option>
                            <option value="0+" {{ $usuario->blood == "0+" ? 'selected' : "" }}>0+</option>
                            <option value="A-" {{ $usuario->blood == "A-" ? 'selected' : "" }}>A-</option>
                            <option value="A+" {{ $usuario->blood == "A+" ? 'selected' : "" }}>A+</option>
                            <option value="B-" {{ $usuario->blood == "B-" ? 'selected' : "" }}>B-</option>
                            <option value="B+" {{ $usuario->blood == "B+" ? 'selected' : "" }}>B+</option>
                            <option value="AB-" {{ $usuario->blood == "AB-" ? 'selected' : "" }}>AB-</option>
                            <option value="AB+" {{ $usuario->blood == "AB+" ? 'selected' : "" }}>AB+</option>
                        </select>                    
                    </div>
                </div>

                @if($usuario->role_id == 1)
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <hr>
                            <h3>Datos del Paciente</h3>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <input value="{{ $rol_usuario_info->historic }}" type="text" class="form-control" placeholder="Histórico" name="historic" />
                        </div>
                        <div class="col-lg-4">
                            <input value="{{ $rol_usuario_info->height }}" type="number" class="form-control" placeholder="Altura en cm" name="height" />
                        </div>
                        <div class="col-lg-4">
                            <input value="{{ $rol_usuario_info->weight }}" type="text" class="form-control" placeholder="Peso en kg" name="weight" />
                        </div>
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-lg-2 offset-5 text-center">
                        <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Editar</button>
                    </div>
                </div>

            
            {{ Form::close() }}
            {{-- </form> --}}
            

        @endif
        </div>
    </div>

  </div>

  {{-- <script type="text/javascript" src="{{ asset('js/newUserMail.js')}}"></script> --}}

  @endsection

    @section('scriptsPropios')
        <script>
            $('.cHeader button').on('click', function(e){
                e.preventDefault();
                window.location.href = PublicURL+"patients/";
            });
        </script>
    @endsection



