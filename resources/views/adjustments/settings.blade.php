@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

<div class="hv-profile row">
    <div class="col-xs-12">
        <div class="box">
            <h5 class="header_box"><i class="fa fa-user"></i>Datos Usuario</h5>
            <table>
                <tbody><tr>
                    <td>Nombre:</td>
                    <td>Denis</td>
                </tr>
                <tr>
                    <td>Apellidos:</td>
                    <td>Vaillo Sanchez</td>
                </tr>
                <tr>
                    <td>Dni:</td>
                    <td>admin</td>
                </tr>
                <tr>
                    <td>Dirección:</td>
                    <td> C/Sin nombre 25 (Mostoles, 28938) </td>
                </tr>
                <tr>
                    <td>Teléfono:</td>
                    <td>656456292</td>
                </tr>
            </tbody></table>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <h5 class="header_box"><i class="fa fa-envelope-o"></i>Tu email</h5>
            <div class="email_wrapper row">
                <div class="col-xs-12">
                    Tu Email:
                    <input type="text" name="email_act" value="denisvaillo@gmail.es" readonly="true">
                </div>                    <div class="col-xs-12 col-sm-6">
                        Nuevo email:
                        <input type="text" name="email_1" value="" placeholder="ejemplo@dominio.es">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        Repite nuevo Email:
                        <input type="text" name="email_2" value="" placeholder="ejemplo@dominio.es">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <a class="btn btn-primary bt-save_email">Guardar</a>
                    </div>            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <h5 class="header_box"><i class="fa fa-key"></i>Tu contraseña</h5>
            <div class="password_wrapper row">                    <div class="col-xs-12 col-sm-6">
                        Nueva contraseña:
                        <input type="password" name="password_1" value="" placeholder="minimo 6 caracteres">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        Repite nueva contraseña:
                        <input type="password" name="password_2" value="" placeholder="repite contraseña">
                    </div>
                    <div class="col-xs-12">
                        Confirma tu contraseña actual:
                        <input type="password" name="password_old" value="" placeholder="********">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <a class="btn btn-primary bt-save_password">Guardar</a>
                    </div>            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-12">
        <div class="">
            <h5 class=""><i class="fa fa-envelope-o"></i>Tu avatar</h5>
            <div class="">
                <div class="col-xs-12">
                    Tu Avatar:
                    @if (!empty($user->avatar))
                        <img class="avatar" src="{{ asset('images/avatars/'.$user->avatar) }}" class="avatar big">                                                               
                    @else
                        @if ($user->sex=="male")
                            <img class="avatar" src="{{ asset('images/avatars/user_man.png') }}" class="avatar big">                                                               
                        @endif
                        @if ($user->sex=="female")
                            <img class="avatar" src="{{ asset('images/avatars/user_woman.png') }}" class="avatar big">                                                               
                        @endif
                    @endif
                </div> 
                <div class="col-xs-12 col-sm-6">
                        Nuevo avatar:
                        <form id="form-new-avatar" role="form" method="POST" 
                        action="{{ route('avatar.update',$user->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input id="avatar" name="avatar" type="file" accept=".png,.jpg,.jpeg"/>
                            <button type="submit" >Actualizar avatar
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection