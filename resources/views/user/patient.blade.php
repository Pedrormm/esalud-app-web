@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Listado de pacientes</h4>
            </div>
            <!-- <div class="row center_elements">
                <div class="col-xs-11 col-md-10">
                    <input type="text" placeholder="Buscar por nombre, apellidos, historial o dni" name="searcher_patients" id="patient_search_filter">
                </div>
                <a class="col-xs-11 col-md-1 btn btn-primary bt-search inp_height color_white" id="patsearch">
                    <i class="fa fa-search"></i>Buscar
                </a>
            </div> -->
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead >
                    <tr class="text-center">
                        <th class="bg-primary">Apellidos, Nombre</th>
                        <th class="bg-primary">Nº Historial</th>
                        <th class="bg-primary">Dni</th>
                        <th class="bg-primary">Grupo sanguíneo</th>
                        <th class="bg-primary">Fecha de nacimiento</th>
                        <th class="bg-primary">Sexo</th>
                    </tr>
                  </thead>
                  <tbody>

                  @foreach($patients as $patient) 
                  
                    <tr class="text_left">
                        <td class="text_left">
                            @if ($patient->sex=="male")
                                <img class="avatar" src="{{ asset('images/avatars/user_man.PNG') }}" class="avatar big">                                                               
                            @endif
                            @if ($patient->sex=="female")
                                <img class="avatar" src="{{ asset('images/avatars/user_woman.PNG') }}" class="avatar big">                                                               
                            @endif
                            <span>{{ urldecode($patient->lastname).", ".urldecode($patient->name) }}</span>
                        </td>
                        <td>                        
                            <span>{{ $patient->historic }}</span>          
                        </td>
                        <td>
                            <span>{{ $patient->dni }}</span>          
                        </td>
                        <td>
                            <span>{{ $patient->blood }}</span>                    
                        </td>
                        <td>
                            <span>{{ $patient->birthdate }}</span>                    
                        </td>
                        <td>
                            <span>{{ $patient->sex }}</span>                   
                        </td>
                    </tr>

                    @endforeach


                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<script>
    $(document).ready(function() {  
        if (window.location.href != "{{url('user/patient')}}") {
            if(sessionStorage.getItem('search') !== '') {
                $('#patient_search_filter').val(sessionStorage.getItem('search'));
            }
        }
    });

    $('#patsearch').click(function(e) {        
        let nameSearch = $('#patient_search_filter').val();

        sessionStorage.setItem('search', nameSearch);

        location.href = "{{url('user/patient')}}" + "/" + nameSearch;
    });
</script>
    
@endsection