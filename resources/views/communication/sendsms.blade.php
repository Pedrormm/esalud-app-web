@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')


<div class="container-fluid">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">Enviar SMS</h4>
      </div>

      <div class="card-body">
        <div id="smsFormError">

        </div>
        <form method='POST' id="smsForm">
            {{-- @if($errors->any())
            <ul>
            @foreach($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
            @endforeach
            <ul>
            @endif --}}
        {{-- @if(session('success'))
            <strong>{{ session('success') }}</strong>
        @endif --}}
            <label for="to">Enter Telephone Number:</label>
            <input type='tel' name='to' id='smsPhone' maxlength="12" required/>
            <span id="valid-msg" class="hide"></span>
            <span id="error-msg" class="hide"></span>
            <br/><br/>
            <label>Message/Body:</label>
            <textarea name='messages' id='messagesSms' required></textarea>
            <br/><br/>
            <div class="row mb-3">
                <div class="col-lg-2 offset-5 text-center">
                    <button type='submit' class="btn btn-primary btn-block"><i class="fa fa-sms"></i> Send</button>
                </div>              
            </div>
            @csrf
        </form>
      
      {{-- @if(isset($info))
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-info">
              {{ $info }}
            </div>
          </div>
        </div>
      @endif
      
      @if(isset($danger))
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-danger">
              {{ $danger }}
            </div>
          </div>
        </div>
      @endif --}}

      </div>
    </div>

  </div>


  <script type="text/javascript" src="{{ asset('js/sendsms.js')}}"></script>

@endsection

