@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Historiales médicos</div>
    </nav>
@endsection

@section('content')

   <!-- <span class="col-xs-8 col-md-9">{{ $id }}</span> -->

   <div class="tabs">
        <div class="tab" name="Historial Médico">
            <div class="hv-record row">
                <br><font size="1">

                <div class="col-xs-12" style="padding: 0">
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="box record-basic_info">
                                <h5 class="header_box"><i class="fa fa-user"></i>Paciente</h5>
                                <div>
                                    <table class="user_info">
                                        <tbody><tr>
                                            <td>Nombre:</td>
                                            <td>Marcos</td>
                                        </tr>
                                        <tr>
                                            <td>Apellidos:</td>
                                            <td>Llana Sanchez</td>
                                        </tr>
                                        <tr>
                                            <td>NºHistorial:</td>
                                            <td>4565454</td>
                                        </tr>
                                        <tr>
                                            <td>DNI:</td>
                                            <td>47255641L</td>
                                        </tr>
                                        <tr>
                                            <td>F.Nacimiento:</td>
                                            <td>1988-01-05 ( 32 años)</td>
                                        </tr>
                                        <tr>
                                            <td>Sexo:</td>
                                            <td>Masculino</td>
                                        </tr>
                                        <tr>
                                            <td>Altura:</td>
                                            <td>178 cm</td>
                                        </tr>
                                        <tr>
                                            <td>Peso:</td>
                                            <td>86 kg</td>
                                        </tr>
                                        <tr>
                                            <td>G.Sanguineo:</td>
                                            <td>A+</td>
                                        </tr>
                                    </tbody></table>
                                                                            <div class="row">
                                            <div class="col-xs-4">                                                    <a class="btn btn-default bt-create-event"><i class="fa fa-calendar"></i>Cita</a>                                            </div>
                                            <div class="col-xs-4">                                                    <a class="btn btn-default bt-send-message"><i class="fa fa-comments-o"></i>Chat</a>                                            </div>
                                            <div class="col-xs-4">
                                                <a class="btn btn-default bt-open-alerts"><i class="fa fa-warning"></i>Alertas</a>
                                            </div>
                                        </div>                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <div class="box record-reports" name="alerts">
                                <h5 class="header_box"><i class="fa fa-file-text-o"></i>Informe evolutivo</h5>
                                <div class="flip_content">
                                    <div class="historic_report"><div class="historic_report_text">
                            <div class="report_header">
                                <i class="fa fa-angle-right"></i><b>2014-05-02</b> Urgencia revision medica
                            </div>
                        <div class="report_doctor">
                            <span>Datos:</span>
                            <div>
                                Doctor: Juan Chacon Perez
                            </div>
                        </div>
                        <div class="report_body">
                            <span>Informe:</span>
                            <div>Apertura del expediente de Oliver Pata, se presenta con sistomas de defensas bajas , se solicitan analiticas para evaluar su estado.

                            </div>
                        </div>
                    </div><div class="historic_report_text">
                            <div class="report_header">
                                <i class="fa fa-angle-right"></i><b>2014-05-06</b> Revision
                            </div>
                        <div class="report_doctor">
                            <span>Datos:</span>
                            <div>
                                Doctor: Juan Chacon Perez
                            </div>
                        </div>
                        <div class="report_body">
                            <span>Informe:</span>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis massa commodo, bibendum magna sit amet, porttitor tortor. In hac habitasse platea dictumst. Aliquam eros lectus, volutpat ac massa at, consectetur ultrices quam. Pellentesque vel neque tincidunt justo gravida volutpat. Suspendisse at lectus vestibulum, condimentum augue a, lacinia odio. Maecenas at pharetra ante. Pellentesque ipsum urna, auctor in sodales eu, vulputate vitae nisi. Cras vel ligula quam. Mauris ornare pulvinar augue, vitae aliquet ante rutrum sed. Nam id placerat lectus. Vestibulum eleifend suscipit diam id viverra. Integer quis quam tortor. Morbi in lectus sollicitudin, tempor diam vitae, sollicitudin turpis.

Etiam scelerisque semper quam, et ullamcorper nibh ullamcorper id. Curabitur molestie, lacus ut scelerisque feugiat, sem enim ultricies enim, quis consequat nunc erat at est. Aliquam ac erat sollicitudin, euismod nisl sit amet, varius quam. Donec volutpat nisl id magna rhoncus, id gravida augue vehicula. Phasellus nec dui purus. Sed ultricies elit sit amet mi pulvinar, ac iaculis dolor lobortis. Donec quis nisi risus.

Nam molestie quam ut dui auctor, a volutpat metus ultricies. Fusce porta, urna ut ultricies pretium, neque nulla malesuada neque, eget pulvinar nibh odio eu nisi. Proin condimentum a nisi convallis viverra. Mauris vehicula sollicitudin velit, vitae placerat orci cursus eget. Nunc ut purus lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed at scelerisque nunc, eu ultricies felis. Suspendisse dapibus erat ac orci cursus condimentum. Integer dapibus consequat ante. Fusce vel ante eget ante varius ultrices id vitae ligula. Morbi varius dolor eu orci bibendum ullamcorper.

