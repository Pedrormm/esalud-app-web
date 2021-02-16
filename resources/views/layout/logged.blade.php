@php header('Access-Control-Allow-Origin: *'); @endphp

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
        <div id="error-container" class="alert alert-danger dNone"></div>
        <div id="message-container" class="alert alert-success dNone"></div>
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveModal"><i class="fa fa-save"></i>&ensp;Save changes</button>
        </div>     
      </div>
    </div>
  
</div>

<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog"
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
         <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalConfirm">Close</button>
         <button type="submit" class="btn btn-primary" id="okConfirmModal"><i class="fa fa-save"></i>&ensp;Save changes</button>
       </div>     
     </div>
   </div>
</div>

<audio id="chat-sound" style="display: none">
  <source src="{{ asset('sounds/chat.mp3') }}" />
</audio>

@if(\Route::current()->uri != 'user/video-call') 
  @if (auth()->user()) 
  <script>
    window.user = {
      id: {{ (auth()->user()->id) }},
      dni: "{{ (auth()->user()->dni) }}"
    }

    window.csrfToken = "{{ csrf_token() }}";   
    window.allUsers = [];

    window.signalSent = "#";

  </script>

  
  </div>

  <script src="{{asset('js/app.js')}}" >
  </script>

  @endif
@endif


@include('inc.scripts')
@yield('scriptsPropios')
</body>
</html>
