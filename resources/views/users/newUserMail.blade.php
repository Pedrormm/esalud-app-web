<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
<body id="page-top">

  <div class="container-fluid">

    <div class="card shadow mb-4" id="mainCardShadow">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.create_new_user')</h4>
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

            <form action="{{ url('user/createNewUser') }}" method="POST" id="newUserMailForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3>@lang('messages.user_datas')</h3>
                    </div>
                </div>
               
                <div class="row mb-3">
                    {{ Form::hidden('token', $token) }}
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="hidden" value="{{ $email }}" name="email" />
                            <input id="userEmail" disabled class="form-control disabled" value="{{ $email }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userDni">DNI</label>
                            <input type="hidden" value="{{ $dni }}" name="dni" />
                            <input id="userDni" disabled class="form-control disabled" value="{{ $dni }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userRole">@lang('messages.role_stat')</label>
                            <input type="hidden" value="{{ $rol->id }}" name="rol_id" />
                            <input id="userRole" disabled class="form-control disabled" value="{{ $rol->name }}" />
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userName">@lang('messages.name_data')</label>
                            <input type="text" id="userName" class="form-control" placeholder="@lang('messages.name_data')" 
                            name="name" required/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userLastname">@lang('messages.surname_data')</label>
                            <input type="text" id="userLastname" class="form-control" placeholder="@lang('messages.surname_data')" 
                            name="lastname" required/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userAddress">@lang('messages.address_data')</label>
                            <input type="text" id="userAddress" class="form-control" placeholder="@lang('messages.address_data')" 
                            name="address" required/>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userCountry">@lang('messages.country_data')</label>
                            {{-- <input type="text" id="userCountry" class="form-control" placeholder="@lang('messages.country_data')" 
                            name="country" required /> --}}
                            <select name="country_id" id="userCountry" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-live-search="true" title="@lang('messages.country_data')">
                                @foreach( $countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->long_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userCity">@lang('messages.city_data')</label>
                            <input type="text" id="userCity" class="form-control" placeholder="@lang('messages.city_data')" 
                            name="city" required />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="userZipcode">@lang('messages.zip_code')</label>
                            <input type="number" id="userZipcode" class="form-control" placeholder="@lang('messages.zip_code')" 
                            name="zipcode" required />
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="smsPhone">@lang('messages.phone_number')</label>
                            <input type='tel' class="form-control" name="phone" id="smsPhone" maxlength="12" />
                            <div id="valid-msg" class="valid-feedback hide"></div>
                            <div id="error-msg" class="valid-feedback hide"></div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="bDate">@lang('messages.date_of_birth')</label>
                            <input type="date" name="birthdate" class="form-control" data-placeholder="@lang('messages.date_of_birth')" 
                            required aria-required="true" id="bDate" />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="userSex">@lang('messages.gender_data')</label>
                            <select id="userSex" name="sex" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-live-search="true" title="@lang('messages.gender_data')">
                                <option value="female">@lang('messages.female_data')</option>
                                <option value="male">@lang('messages.male_data')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="userBlood">@lang('messages.blood_group')</label>
                            <select id="userBlood" name="blood" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-live-search="true" title="@lang('messages.blood_group')">
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
                </div>

                @if($rol->id == \HV_ROLES::PATIENT)
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <hr>
                            <h3>@lang('messages.patient_data')</h3>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userHistoricalPatient">@lang('messages.historical_stat')</label>
                                <input type="text" id="userHistoricalPatient" class="form-control" placeholder="@lang('messages.historical_stat')" 
                                name="historic" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userHeight">@lang('messages.height_in_cm')</label>
                                <input type="number" id="userHeight" class="form-control" placeholder="@lang('messages.height_in_cm')" 
                                name="height" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userWeight">@lang('messages.weight_in_kg')</label>
                                <input type="text" id="userWeight" class="form-control" placeholder="@lang('messages.weight_in_kg')" 
                                name="weight" required />
                            </div>
                        </div>
                    </div>
                @endif

                @if(($rol->id == \HV_ROLES::DOCTOR) || ($rol->id == \HV_ROLES::HELPER))
                
                    @if($usuario->role_id == \HV_ROLES::DOCTOR)
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <hr>
                                <h3>@lang('messages.doctor_data')</h3>
                            </div>
                        </div>
                    @endif

                    @if($usuario->role_id == \HV_ROLES::HELPER)
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <hr>
                                <h3>@lang('messages.helper_data')</h3>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userHistoricalStaff">@lang('messages.historical_stat')</label>
                                <input type="text" id="userHistoricalStaff" class="form-control" 
                                placeholder="@lang('messages.historical_stat')" name="historic" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userSpeciality">@lang('messages.select_specialty')</label>
                                <select name="medical_speciality_id" id="userSpeciality" required class="selectpicker show-tick form-control" 
                                data-width="100%" data-live-search="true" title="@lang('messages.select_specialty')">
                                    @foreach( $medicalSpecialities as $medicalSpeciality)
                                        <option value="{{ $medicalSpeciality->id }}">{{ $medicalSpeciality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3"> 
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userOffice">@lang('messages.office_data')</label>
                                <input type="text" id="userOffice" class="form-control" placeholder="@lang('messages.office_data')" 
                                name="office" required />
                            </div>
                        </div>                   
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userRoom">@lang('messages.door_data')</label>
                                <input type="text" id="userRoom" class="form-control" placeholder="@lang('messages.door_data')" 
                                name="room" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userBusinessPhone">@lang('messages.business_phone_number')</label>
                                <input type="text" id="userBusinessPhone" class="form-control" placeholder="@lang('messages.business_phone_number')"
                                 name="h_phone" />
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <hr>
                        <h3>@lang('messages.access_data')</h3>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userPasswordFirst">@lang('messages.password_stat')</label>
                            <input type="password" id="userPasswordFirst" class="form-control" placeholder="@lang('messages.password_stat')" 
                            name="password" id="password" required/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userPasswordRepeat">@lang('messages.repeat_password')</label>
                            <input type="password" id="userPasswordRepeat" class="form-control" placeholder="@lang('messages.repeat_password')" 
                            name="repeat_password" id="repeat_password" required/>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-lg-2 offset-5 text-center">
                        <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i> @lang('messages.create_stat')</button>
                    </div>
                </div>

            </form>
            

        @endif
        </div>
    </div>

  </div>
  @include('inc.jsDeclaration')
  @include('inc.jsGlobalsDefinition')
  @include('inc.jsCustomScripts')
  <script type="text/javascript" src="{{ asset('js/newUserMail.js')}}"></script>

  @include('inc.scripts')
</body>