Cras vitae gravida dui, eget porttitor est. Sed scelerisque fringilla odio, non varius nibh fringilla non. Integer eget dictum nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed diam mauris, adipiscing a placerat at, laoreet ut purus. Nulla sollicitudin, mauris quis eleifend dictum, lectus dui commodo mauris, nec mollis lectus ipsum vitae tellus. Suspendisse sit amet porta ante. Phasellus vehicula nibh commodo, sodales dui ut, laoreet purus. Nunc aliquam imperdiet nulla, ut placerat odio mattis viverra. Cras ante neque, euismod vel dignissim dictum, mollis pellentesque ipsum. Morbi euismod felis ut magna ullamcorper, ut pretium arcu molestie. Integer at nibh sed tellus rutrum consectetur eget cursus turpis.
                            </div>
                        </div>
                    </div><div class="historic_report_text">
                            <div class="report_header">
                                <i class="fa fa-angle-right"></i><b>2014-06-27</b> test
                            </div>
                        <div class="report_doctor">
                            <span>Datos:</span>
                            <div>
                                Doctor: Juan Chacon Perez
                            </div>
                        </div>
                        <div class="report_body">
                            <span>Informe:</span>
                            <div>Este es el nuevo informe de la consulta
                            </div>
                        </div>
                    </div><div class="historic_report_text">
                            <div class="report_header">
                                <i class="fa fa-angle-right"></i><b>2014-06-27</b> Evaluacion del estado
                            </div>
                        <div class="report_doctor">
                            <span>Datos:</span>
                            <div>
                                Doctor: Juan Chacon Perez
                            </div>
                        </div>
                        <div class="report_body">
                            <span>Informe:</span>
                            <div>
                            </div>
                        </div>
                    </div><div class="historic_report_text">
                            <div class="report_header">
                                <i class="fa fa-angle-right"></i><b>2014-06-27</b> Pruebas
                            </div>
                        <div class="report_doctor">
                            <span>Datos:</span>
                            <div>
                                Doctor: Juan Chacon Perez
                            </div>
                        </div>
                        <div class="report_body">
                            <span>Informe:</span>
                            <div>
                            </div>
                        </div>
                    </div><div class="historic_report_text">
                            <div class="report_header">
                                <i class="fa fa-angle-right"></i><b>2014-06-27</b> Evaluacion estado
                            </div>
                        <div class="report_doctor">
                            <span>Datos:</span>
                            <div>
                                Doctor: Juan Chacon Perez
                            </div>
                        </div>
                        <div class="report_body">
                            <span>Informe:</span>
                            <div>test
                            </div>
                        </div>
                    </div>                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box flip" name="analytics">
                        <div class="flip_f">
                            <h5 class="header_box"><i class="fa fa-flask"></i>Analiticas<label class="header_action"><i class="fa fa-pencil"></i>Editar</label></h5>
                            <div class="flip_content">
                                
<div class="row analytics">
    <div class="col-xs-12 col-sm-6">
        <span class="analytic_header">Subpoblaciones Linfocitarias</span>
        <div class="wp_table">
            <table name="1">
                <tbody><tr>
                    <th>Fecha</th>                        <th>Linf</th>                        <th>%T4</th>                        <th>T4 Abs</th>                        <th>%T8</th>                        <th>T8 Abs</th>                </tr>                        <tr name="10">
                            <td width="125">
                                2014-05-25 23:16                            </td>                                <td>
                                    22                                </td>                                <td>
                                    118                                </td>                                <td>
                                    22                                </td>                                <td>
                                    78                                </td>                                <td>
                                    55                                </td>                        </tr>                        <tr name="13">
                            <td width="125">
                                2014-05-11 00:00                            </td>                                <td>
                                    1                                </td>                                <td>
                                    2                                </td>                                <td>
                                    3                                </td>                                <td>
                                    4                                </td>                                <td>
                                    5                                </td>                        </tr>                        <tr name="15">
                            <td width="125">
                                2014-05-05 23:16                            </td>                                <td>
                                    8                                </td>                                <td>
                                    44                                </td>                                <td>
                                    55                                </td>                                <td>
                                    22                                </td>                                <td>
                                    11                                </td>                        </tr>            </tbody></table>
        </div>    </div>
    <div class="col-xs-12 col-sm-6">
        <span class="analytic_header">Cargas Virales</span>
        <div class="wp_table">
            <table name="2">
                <tbody><tr>
                    <th>Fecha</th>                        <th>Carga</th>                        <th>Dif</th>                        <th>Log</th>                </tr>                        <tr name="3">
                            <td width="125">
                                2014-03-01 11:00                            </td>                                <td>
                                    900                                </td>                                <td>
                                    99.3689                                </td>                                <td>
                                    23.55                                </td>                        </tr>                        <tr name="9">
                            <td width="125">
                                2014-03-01 10:00                            </td>                                <td>
                                    12                                </td>                                <td>
                                    44                                </td>                                <td>
                                    8745                                </td>                        </tr>                        <tr name="11">
                            <td width="125">
                                2014-03-01 10:00                            </td>                                <td>
                                    55                                </td>                                <td>
                                    44                                </td>                                <td>
                                    11                                </td>                        </tr>                        <tr name="12">
                            <td width="125">
                                2014-03-01 10:00                            </td>                                <td>
                                    1                                </td>                                <td>
                                    2                                </td>                                <td>
                                    3                                </td>                        </tr>                        <tr name="8">
                            <td width="125">
                                2014-03-01 08:00                            </td>                                <td>
                                    55                                </td>                                <td>
                                    115                                </td>                                <td>
                                    0.15                                </td>                        </tr>            </tbody></table>
        </div>    </div>
