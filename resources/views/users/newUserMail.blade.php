<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
<body id="page-top">

  <div class="container-fluid">

    <div class="card shadow mb-4" id="mainCardShadow">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.Create new user')</h4>
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
                        <h3>@lang('messages.User data')</h3>
                    </div>
                </div>
               
                <div class="row mb-3">
                    {{ Form::hidden('token', $token) }}
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
                        <input type="text" class="form-control" placeholder=@lang('messages.name') name="name" required/>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder=@lang('messages.surname') name="lastname" required/>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder=@lang('messages.address') name="address" required/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder=@lang('messages.Country') name="country" />
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder=@lang('messages.City') name="city" />
                    </div>
                    <div class="col-lg-4">
                        <input type="number" class="form-control" placeholder=@lang('messages.Zip code') name="zipcode" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3">
                        {{-- <input type="text" class="form-control" placeholder=@lang('messages.Phone number') name="phone" /> --}}
                        
                        <input type='tel' class="form-control" name="phone" id="smsPhone" maxlength="12" />
                        <div id="valid-msg" class="valid-feedback hide"></div>
                        <div id="error-msg" class="valid-feedback hide"></div>
                    </div>
                    <div class="col-lg-3">
                        <input type="date" name="birthdate" class="form-control" data-placeholder=@lang('messages.date of birth') required aria-required="true" id="bDate" />
                    </div>
                    <div class="col-lg-3">
                        {{-- <select name="sex" class="form-control" required> --}}                      
                        <select name="sex" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                        data-live-search="true" title=@lang('messages.gender')>
                            <option value="female">@lang('messages.female')</option>
                            <option value="male">@lang('messages.male')</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        {{-- <select name="blood" class="form-control" required> --}}
                        <select name="blood" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                            data-live-search="true" title=@lang('messages.blood group')>
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
                            <h3>@lang('messages.Patient data')</h3>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder=@lang('messages.Historical') name="historic" />
                        </div>
                        <div class="col-lg-4">
                            <input type="number" class="form-control" placeholder=@lang('messages.Height in cm') name="height" />
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder=@lang('messages.Weight in kg') name="weight" />
                        </div>
                    </div>
                @endif

                @if($rol->id == 2)
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <hr>
                            <h3>@lang('messages.Doctor data')</h3>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <input type="text" class="form-control" placeholder=@lang('messages.Historical') name="historic" />
                        </div>
                        <div class="col-lg-6">
                            {{-- <select class="form-control" name="branch">
                                <option>@lang('messages.Select specialty')</option> --}}
                            <select name="branch" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                            data-live-search="true" title=@lang('messages.Select specialty')>
                                @foreach( $branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-lg-4">
                            <select class="form-control selectpicker show-tick" name="shift" data-live-search="true"
                            title="Seleccione horario">
                                <option value="M">Mañana</option>
                                <option value="ME">Mañana y Tarde</option>
                                <option value="MN">Mañana y Noche</option>
                                <option value="MEN">Mañana , Tarde y Noche</option>
                                <option value="E">Tarde</option>
                                <option value="EN">Tarde y Noche</option>
                                <option value="N">Noche</option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="row mb-3"> 
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder=@lang('messages.Office') name="office" />
                        </div>                   
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder=@lang('messages.Door') name="room" />
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder=@lang('messages.Phone number') name="h_phone" />
                        </div>
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <hr>
                        <h3>@lang('messages.Access data')</h3>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <input type="password" class="form-control" placeholder=@lang('messages.Password') name="password" id="password" required/>
                    </div>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" placeholder=@lang('messages.Repeat password') name="repeat_password" id="repeat_password" required/>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-lg-2 offset-5 text-center">
                        <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i> @lang('messages.create')</button>
                    </div>
                </div>

            </form>
            

        @endif
        </div>
    </div>

  </div>
  @include('inc.jsDeclaration')
  @include('inc.jsGlobalsDefinition')
  <script type="text/javascript" src="{{ asset('js/newUserMail.js')}}"></script>

  @include('inc.scripts')
</body>
