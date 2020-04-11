<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  @include('inc.nav-main')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      @include('inc.header')

      @yield('nav-bar-top')
      <div id="error-container" style="display:none" class="alert alert-danger"></div>
      <div id="message-container" style="display:none" class="alert alert-success"></div>
      @yield('content')


      </div>
      <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->




    

<div id="debug" style="display:none"></div>
<div class="modal fade" id="generic-modal" tabindex="-1" role="dialog"
 aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div id="generic-modalheader">
          <div id="head-modal" class="modal-header">
            <h4 class="modal-title"></h4>
            <div class="modalWindowButtons">
              <button type="button" class="close icon_close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <button class="close modalCollapse" style="display:none"> 
                <span aria-hidden="true"><i class="fa fa-caret-square-down"></i></span>
              </button>
              <button class="close modalMinimize"> 
                <span aria-hidden="true"><i class='fa fa-minus'></i> </span>
              </button>
            </div>
          </div>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveModal"><i class="fa fa-save"></i>&ensp;Save changes</button>
        </div>     
      </div>
    </div>
  
</div>

            

@include('inc.scripts')

</body>
</html>
