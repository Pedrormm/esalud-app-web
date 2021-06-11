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
                <h4 class="font-weight-bold text-primary centered">Ajustes</h4>
            </div> --}}
          </div>
    
          <div class="card-body" id="mainCardBody">
                {{-- <form action="/user/editUser" method="POST" id="newUserMailForm"> --}}
                {{-- {{ Form::open(array('url' => '/users/'.auth()->user()->id, 'method' => 'PUT', 'id'=>'settingsForm')) }} --}}
                {{ Form::open(array('id'=>'settingsForm')) }}

                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <h3>@lang('messages.my_user_data')</h3>
                        </div>
                    </div>
                   
                    <div class="row mb-3">
                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" />
                        @if (auth()->user()->role_id == \HV_ROLES::ADMIN)
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ auth()->user()->email }}" name="email" placeholder="Email" />
                            
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ auth()->user()->dni }}" name="dni" />
                        </div>
                        <div class="col-lg-4">
                            {{-- <input type="text" class="form-control" value="{{ App\Models\Role::find(auth()->user()->role_id)->id }}" name="role_id" /> --}}
                                <select name="role_id" class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                                    data-live-search="true" title=@lang('messages.role_stat')>
                                    @foreach ($roles as $rol)
                                        <option value={{ $rol->id }} {{ auth()->user()->role_id == $rol->id ? 'selected' : "" }}>{{ $rol->name }}</option>
                                    @endforeach
                                </select> 
                        </div>
                        @else
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{ auth()->user()->email }}" name="email" placeholder="Email" />
                            
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{ auth()->user()->dni }}" name="dni" />
                        </div>
                        @endif

                    </div>
    
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" placeholder=@lang('messages.name_data') name="name" />
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ auth()->user()->lastname }}" placeholder=@lang('messages.surname_data') name="lastname" />
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ auth()->user()->address }}" placeholder=@lang('messages.address_data') name="address" />
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ auth()->user()->country }}" placeholder=@lang('messages.country_data') name="country" />
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="{{ auth()->user()->city }}" placeholder=@lang('messages.city_data') name="city" />
                        </div>
                        <div class="col-lg-4">
                            <input type="number" class="form-control" value="{{ auth()->user()->zipcode }}" placeholder=@lang('messages.zip_code') name="zipcode" />
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            {{-- <input type="text" class="form-control" placeholder=@lang('messages.phone_number') name="phone" /> --}}
                            <input type='tel' value="{{ auth()->user()->phone }}" class="form-control" name="phone" id="smsPhone" maxlength="12" />
                            <span id="valid-msg" class="hide"></span>
                            <span id="error-msg" class="hide"></span>
                        </div>
                        <div class="col-lg-3">
                            <input type="date" value="{{ date("Y-m-d", strtotime(auth()->user()->birthdate)) }}" name="birthdate" class="form-control" data-placeholder=@lang('messages.date_of_birth')  aria-="true" id="bDate" />
                        </div>
                        <div class="col-lg-3">
                            <select name="sex"  class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                            data-live-search="true" title=@lang('messages.gender_data')>
                                @if(auth()->user()->sex == "female")
                                <option selected value="female">@lang('messages.female_data')</option>
                                <option value="male">@lang('messages.male_data')</option>
                                @else
                                <option value="female">@lang('messages.female_data')</option>
                                <option selected value="male">@lang('messages.male_data')</option>
                                @endif
                               
                            </select>
                        </div>
                        <div class="col-lg-3">
                            {{-- <select name="blood" class="form-control" > --}}
                            <select name="blood"  class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                                data-live-search="true" title=@lang('messages.blood_group')>
                                <option value="0-" {{ auth()->user()->blood == "0-" ? 'selected' : "" }}>0-</option>
                                <option value="0+" {{ auth()->user()->blood == "0+" ? 'selected' : "" }}>0+</option>
                                <option value="A-" {{ auth()->user()->blood == "A-" ? 'selected' : "" }}>A-</option>
                                <option value="A+" {{ auth()->user()->blood == "A+" ? 'selected' : "" }}>A+</option>
                                <option value="B-" {{ auth()->user()->blood == "B-" ? 'selected' : "" }}>B-</option>
                                <option value="B+" {{ auth()->user()->blood == "B+" ? 'selected' : "" }}>B+</option>
                                <option value="AB-" {{ auth()->user()->blood == "AB-" ? 'selected' : "" }}>AB-</option>
                                <option value="AB+" {{ auth()->user()->blood == "AB+" ? 'selected' : "" }}>AB+</option>
                            </select>                    
                        </div>
                    </div>

                        
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <input type="number" class="form-control" value="{{ auth()->user()->news_number }}" placeholder=@lang('messages.number_of_news_displayed') name="news_number" min="1" max="9"/>
                        </div>
                        <div class="col-lg-6">
                            <select name="has_spelling_checker" class="selectpicker show-tick selectHasSpelling form-control" data-width="100%" 
                                data-live-search="true" title=@lang('messages.activate_spelling_checker')>
                                <option value="0" {{ auth()->user()->has_spelling_checker == "0" ? 'selected' : "" }}>@lang('messages.desactivated_stat')</option>
                                <option value="1" {{ auth()->user()->has_spelling_checker == "1" ? 'selected' : "" }}>@lang('messages.activated')</option>
                            </select>                    
                        </div>
                    </div>

    
                    @if(auth()->user()->role_id == \HV_ROLES::PATIENT)
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <hr>
                                <h3>@lang('messages.patient_data')</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <input value="{{ $rol_usuario_info->historic }}" type="text" class="form-control" placeholder=@lang('messages.historical_stat') name="historic" />
                            </div>
                            <div class="col-lg-4">
                                <input value="{{ $rol_usuario_info->height }}" type="number" class="form-control" placeholder=@lang('messages.height_in_cm') name="height" />
                            </div>
                            <div class="col-lg-4">
                                <input value="{{ $rol_usuario_info->weight }}" type="text" class="form-control" placeholder=@lang('messages.weight_in_kg') name="weight" />
                            </div>
                        </div>
                    @endif
    
                    @if(auth()->user()->role_id == \HV_ROLES::DOCTOR)
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
                            <button class="btn btn-primary btn-block" type="button" id="editSettings"><i class="fa fa-edit"></i> @lang('messages.edit_stat')</button>
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
                                    action="{{ route('avatar.update',auth()->user()->id) }}" enctype="multipart/form-data"> --}}
                                   
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
                                                        <div><b>@lang('messages.profile_picture')</b></div>
                                                        <div class="box-tools-left float-left">                                                    
                                                            <button type="button" class="btn btn-success btn-xs" id="takeScreenshot">
                                                              <i class="fa fa-camera-retro"></i>
                                                              <span id="capturerText" class="tab"> @lang('messages.show_image_grabber_from_camera')</span>
                                                            </button>
                                                        </div>

                                                        <div class="box-tools float-right">
                                                          <button type="button" class="btn btn-info btn-xs remove-preview">
                                                            <i class="fa fa-eye-slash"></i>
                                                            <span class="tab"> @lang('messages.hide_image')</span>
                                                          </button>
                                                          
                                                        </div>
                                                      </div>
                                                      <div class="box-body">

                                                        @if (!empty(auth()->user()->avatar))
                                                            <img src="{{ asset('images/avatars/'.auth()->user()->avatar) }}" class="rounded-circle mx-auto d-block avatar-image" id="previewImage"/>
                                                        @else
                                                            @if (auth()->user()->sex=="male")
                                                                <img src="{{ asset('images/avatars/user_man.png') }}" class="rounded-circle mx-auto d-block avatar-image" id="previewImage"/>                                                               
                                                            @endif
                                                            @if (auth()->user()->sex=="female")
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
    <script type="text/javascript" src="{{ asset('js/dropImageUpload.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/settings.js')}}"></script>
@endsection
