@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Historial Médico</div>
    </nav>
@endsection

@section('content')


<div class="tabs">            
<div class="tab" name="Historial Médico">            
<div class="hv-record row">
                <br>
<font size="1">
	<table class="xdebug-error xe-deprecated" dir="ltr" border="1" cellspacing="0" cellpadding="1">
		<tbody>
			<tr><th align="left" bgcolor="#f57900" colspan="5"><span style="background-color: #cc0000; color: #fce94f; font-size: x-large;">( ! )</span> Deprecated: Function create_function() is deprecated in C:\laragon\www\denis\services\records\view\warnings.php on line <i>20</i></th></tr>
			<tr><th align="left" bgcolor="#e9b96e" colspan="5">Call Stack</th></tr>
			<tr><th align="center" bgcolor="#eeeeec">#</th><th align="left" bgcolor="#eeeeec">Time</th><th align="left" bgcolor="#eeeeec">Memory</th><th align="left" bgcolor="#eeeeec">Function</th><th align="left" bgcolor="#eeeeec">Location</th></tr>
			<tr><td bgcolor="#eeeeec" align="center">1</td><td bgcolor="#eeeeec" align="center">0.4042</td><td bgcolor="#eeeeec" align="right">439832</td><td bgcolor="#eeeeec">{main}(  )</td><td title="C:\laragon\www\denis\services\records\view\record.php" bgcolor="#eeeeec">...\record.php<b>:</b>0</td></tr>
			<tr><td bgcolor="#eeeeec" align="center">2</td><td bgcolor="#eeeeec" align="center">0.4405</td><td bgcolor="#eeeeec" align="right">1120632</td><td bgcolor="#eeeeec">require( <font color="#00bb00">'C:\laragon\www\denis\services\records\view\warnings.php'</font> )</td><td title="C:\laragon\www\denis\services\records\view\record.php" bgcolor="#eeeeec">...\record.php<b>:</b>39</td></tr>
		</tbody>
	</table>
</font>
                <div class="col-xs-12" style="padding: 0">
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="box record-basic_info">
                                <h5 class="header_box"><i class="fa fa-user"></i>Paciente</h5>
                                <div>
                                    <table class="user_info">
                                        <tbody><tr>
                                            <td>Nombre:</td>
                                            <td>Gloria</td>
                                        </tr>
                                        <tr>
                                            <td>Apellidos:</td>
                                            <td>Carter Gomez</td>
                                        </tr>
                                        <tr>
                                            <td>NºHistorial:</td>
                                            <td>111444555</td>
                                        </tr>
                                        <tr>
                                            <td>DNI:</td>
                                            <td>3684526R</td>
                                        </tr>
                                        <tr>
                                            <td>F.Nacimiento:</td>
                                            <td>1959-06-04 ( 60 años)</td>
                                        </tr>
                                        <tr>
                                            <td>Sexo:</td>
                                            <td>Femenino</td>
                                        </tr>
                                        <tr>
                                            <td>Altura:</td>
                                            <td>0 cm</td>
                                        </tr>
                                        <tr>
                                            <td>Peso:</td>
                                            <td>0 kg</td>
                                        </tr>
                                        <tr>
                                            <td>G.Sanguineo:</td>
                                            <td>A+</td>
                                        </tr>
                                    </tbody>
										</table>
                                            <div class="row">
                                            <div class="col-xs-4">
												<a class="btn btn-default bt-create-event"><i class="fa fa-calendar"></i>Cita</a>                                            </div>
                                            <div class="col-xs-4">                                                    <a class="btn btn-default bt-send-message"><i class="fa fa-comments-o"></i>Chat</a>                                            </div>
                                            <div class="col-xs-4">
                                                <a class="btn btn-default bt-open-alerts"><i class="fa fa-warning"></i>Alertas</a>
                                            </div>
                                        </div>
									</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <div class="box record-reports" name="alerts">
                                <h5 class="header_box"><i class="fa fa-file-text-o"></i>Informe evolutivo</h5>
                                <div class="flip_content">
                                    <div class="historic_report"><span class="empty_list">El paciente no tiene ningun informe</span>                                    </div>
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
                    <th>Fecha</th>                        <th>Linf</th>                        <th>%T4</th>                        <th>T4 Abs</th>                        <th>%T8</th>                        <th>T8 Abs</th>                </tr>                    <tr>
                        <td colspan="6" class="empty_list">- No tiene -</td>
                    </tr>            </tbody></table>
        </div>    </div>
    <div class="col-xs-12 col-sm-6">
        <span class="analytic_header">Cargas Virales</span>
        <div class="wp_table">
            <table name="2">
                <tbody><tr>
                    <th>Fecha</th>                        <th>Carga</th>                        <th>Dif</th>                        <th>Log</th>                </tr>                    <tr>
                        <td colspan="4" class="empty_list">- No tiene -</td>
                    </tr>            </tbody></table>
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
<ul class="medicines_list">        <li name="8">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Astodrímero</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-10-23</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">1 cada 8 hora/s</div>
            </div>
        </li>        <li name="7">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Boceprevir</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-08-01</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Finalizado (2014-06-23)</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">5 cada 2 mes/es</div>
            </div>
        </li>        <li name="9">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Anfotericina B</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-07-03</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">2 cada 6 hora/s</div>
            </div>
        </li>        <li name="6">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Clorhidrato de etambutol</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-07-01</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">4 cada 1 dia/s</div>
            </div>
        </li>        <li name="10">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">efavirenz/emtricitabina/tenofovir</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-06-01</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">1 cada 12 hora/s</div>
            </div>
        </li>        <li name="2">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Clotrimazol </div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-05-15</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Finalizado (2014-06-22)</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">4 cada 1 dia/s</div>
            </div>
        </li>        <li name="3">
            <div class="row">
                <div class="col-xs-7 col-sm-4 col-lg-3 dots">Aptivus</div>
                <div class="col-xs-5 col-sm-2 col-lg-2 dots">2014-03-03</div>
                <div class="hidden-xs col-sm-4 col-lg-4 dots">Activo</div>
                <div class="hidden-xs col-sm-2 col-lg-3 dots">3 cada 1 dia/s</div>
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
</div><ul class="protocol_list">        <li class="empty_list">- No tiene ninguno -</li></ul>                                    </div>
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