</div>                            </div>
                        </div>
                        <div class="flip_b">
                            <h5 class="header_box"><i class="fa fa-flask"></i>Edición de Analiticas<label class="header_action"><i class="fa fa-arrow-left"></i>Volver</label></h5>
                            <div class="flip_content">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="box flip" name="medicines">
                                <div class="flip_f">
                                    <h5 class="header_box"><i class="fa fa-medkit"></i>Tratamientos<label class="header_action"><i class="fa fa-pencil"></i>Editar</label></h5>
                                    <div class="flip_content">
<div class="row patients_list_header">
    <div class="col-xs-7 col-sm-4 col-lg-3"><h5>Nombre</h5></div>
    <div class="col-xs-5 col-sm-2 col-lg-2"><h5>Inicio</h5></div>
    <div class="hidden-xs col-sm-4 col-lg-4"><h5>Estado</h5></div>
    <div class="hidden-xs col-sm-2 col-lg-3"><h5>Dosis</h5></div>
</div>
<ul class="medicines_list">        <li name="16">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Lopinavir / Ritonavir</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-08-15</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">1 cada 1 mes/es</div>
            </div>
        </li>        <li name="15">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Carbopol 974P </div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-07-06</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">5 cada 2 semana/s</div>
            </div>
        </li>        <li name="11">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Ciprofloxacina</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-07-01</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Finalizado (2014-06-27)</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">1 cada 8 hora/s</div>
            </div>
        </li>        <li name="12">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Reyataz</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-06-24</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">2 cada 1 semana/s</div>
            </div>
        </li>        <li name="13">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Dapivirina</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-06-24</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">4 cada 1 dia/s</div>
            </div>
        </li>        <li name="1">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Atazanavir</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-05-01</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Finalizado (2014-06-23)</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">1 cada 24 hora/s</div>
            </div>
        </li></ul>                                    </div>
                                </div>
                                <div class="flip_b">
                                    <h5 class="header_box">
                                        <span class="header_title dots"><i class="fa fa-medkit"></i>Edición de Tratamientos</span>
                                        <label class="header_action"><i class="fa fa-arrow-left"></i>Volver</label>
                                    </h5>
                                    <div class="flip_content">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="box flip" name="protocols">
                                <div class="flip_f">
                                    <h5 class="header_box"><i class="fa fa-legal"></i>Protocolos <label class="header_action"><i class="fa fa-pencil"></i>Editar</label></h5>
                                    <div class="flip_content">
                                        
<div class="row list_header">
    <div class="col-xs-7 col-sm-6"><h5>Nombre</h5></div>
    <div class="col-xs-5 hidden-sm hidden-md hidden-lg"><h5>Estado</h5></div>
    <div class="hidden-xs col-sm-3"><h5>Inicio</h5></div>
    <div class="hidden-xs col-sm-3"><h5>Fin</h5></div>
</div><ul class="protocol_list">        <li>
            <div class="row">
                <div class="col-xs-7 col-sm-6 dots">fin</div>
                <div class="col-xs-5 hidden-sm hidden-md hidden-lg dots">Pasado</div>
                <div class="hidden-xs col-sm-3 dots">2014-06-27</div>
                <div class="hidden-xs col-sm-3 dots">2014-07-04</div>
            </div>
        </li>        <li>
            <div class="row">
                <div class="col-xs-7 col-sm-6 dots">Fase inicial</div>
                <div class="col-xs-5 hidden-sm hidden-md hidden-lg dots">Pasado</div>
                <div class="hidden-xs col-sm-3 dots">2014-05-31</div>
                <div class="hidden-xs col-sm-3 dots">2014-06-15</div>
            </div>
        </li>        <li>
            <div class="row">
                <div class="col-xs-7 col-sm-6 dots">Inicio Tratamiento</div>
                <div class="col-xs-5 hidden-sm hidden-md hidden-lg dots">Pasado</div>
                <div class="hidden-xs col-sm-3 dots">2014-05-08</div>
                <div class="hidden-xs col-sm-3 dots">2014-05-29</div>
            </div>
        </li></ul>                                    </div>
                                </div>
                                <div class="flip_b">
                                    <h5 class="header_box">
                                        <span class="header_title dots"><i class="fa fa-legal"></i>Edición de Protocolos</span>
                                        <label class="header_action"><i class="fa fa-arrow-left"></i>Volver</label>
                                    </h5>
                                    <div class="flip_content">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            </div>    </div>

@endsection