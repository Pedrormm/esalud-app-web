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

            {{ Form::open(array('url' => '/patients/'.$usuario->id, 'method' => 'PUT', 'id'=>'editPatientForm')) }}
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3>@lang('messages.user_datas')</h3>
                    </div>
                </div>
               
                <div class="row mb-3">
                    <input type="hidden" value="{{ $usuario->id }}" name="user_id" />
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="text" id="userEmail" class="form-control" value="{{ $usuario->email }}" 
                            name="email" placeholder="Email" required/>                     
                        </div>                        
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userDni">DNI</label>
                            <input type="text" id="userDni" class="form-control" value="{{ $usuario->dni }}" 
                            name="dni" placeholder="DNI" required/>
                        </div>                        
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userRole">@lang('messages.role_stat')</label>
                            <select name="role_id" id="userRole" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-live-search="true" title="@lang('messages.role_stat')">
                                @foreach ($roles as $rol)
                                    <option value={{ $rol->id }} {{ $usuario->role_id == $rol->id ? 'selected' : "" }}>{{ $rol->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userName">@lang('messages.name_data')</label>
                            <input type="text" id="userName" class="form-control" value="{{ $usuario->name }}" 
                            placeholder="@lang('messages.name_data')" name="name" required/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userLastname">@lang('messages.surname_data')</label>
                            <input type="text" id="userLastname" class="form-control" value="{{ $usuario->lastname }}" 
                            placeholder="@lang('messages.surname_data')" name="lastname" required/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userAddress">@lang('messages.address_data')</label>
                            <input type="text" id="userAddress" class="form-control" value="{{ $usuario->address }}" 
                            placeholder="@lang('messages.address_data')" name="address" required/>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userCountry">@lang('messages.country_data')</label>
                            {{-- <input type="text" id="userCountry" class="form-control" value="{{ $usuario->country }}" 
                            placeholder="@lang('messages.country_data')" name="country" required /> --}}

                            <select name="country_id" id="userCountry" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-live-search="true" title="@lang('messages.country_data')">
                                @foreach( $countries as $country)
                                    <option {{ $usuario->countries->id == $country->id ? 'selected' : "" }}
                                        value="{{ $country->id }}">{{ $country->long_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div clas s="col-lg-4">
                        <div class="form-group">
                            <label for="userCity">@lang('messages.city_data')</label>
                            <input type="text" id="userCity" class="form-control" value="{{ $usuario->city }}" 
                            placeholder="@lang('messages.city_data')" name="city" required />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userZipcode">@lang('messages.zip_code')</label>
                            <input type="number" id="userZipcode" class="form-control" value="{{ $usuario->zipcode }}" 
                            placeholder="@lang('messages.zip_code')" name="zipcode" required />
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="smsPhone">@lang('messages.phone_number')</label>
                            <input type='tel' value="{{ $usuario->phone }}" class="form-control" name="phone" id="smsPhone" maxlength="12" />
                            <span id="valid-msg" class="hide"></span>
                            <span id="error-msg" class="hide"></span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="bDate">@lang('messages.date_of_birth')</label>
                            <input type="date" value="{{ date("Y-m-d", strtotime($usuario->birthdate)) }}" 
                            name="birthdate" class="form-control" data-placeholder="@lang('messages.date_of_birth')" required 
                            aria-required="true" id="bDate" />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="userSex">@lang('messages.gender_data')</label>
                            <select id="userSex" name="sex" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-live-search="true" title="@lang('messages.gender_data')">
                                @if($usuario->sex == "female")
                                    <option selected value="female">@lang('messages.female_data')</option>
                                    <option value="male">@lang('messages.male_data')</option>
                                @else
                                    <option value="female">@lang('messages.female_data')</option>
                                    <option selected value="male">@lang('messages.male_data')</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="userBlood">@lang('messages.blood_group')</label>
                            <select name="blood" id="userBlood" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-live-search="true" title="@lang('messages.blood_group')">
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
                </div>

                @if($usuario->role_id == \HV_ROLES::PATIENT)
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <hr>
                            <h3>@lang('messages.patient_data')</h3>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userHistorialPatient">@lang('messages.historical_stat')</label>
                                <input id="userHistorialPatient" value="{{ $rol_usuario_info->historic }}" type="text" class="form-control" 
                                placeholder="@lang('messages.historical_stat')" name="historic" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userHeight">@lang('messages.height_in_cm')</label>
                                <input id="userHeight" value="{{ $rol_usuario_info->height }}" type="number" class="form-control" 
                                placeholder="@lang('messages.height_in_cm')" name="height" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userWeight">@lang('messages.weight_in_kg')</label>
                                <input id="userWeight" value="{{ $rol_usuario_info->weight }}" type="text" class="form-control" 
                                placeholder="@lang('messages.weight_in_kg')" name="weight" required />
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-lg-2 offset-5 text-center">
                        <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> @lang('messages.save_stat')</button>
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

    @section('viewsScripts')

        <script>
            let shortNameCountryCode = "{{ $usuario->phonePrefixes->countries->short_name  }}";
        </script>

        <script type="text/javascript" src="{{ asset('js/editPatient.js')  . '?r=' . rand() }}"></script>

    @endsection



