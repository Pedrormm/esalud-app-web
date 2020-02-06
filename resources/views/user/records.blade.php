@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Historiales médicos</div>
    </nav>
@endsection

@section('content')
    <div class="tabs">
        <div class="tab" name="Historiales Medicos">
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                    <select class="sel_ord">
                        <option value="lastname">Ordenado</option>
                        <option value="lastname">Apellidos</option>
                        <option value="name">Nombre</option>
                        <option value="historic">NªHistorial</option>
                        <option value="dni">DNI</option>
                    </select>
                </div>
                <div class="col-xs-6 col-sm-2 col-md-2">
                    <select class="sel_sex">
                        <option value="">Hombres y Mujeres</option>
                        <option value="male">Hombres</option>
                        <option value="female">Mujeres</option>
                    </select>
                </div>
                <div class="col-xs-6 col-sm-2 col-md-2">
                    <select class="sel_old">
                        <option value="">Cualquier edad</option>
                        <option value="0-18">- 18 años</option>
                        <option value="18-24">18 a 24 años</option>
                        <option value="24-40">24 a 40 años</option>
                        <option value="40-65">40 a 65 años</option>
                        <option value="65-1000">+ 65 años</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-7">
                    <input type="text" placeholder="Nombre, historial o dni" class="inp_search">
                </div>
            </div>
            <div class="list_records">
            <div class="record_item col-xs-12 col-sm-6" name="17">
                @foreach($patients as $patient) 
                    @php($usuario=DB::table('users')->where('id',$patient->user_id)->get())
                    @if (count($usuario) > 0)
                    <div class="box">
                        <div class="record_left">
                            <img src="http://localhost/denis/resources/images/avatars/user_woman.png" class="avatar big">
                        </div>
                        <div class="record_right">
                            <div class="row">
                                <div class=" col-xs-12 col-md-8">
                                    <div class="row">
                                        <span class="r_title col-xs-4 col-md-3">Nombre:</span>
                                        <span class="col-xs-8 col-md-9 dots">{{ $usuario[0]->name }}</span>
                                        <span class="r_title col-xs-4 col-md-3">Apellidos:</span>
                                        <span class="col-xs-8 col-md-9 dots">{{ $usuario[0]->lastname }}</span>
                                        <span class="r_title col-xs-4 col-md-3">Historial:</span>
                                        <span class="col-xs-8 col-md-9 dots">111444555</span>
                                        <span class="r_title col-xs-4 col-md-3">DNI:</span>
                                        <span class="col-xs-8 col-md-9">{{ $usuario[0]->dni }}</span>
                                    </div>
                                </div>
                                <div class="hidden-xs hidden-sm col-md-4">
                                    <div class="row">
                                        <span class="r_title hidden-xs col-sm-4">Edad:</span>
                                        <span class="col-xs-12 col-sm-8">{{ $usuario[0]->birthdate }}</span>
                                        <span class="r_title hidden-xs col-sm-4">Sexo:</span>
                                        <span class="col-xs-12 col-sm-8">{{ $usuario[0]->sex }}</span>
                                        <span class="r_title hidden-xs col-sm-4">Altura:</span>
                                        <span class="col-xs-12 col-sm-8">{{ $patient->height }}</span>
                                        <span class="r_title hidden-xs col-sm-4">Peso:</span>
                                        <span class="col-xs-12 col-sm-8">{{ $patient->weight }}</span>
                                    </div>
                                </div>              
                            </div>          
                        </div>      
                    </div>
                    @endif  
                @endforeach
            </div>

        </div>
    </div>    

            <!-- <div class="record_item col-xs-12 col-sm-6" name="10">
                <div class="box">          
                    <div class="record_left">
                        <img src="http://localhost/denis/resources/images/avatars/user_man.png" class="avatar big">          </div>          <div class="record_right">              <div class="row">                  <div class=" col-xs-12 col-md-8">                      <div class="row">                          <span class="r_title col-xs-4 col-md-3">Nombre:</span>                          <span class="col-xs-8 col-md-9 dots">Marcos</span>                          <span class="r_title col-xs-4 col-md-3">Apellidos:</span>                          <span class="col-xs-8 col-md-9 dots">Llana Sanchez</span>                          <span class="r_title col-xs-4 col-md-3">Historial:</span>                          <span class="col-xs-8 col-md-9 dots">4565454</span>                          <span class="r_title col-xs-4 col-md-3">DNI:</span>                          <span class="col-xs-8 col-md-9">47255641L</span>                      </div>                  </div>                  <div class="hidden-xs hidden-sm col-md-4">                      <div class="row">                          <span class="r_title hidden-xs col-sm-4">Edad:</span>                          <span class="col-xs-12 col-sm-8">32</span>                          <span class="r_title hidden-xs col-sm-4">Sexo:</span>                          <span class="col-xs-12 col-sm-8">male</span>                          <span class="r_title hidden-xs col-sm-4">Altura:</span>                          <span class="col-xs-12 col-sm-8">178</span>                          <span class="r_title hidden-xs col-sm-4">Peso:</span>                          <span class="col-xs-12 col-sm-8">86</span>                      </div>                  </div>              </div>          </div>      </div>  </div><div class="record_item col-xs-12 col-sm-6" name="4">      <div class="box">          <div class="record_left">              <img src="http://localhost/denis/resources/images/avatars/user_woman.png" class="avatar big">          </div>          <div class="record_right">              <div class="row">                  <div class=" col-xs-12 col-md-8">                      <div class="row">                          <span class="r_title col-xs-4 col-md-3">Nombre:</span>                          <span class="col-xs-8 col-md-9 dots">Maria</span>                          <span class="r_title col-xs-4 col-md-3">Apellidos:</span>                          <span class="col-xs-8 col-md-9 dots">Marques Munoz</span>                          <span class="r_title col-xs-4 col-md-3">Historial:</span>                          <span class="col-xs-8 col-md-9 dots">987654321</span>                          <span class="r_title col-xs-4 col-md-3">DNI:</span>                          <span class="col-xs-8 col-md-9">paciente1</span>                      </div>                  </div>                  <div class="hidden-xs hidden-sm col-md-4">                      <div class="row">                          <span class="r_title hidden-xs col-sm-4">Edad:</span>                          <span class="col-xs-12 col-sm-8">45</span>                          <span class="r_title hidden-xs col-sm-4">Sexo:</span>                          <span class="col-xs-12 col-sm-8">female</span>                          <span class="r_title hidden-xs col-sm-4">Altura:</span>                          <span class="col-xs-12 col-sm-8">180</span>                          <span class="r_title hidden-xs col-sm-4">Peso:</span>                          <span class="col-xs-12 col-sm-8">96</span>                      </div>                  </div>              </div>          </div>      </div>  </div><div class="record_item col-xs-12 col-sm-6" name="21">      <div class="box">          <div class="record_left">              <img src="http://localhost/denis/resources/images/avatars/user_man.png" class="avatar big">          </div>          <div class="record_right">              <div class="row">                  <div class=" col-xs-12 col-md-8">                      <div class="row">                          <span class="r_title col-xs-4 col-md-3">Nombre:</span>                          <span class="col-xs-8 col-md-9 dots">Cesar </span>                          <span class="r_title col-xs-4 col-md-3">Apellidos:</span>                          <span class="col-xs-8 col-md-9 dots">Muñoz Cartagena</span>                          <span class="r_title col-xs-4 col-md-3">Historial:</span>                          <span class="col-xs-8 col-md-9 dots">425412189</span>                          <span class="r_title col-xs-4 col-md-3">DNI:</span>                          <span class="col-xs-8 col-md-9">222333444A</span>                      </div>                  </div>                  <div class="hidden-xs hidden-sm col-md-4">                      <div class="row">                          <span class="r_title hidden-xs col-sm-4">Edad:</span>                          <span class="col-xs-12 col-sm-8">49</span>                          <span class="r_title hidden-xs col-sm-4">Sexo:</span>                          <span class="col-xs-12 col-sm-8">male</span>                          <span class="r_title hidden-xs col-sm-4">Altura:</span>                          <span class="col-xs-12 col-sm-8">180</span>                          <span class="r_title hidden-xs col-sm-4">Peso:</span>                          <span class="col-xs-12 col-sm-8">76</span>                      </div>                  </div>              </div>          </div>      </div>  </div><div class="record_item col-xs-12 col-sm-6" name="20">      <div class="box">          <div class="record_left">              <img src="http://localhost/denis/resources/images/avatars/user_man.png" class="avatar big">          </div>          <div class="record_right">              <div class="row">                  <div class=" col-xs-12 col-md-8">                      <div class="row">                          <span class="r_title col-xs-4 col-md-3">Nombre:</span>                          <span class="col-xs-8 col-md-9 dots">Juan</span>                          <span class="r_title col-xs-4 col-md-3">Apellidos:</span>                          <span class="col-xs-8 col-md-9 dots">Perez Lopez</span>                          <span class="r_title col-xs-4 col-md-3">Historial:</span>                          <span class="col-xs-8 col-md-9 dots">123456789</span>                          <span class="r_title col-xs-4 col-md-3">DNI:</span>                          <span class="col-xs-8 col-md-9">111111111A</span>                      </div>                  </div>                  <div class="hidden-xs hidden-sm col-md-4">                      <div class="row">                          <span class="r_title hidden-xs col-sm-4">Edad:</span>                          <span class="col-xs-12 col-sm-8">31</span>                          <span class="r_title hidden-xs col-sm-4">Sexo:</span>                          <span class="col-xs-12 col-sm-8">male</span>                          <span class="r_title hidden-xs col-sm-4">Altura:</span>                          <span class="col-xs-12 col-sm-8">172</span>                          <span class="r_title hidden-xs col-sm-4">Peso:</span>                          <span class="col-xs-12 col-sm-8">76</span>                      </div>                  </div>              </div>          </div>      </div>  </div><div class="record_item col-xs-12 col-sm-6" name="26">      <div class="box">          <div class="record_left">              <img src="http://localhost/denis/resources/images/avatars/user_man.png" class="avatar big">          </div>          <div class="record_right">              <div class="row">                  <div class=" col-xs-12 col-md-8">                      <div class="row">                          <span class="r_title col-xs-4 col-md-3">Nombre:</span>                          <span class="col-xs-8 col-md-9 dots">Daniel</span>                          <span class="r_title col-xs-4 col-md-3">Apellidos:</span>                          <span class="col-xs-8 col-md-9 dots">Perez Martin</span>                          <span class="r_title col-xs-4 col-md-3">Historial:</span>                          <span class="col-xs-8 col-md-9 dots">1318020427</span>                          <span class="r_title col-xs-4 col-md-3">DNI:</span>                          <span class="col-xs-8 col-md-9">000000A</span>                      </div>                  </div>                  <div class="hidden-xs hidden-sm col-md-4">                      <div class="row">                          <span class="r_title hidden-xs col-sm-4">Edad:</span>                          <span class="col-xs-12 col-sm-8">40</span>                          <span class="r_title hidden-xs col-sm-4">Sexo:</span>                          <span class="col-xs-12 col-sm-8">male</span>                          <span class="r_title hidden-xs col-sm-4">Altura:</span>                          <span class="col-xs-12 col-sm-8">180</span>                          <span class="r_title hidden-xs col-sm-4">Peso:</span>                          <span class="col-xs-12 col-sm-8">80</span>                      </div>                  </div>              </div>          </div>      </div>  </div><div class="record_item col-xs-12 col-sm-6" name="6">      <div class="box">          <div class="record_left">              <img src="http://localhost/denis/resources/images/avatars/user_man.png" class="avatar big">          </div>          <div class="record_right">              <div class="row">                  <div class=" col-xs-12 col-md-8">                      <div class="row">                          <span class="r_title col-xs-4 col-md-3">Nombre:</span>                          <span class="col-xs-8 col-md-9 dots">Pedro</span>                          <span class="r_title col-xs-4 col-md-3">Apellidos:</span>                          <span class="col-xs-8 col-md-9 dots">Rodriguez Cano</span>                          <span class="r_title col-xs-4 col-md-3">Historial:</span>                          <span class="col-xs-8 col-md-9 dots">5445300</span>                          <span class="r_title col-xs-4 col-md-3">DNI:</span>                          <span class="col-xs-8 col-md-9">paciente3</span>                      </div>                  </div>                  <div class="hidden-xs hidden-sm col-md-4">                      <div class="row">                          <span class="r_title hidden-xs col-sm-4">Edad:</span>                          <span class="col-xs-12 col-sm-8">54</span>                          <span class="r_title hidden-xs col-sm-4">Sexo:</span>                          <span class="col-xs-12 col-sm-8">male</span>                          <span class="r_title hidden-xs col-sm-4">Altura:</span>                          <span class="col-xs-12 col-sm-8">198</span>                          <span class="r_title hidden-xs col-sm-4">Peso:</span>                          <span class="col-xs-12 col-sm-8">110</span>                      </div>                  </div>              </div>          </div>      </div>  </div><div class="record_item col-xs-12 col-sm-6" name="5">      <div class="box">          <div class="record_left">              <img src="http://localhost/denis/resources/images/avatars/user_woman.png" class="avatar big">          </div>          <div class="record_right">              <div class="row">                  <div class=" col-xs-12 col-md-8">                      <div class="row">                          <span class="r_title col-xs-4 col-md-3">Nombre:</span>                          <span class="col-xs-8 col-md-9 dots">Laura</span>                          <span class="r_title col-xs-4 col-md-3">Apellidos:</span>                          <span class="col-xs-8 col-md-9 dots">Sanchez Sanz</span>                          <span class="r_title col-xs-4 col-md-3">Historial:</span>                          <span class="col-xs-8 col-md-9 dots">36843287</span>                          <span class="r_title col-xs-4 col-md-3">DNI:</span>                          <span class="col-xs-8 col-md-9">paciente2</span>                      </div>                  </div>                  <div class="hidden-xs hidden-sm col-md-4">                      <div class="row">                          <span class="r_title hidden-xs col-sm-4">Edad:</span>                          <span class="col-xs-12 col-sm-8">40</span>                          <span class="r_title hidden-xs col-sm-4">Sexo:</span>                          <span class="col-xs-12 col-sm-8">female</span>                          <span class="r_title hidden-xs col-sm-4">Altura:</span>                          <span class="col-xs-12 col-sm-8">159</span>                          <span class="r_title hidden-xs col-sm-4">Peso:</span>                          <span class="col-xs-12 col-sm-8">58</span>                      </div>                  </div>              </div>          </div>      </div>  </div></div>
        </div>
    </div> -->
@endsection