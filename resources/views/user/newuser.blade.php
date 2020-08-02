@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

  <div class="container-fluid">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">Creación de Usuario</h4>
      </div>

      <div class="card-body">
        <form action="/user/create" method="POST">        
          <div class="row">
              @csrf
              <div class="col-lg-4">
                <input required type="text" class="form-control" name="dni" placeholder="DNI"/>
              </div>
              <div class="col-lg-4">
                <input required type="email" class="form-control" name="email" placeholder="e-mail"/>
              </div>
              <div class="col-lg-4">
                <select required style="height: calc(1.5em + 0.75rem + 2px) !important;" class="form-control" name="rol_id">
                  @foreach ($roles as $rol)                   
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>    
                  @endforeach
                </select>
              </div>       
          </div>
          <div class="row mb-4">          
            <div class="col-lg-12 text-center">
              <button class="btn btn-primary btn-lg" type="submit">Enviar email de creación</button>
            </div>
          </div>
      </form>
      
      @if(isset($info))
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
      @endif

      </div>
    </div>

  </div>

@endsection