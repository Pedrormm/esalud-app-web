@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

    <div class="container-fluid">

        <div class="card shadow mb-4" id="mainCardShadow">
          <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.settings_stat')</h4>
            {{-- <div class="row">
                <div class="cHeader col-2">
                  <button type="button" class="btn btn-primary">
                      <i class="fas fa-arrow-left"></i>
                  </button>
                </div>
                <h4 class="font-weight-bold text-primary centered">@lang('messages.settings_stat')</h4>
            </div> --}}
          </div>
    
          <div class="card-body" id="mainCardBody">
                {{-- <form action="/user/editUser" method="POST" id="newUserMailForm"> --}}
                {{-- {{ Form::open(array('url' => '/users/'.$userLogin->id, 'method' => 'PUT', 'id'=>'settingsForm')) }} --}}
                {{ Form::open(array('id'=>'settingsForm')) }}

                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <h3>@lang('messages.my_user_data')</h3>
                        </div>
                    </div>
                   
                    <div class="row mb-3">
                        <input type="hidden" value="{{ $userLogin->id }}" name="user_id" />
                        @if ($userLogin->role_id == \HV_ROLES::ADMIN)
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userEmail">Email</label>
                                <input type="text" id="userEmail" class="form-control" value="{{ $userLogin->email }}" 
                                name="email" placeholder="Email" />                           
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userDni">DNI</label>
                                <input type="text" id="userDni" class="form-control" value="{{ $userLogin->dni }}" 
                                name="dni" placeholder="DNI" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userRole">@lang('messages.role_stat')</label>
                                <select name="role_id" id="userRole" class="selectpicker show-tick form-control" 
                                data-width="100%" data-live-search="true" title="@lang('messages.role_stat')">
                                    @foreach ($roles as $rol)
                                        <option value={{ $rol->id }} {{ $userLogin->role_id == $rol->id ? 'selected' : "" }}>{{ $rol->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userMailAdmin">Email</label>
                                <input type="text" id="userMailAdmin" class="form-control" value="{{ $userLogin->email }}" 
                                name="email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userDniAdmin">DNI</label>
                                <input type="text" id="userDniAdmin" class="form-control" value="{{ $userLogin->dni }}" 
                                name="dni" placeholder="DNI" />
                            </div>
                        </div>
                        @endif

                    </div>
    
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userName">@lang('messages.name_data')</label>
                                <input type="text" id="userName" class="form-control" value="{{ $userLogin->name }}" 
                                placeholder="@lang('messages.name_data')" name="name" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userLastname">@lang('messages.surname_data')</label>
                                <input type="text" id="userLastname" class="form-control" value="{{ $userLogin->lastname }}" 
                                placeholder="@lang('messages.surname_data')" name="lastname" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userAddress">@lang('messages.address_data')</label>
                                <input type="text" id="userAddress" class="form-control" value="{{ $userLogin->address }}" 
                                placeholder="@lang('messages.address_data')" name="address" />
                            </div>
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userCountry">@lang('messages.country_data')</label>
                                {{-- <input type="text" id="userCountry" class="form-control" value="{{ $userLogin->country }}" 
                                placeholder="@lang('messages.country_data')" name="country" /> --}}

                                <select name="country_id" id="userCountry" required class="selectpicker show-tick form-control" 
                                data-width="100%" data-live-search="true" title="@lang('messages.country_data')">
                                    @foreach( $countries as $country)
                                        <option {{ $userLogin->countries->id == $country->id ? 'selected' : "" }}
                                            value="{{ $country->id }}">{{ $country->long_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userCity">@lang('messages.city_data')</label>
                                <input type="text" id="userCity" class="form-control" value="{{ $userLogin->city }}" 
                                placeholder="@lang('messages.city_data')" name="city" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="userZipcode">@lang('messages.zip_code')</label>
                                <input type="number" id="userZipcode" class="form-control" value="{{ $userLogin->zipcode }}" 
                                placeholder="@lang('messages.zip_code')" name="zipcode" />
                            </div>
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="smsPhone">@lang('messages.phone_number')</label>
                                <input type='tel' value="{{ $userLogin->phone }}" class="form-control" name="phone" 
                                id="smsPhone" maxlength="12" />
                                <span id="valid-msg" class="hide"></span>
                                <span id="error-msg" class="hide"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="bDate">@lang('messages.date_of_birth')</label>
                                <input type="date" value="{{ date("Y-m-d", strtotime($userLogin->birthdate)) }}" name="birthdate" 
                                class="form-control" data-placeholder="@lang('messages.date_of_birth')" aria-="true" id="bDate" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="userGender">@lang('messages.gender_data')</label>
                                <select name="sex" id="userGender" class="selectpicker show-tick form-control" 
                                data-width="100%" data-live-search="true" title="@lang('messages.gender_data')">
                                    @if($userLogin->sex == "female")
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
                                <select name="blood" id="userBlood" class="selectpicker show-tick form-control" data-width="100%" 
                                data-live-search="true" title="@lang('messages.blood_group')">
                                    <option value="0-" {{ $userLogin->blood == "0-" ? 'selected' : "" }}>0-</option>
                                    <option value="0+" {{ $userLogin->blood == "0+" ? 'selected' : "" }}>0+</option>
                                    <option value="A-" {{ $userLogin->blood == "A-" ? 'selected' : "" }}>A-</option>
                                    <option value="A+" {{ $userLogin->blood == "A+" ? 'selected' : "" }}>A+</option>
                                    <option value="B-" {{ $userLogin->blood == "B-" ? 'selected' : "" }}>B-</option>
                                    <option value="B+" {{ $userLogin->blood == "B+" ? 'selected' : "" }}>B+</option>
                                    <option value="AB-" {{ $userLogin->blood == "AB-" ? 'selected' : "" }}>AB-</option>
                                    <option value="AB+" {{ $userLogin->blood == "AB+" ? 'selected' : "" }}>AB+</option>
                                </select>  
                            </div>
                        </div>
                    </div>

                        
                    <div class="row mb-3">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="newsNumber">@lang('messages.news_number')</label>
                                <input type="number" id="newsNumber" class="form-control" value="{{ $userLogin->news_number }}" 
                                placeholder="@lang('messages.number_of_news_displayed')" name="news_number" 
                                min="{{ \HV_MIN_NEWS_NUMBER }}" max="{{ \HV_MAX_NEWS_NUMBER }}"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="spellingChecker">@lang('messages.spelling_checker')</label>
                                <select id="spellingChecker" name="has_spelling_checker" class="selectpicker show-tick selectHasSpelling form-control" 
                                data-width="100%" data-live-search="true" title="@lang('messages.activate_spelling_checker')">
                                    <option value="0" {{ $userLogin->has_spelling_checker == "0" ? 'selected' : "" }}>@lang('messages.desactivated_stat')</option>
                                    <option value="1" {{ $userLogin->has_spelling_checker == "1" ? 'selected' : "" }}>@lang('messages.activated')</option>
                                </select>     
                            </div>                 
                        </div>
                    </div>

    
                    @if($userLogin->role_id == \HV_ROLES::PATIENT)
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
    
                    @if(($userLogin->role_id == \HV_ROLES::DOCTOR) || ($userLogin->role_id == \HV_ROLES::HELPER))
                    
                        @if($userLogin->role_id == \HV_ROLES::DOCTOR)
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <hr>
                                    <h3>@lang('messages.doctor_data')</h3>
                                </div>
                            </div>
                        @endif

                        @if($userLogin->role_id == \HV_ROLES::HELPER)
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
                                    <input id="userHistoricalStaff" type="text" value="{{ $rol_usuario_info->historic }}" class="form-control"
                                    placeholder="@lang('messages.historical_stat')" name="historic" required />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="userSpeciality">@lang('messages.select_specialty')</label>
                                    <select name="medical_speciality_id" id="userSpeciality" required class="selectpicker show-tick form-control" 
                                    data-width="100%" data-live-search="true" title="@lang('messages.select_specialty')">
                                        @foreach( $medicalSpecialities as $medicalSpeciality)
                                            <option {{ $rol_usuario_info->medical_speciality_id == $medicalSpeciality->id ? 'selected' : "" }}
                                                value="{{ $medicalSpeciality->id }}">{{ $medicalSpeciality->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3"> 
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="userOffice">@lang('messages.office_data')</label>
                                    <input type="text" id="userOffice" value="{{ $rol_usuario_info->office }}" class="form-control" 
                                    placeholder="@lang('messages.office_data')" name="office" required />
                                </div>
                            </div>                   
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="userRoom">@lang('messages.door_data')</label>
                                    <input type="text" id="userRoom" class="form-control" value="{{ $rol_usuario_info->room }}" 
                                    placeholder="@lang('messages.door_data')" name="room" required />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="userBusinessPhone">@lang('messages.business_phone_number')</label>
                                    <input type="text" id="userBusinessPhone" class="form-control" value="{{ $rol_usuario_info->h_phone }}"
                                    placeholder="@lang('messages.business_phone_number')" name="h_phone" required />
                                </div>
                            </div>
                        </div>
                    @endif
                    


                    <div class="row mb-3">
                        <div class="col-lg-2 offset-5 text-center" id="editSettingsContainer">
                            <button class="btn btn-primary btn-block" type="button" id="editSettings"><i class="fa fa-edit"></i> @lang('messages.save_stat')</button>
                        </div>
                    </div>

                
                {{ Form::close() }}
                {{-- </form> --}}


                <div id="snapshot-container" class="d-none">
                    <!-- Stream video via webcam -->
                    <div class="video-wrap">
                        <video id="videoSnap" playsinline autoplay muted class="video-snap"></video>
                    </div>

                    <!-- Trigger canvas web API -->
                    <div class="controller text-center">
                        <button class="btn btn-info" type="button" id="snap"><i class="fa fa-camera"></i><span class="tab"> @lang('messages.capture_stat')</span></button>
                    </div>

                    <!-- Webcam video snapshot -->
                    <canvas id="canvas" class="d-none"></canvas>
                </div>

                <div class="text-center">
                    <div class="col-xs-12">
                        {{-- <h5 class=""><i class="fa fa-envelope-o"></i>Tu avatar</h5> --}}
                        <div class="">
                            <div class="col-xs-12">
                                    {{-- Nuevo avatar: --}}
                                    {{-- <form id="form-new-avatar" role="form" method="POST" 
                                    action="{{ route('avatar.update',$userLogin->id) }}" enctype="multipart/form-data"> --}}
                                   
                                    {{ Form::open(array('id'=>'form-new-avatar','enctype'=>'multipart/form-data')) }}

                                        {{-- {{ csrf_field() }} --}}
                                        {{-- <input id="avatar" name="avatar" type="file" accept=".png,.jpg,.jpeg,.bmp"/>
                                        <button type="submit" >Actualizar avatar
                                        </button> --}}


                                        <div class="settings-container">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  {{-- <label class="control-label">Upload File</label> --}}
                                                  <div class="preview-zone hidden">

                                                    <div class="settings-box box-solid">
                                                      <div class="box-header with-border">
                                                        <div id="profile-picture-container"><b>@lang('messages.profile_picture')</b></div>
                                                        <div class="box-tools-left float-left">                                                    
                                                            <button type="button" class="btn btn-success btn-xs" id="takeScreenshot">
                                                              <i class="fa fa-camera-retro"></i>
                                                              <span id="capturerText" class="tab"> @lang('messages.show_image_grabber_from_camera')</span>
                                                            </button>
                                                        </div>

                                                        <div class="box-tools float-right" id="hide-image-container">
                                                          <button type="button" class="btn btn-info btn-xs remove-preview">
                                                            <i class="fa fa-eye-slash"></i>
                                                            <span class="tab"> @lang('messages.hide_image')</span>
                                                          </button>
                                                          
                                                        </div>
                                                      </div>
                                                      <div class="box-body" id="avatar-container">

                                                        @if (!empty($userLogin->avatar))
                                                            <img src="{{ asset('images/avatars/'.$userLogin->avatar) }}" class="rounded-circle mx-auto d-block avatar-image" id="previewImage"/>
                                                        @else
                                                            @if ($userLogin->sex=="male")
                                                                <img src="{{ asset('images/avatars/user_man.png') }}" class="rounded-circle mx-auto d-block avatar-image" id="previewImage"/>                                                               
                                                            @endif
                                                            @if ($userLogin->sex=="female")
                                                                <img src="{{ asset('images/avatars/user_woman.png') }}" class="rounded-circle mx-auto d-block avatar-image" id="previewImage"/>                                                               
                                                            @endif
                                                        @endif

                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="dropzone-wrapper">
                                                    <div class="dropzone-desc">
                                                      <i class="glyphicon glyphicon-download-alt"></i>
                                                      <p>@lang('messages.choose_an_image_file_or_drag_it_here')</p>
                                                    </div>
                                                    <input type="file" name="avatar" id="imgAvatar" class="dropzone" accept=".png,.jpg,.jpeg,.bmp">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                      
                                            <div class="row">
                                              <div class="col-md-12">
                                                <button type="button" class="btn btn-danger float-left" id="deleteImage">
                                                    <i class="fa fa-trash-alt"></i>
                                                    <span class="tab"> @lang('messages.delete_profile_picture')</span>
                                                </button>

                                                <button type="submit" class="btn btn-primary float-right" id="uploadImage" disabled>
                                                    <i class="fa fa-file-upload"></i>
                                                    <span class="tab"> @lang('messages.upload_stat')</span>
                                                </button>
                                              </div>
                                            </div>
                                        </div>
                                      
                                    {{-- form-new-avatar --}}
                                    {{ Form::close() }} 
                                    {{-- </form> --}}


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    
      </div>

@endsection

@section('viewsScripts')
    <script>
        let shortNameCountryCode = "{{ $userLogin->phonePrefixes->countries->short_name  }}";
    </script>
    <script type="text/javascript" src="{{ asset('js/dropImageUpload.js')  . '?r=' . rand() }}"></script>
    <script type="text/javascript" src="{{ asset('js/settings.js')  . '?r=' . rand() }}"></script>

@endsection
