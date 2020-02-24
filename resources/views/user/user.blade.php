@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Todos los usuarios</div>
    </nav>
@endsection

@section('content')


<div class="tabs hv-users">
    <div class="tab" name="Todos los usuarios">
        <div class="box">
            <h5 class="header_box">
                <i class="fa fa-users"></i>Todos los usuarios
                <!-- <a href="#" data-toggle="modal" data-target="#create">
                    <label class="header_action bt-create"><i class="fa fa-plus"></i>Crear usuario</label>
                </a> -->
            </h5>
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-2">
                    <select class="u_rol">
                        <option value="1">Pacientes</option>
                        <option value="2">Personal Sanitario</option>
                        <option value="3">Personal Administrativo</option>
                        <option value="4">Administradores</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-8">
                    <input type="text" name="" placeholder="Nombre usuario o historial">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2">
                    <a class="btn btn-primary bt-search inp_height"><i class="fa fa-search"></i>Buscar</a>
                </div>
            </div>
            <div class="row user_list_header">
                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3"><h5>Apellidos, Nombre</h5></div>
                <div class="hidden-xs col-sm-4 col-md-2 col-lg-2"><h5>Rol</h5></div>
                <div class="hidden-xs hidden-sm col-md-2 col-lg-2"><h5>Identificador</h5></div>
                <div class="hidden-xs hidden-sm col-md-2 col-lg-2"><h5>DNI</h5></div>
                <div class="hidden-xs hidden-sm hidden-md col-lg-2"><h5>Nacimiento</h5></div>
                <div class="hidden-xs hidden-sm hidden-md col-lg-1"><h5>Sexo</h5></div>
            </div>
            <ul class="user_list list_limit_height-lg">
                <li name="4">      
                    <div class="row">          
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              
                            <img class="avatar" src="http://localhost/denis/resources/images/avatars/user_woman.png">
                                Marques Munoz, Maria          
                        </div>          
                        <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">                                
                            Paciente                        
                        </div>          
                        <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              
                            987654321          
                        </div>          
                        <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              
                            paciente1          
                        </div>          
                        <div class="hidden-xs hidden-sm hidden-md col-lg-2">              
                            1974-10-05          
                        </div>          
                        <div class="hidden-xs hidden-sm hidden-md col-lg-1">                                
                            Mujer                        
                        </div>      
                    </div>  
                </li>
                <!-- <li name="5">      <div class="row">          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              <img class="avatar" src="http://localhost/denis/resources/images/avatars/user_woman.png">              Sanchez Sanz, Laura          </div>          <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">                                Paciente                        </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              36843287          </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              paciente2          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-2">              1980-01-12          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-1">                                Mujer                        </div>      </div>  </li><li name="6">      <div class="row">          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              <img class="avatar" src="http://localhost/denis/resources/images/avatars/user_man.png">              Rodriguez Cano, Pedro          </div>          <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">                                Paciente                        </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              5445300          </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              paciente3          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-2">              1966-01-20          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-1">                                Hombre                        </div>      </div>  </li><li name="10">      <div class="row">          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              <img class="avatar" src="http://localhost/denis/resources/images/avatars/user_man.png">              Llana Sanchez, Marcos          </div>          <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">                                Paciente                        </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              4565454          </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              47255641L          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-2">              1988-01-05          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-1">                                Hombre                        </div>      </div>  </li><li name="17">      <div class="row">          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              <img class="avatar" src="http://localhost/denis/resources/images/avatars/user_woman.png">              Carter Gomez, Gloria          </div>          <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">                                Paciente                        </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              111444555          </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              3684526R          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-2">              1959-06-04          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-1">                                Mujer                        </div>      </div>  </li><li name="20">      <div class="row">          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              <img class="avatar" src="http://localhost/denis/resources/images/avatars/user_man.png">              Perez Lopez, Juan          </div>          <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">                                Paciente                        </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              123456789          </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              111111111A          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-2">              1989-02-01          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-1">                                Hombre                        </div>      </div>  </li><li name="21">      <div class="row">          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              <img class="avatar" src="http://localhost/denis/resources/images/avatars/user_man.png">              Muñoz Cartagena, Cesar           </div>          <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">                                Paciente                        </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              425412189          </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              222333444A          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-2">              1970-03-08          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-1">                                Hombre                        </div>      </div>  </li><li name="26">      <div class="row">          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              <img class="avatar" src="http://localhost/denis/resources/images/avatars/user_man.png">              Perez Martin, Daniel          </div>          <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">                                Paciente                        </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              1318020427          </div>          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              000000A          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-2">              1979-06-08          </div>          <div class="hidden-xs hidden-sm hidden-md col-lg-1">                                Hombre                        </div>      </div>  </li> -->
            </ul>
        </div>
    </div>
</div>


@endsection