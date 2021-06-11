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
            <h4 class="font-weight-bold text-primary centered">@lang('messages.edit_user')</h4>
  
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

            {{-- <form action="/user/editUser" method="POST" id="newUserMailForm"> --}}
            {{ Form::open(array('url' => '/staff/'.$usuario->id, 'method' => 'PUT', 'id'=>'newUserMailForm')) }}
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3>@lang('messages.user_datas')</h3>
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
                                data-live-search="true" title=@lang('messages.role_stat')>
                                @foreach ($roles as $rol)
                                    <option value={{ $rol->id }} {{ $usuario->role_id == $rol->id ? 'selected' : "" }}>{{ $rol->name }}</option>
                                @endforeach
                            </select> 
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->name }}" placeholder=@lang('messages.name_data') name="name" required/>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->lastname }}" placeholder=@lang('messages.surname_data') name="lastname" required/>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->address }}" placeholder=@lang('messages.address_data') name="address" required/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->country }}" placeholder=@lang('messages.country_data') name="country" />
                    </div>
                    <div clas s="col-lg-4">
                        <input type="text" class="form-control" value="{{ $usuario->city }}" placeholder=@lang('messages.city_data') name="city" />
                    </div>
                    <div class="col-lg-4">
                        <input type="number" class="form-control" value="{{ $usuario->zipcode }}" placeholder=@lang('messages.zip_code') name="zipcode" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3">
                        {{-- <input type="text" class="form-control" placeholder=@lang('messages.phone_number') name="phone" /> --}}
                        <input type='tel' value="{{ $usuario->phone }}" class="form-control" name="phone" id="smsPhone" maxlength="12" />
                        <span id="valid-msg" class="hide"></span>
                        <span id="error-msg" class="hide"></span>
                    </div>
                    <div class="col-lg-3">
                        <input type="date" value="{{ date("Y-m-d", strtotime($usuario->birthdate)) }}" name="birthdate" class="form-control" data-placeholder=@lang('messages.date_of_birth') required aria-required="true" id="bDate" />
                    </div>
                    <div class="col-lg-3">
                        {{-- <select name="sex" class="form-control" required> --}}                      
                        <select name="sex" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                        data-live-search="true" title=@lang('messages.gender_data')>
                            @if($usuario->sex == "female")
                            <option selected value="female">@lang('messages.female_data')</option>
                            <option value="male">@lang('messages.male_data')</option>
                            @else
                            <option value="female">@lang('messages.female_data')</option>
                            <option selected value="male">@lang('messages.male_data')</option>
                            @endif
                           
                        </select>
                    </div>
                    <div class="col-lg-3">
                        {{-- <select name="blood" class="form-control" required> --}}
                        <select name="blood" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                            data-live-search="true" title=@lang('messages.blood_group')>
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

                @if($usuario->role_id == \HV_ROLES::DOCTOR)
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <hr>
                            <h3>@lang('messages.doctor_data')</h3>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <input type="text" value="{{ $rol_usuario_info->historic }}" class="form-control" placeholder=@lang('messages.historical_stat') name="historic" />
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control" name="branch_id">
                                <option>@lang('messages.select_specialty')</option>
                                @foreach( $branches as $branch)
                                    <option {{ $rol_usuario_info->branch_id == $branch->id ? 'selected' : "" }} value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row mb-3"> 
                        <div class="col-lg-4">
                            <input type="text" value="{{ $rol_usuario_info->office }}" class="form-control" placeholder=@lang('messages.office_data') name="office" />
                        </div>                   
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ $rol_usuario_info->room }}" placeholder=@lang('messages.door_data') name="room" />
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ $rol_usuario_info->h_phone }}" placeholder=@lang('messages.phone_number') name="h_phone" />
                        </div>
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-lg-2 offset-5 text-center">
                        <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> @lang('messages.edit_stat')</button>
                    </div>
                </div>

            
            {{ Form::close() }}
            {{-- </form> --}}
            

        @endif
        </div>
    </div>

  </div>


  @endsection

@section('viewsScripts')
    <script>
        $('.cHeader button').on('click', function(e){
            e.preventDefault();
            window.location.href = _publicUrl+"staff/";
        });
    </script>
@endsection