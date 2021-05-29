@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary text-center">Listado de pacientes</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="mainTablePatients" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">@lang('messages.surname, name')</th>
                    <th class="bg-primary">@lang('messages.Historical')</th>
                    <th class="bg-primary">Altura</th>
                    <th class="bg-primary">Peso</th>
                    <th class="bg-primary">Dni</th>
                    <th class="bg-primary">@lang('messages.blood group')</th>
                    <th class="bg-primary">@lang('messages.date of birth')</th>
                    <th class="bg-primary">@lang('messages.Phone number')</th>
                    <th class="bg-primary">@lang('messages.gender')</th>
                    <th class="bg-primary">@lang('messages.actions')</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

      {{-- </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a> --}}

{{-- <script>
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
</script> --}}
    
@endsection


@section('viewsScripts')
  @include('patients.patients-index')
@endsection