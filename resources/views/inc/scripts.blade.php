@if(\Route::current()->uri != 'videoCall') 
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

<script>
    document.ready = function(e) {
        $.ajaxsetup({
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // datatable default extensions
        // @link https://datatables.net/reference/option/%24.fn.datatable.ext.errmode
        $.fn.datatable.ext.errmode = 'throw';
        // @link https://datatables.net/forums/discussion/34131/can-i-change-number-of-pagination-buttons
        $.fn.datatable.ext.pager.numbers_length = 12;
        // @link http://live.datatables.net/fumojapu/1/edit
        // if(typeof _urlDtLang == 'string') {
        //     $.extend($.fn.datatable.defaults, {
        //         language: {url: _urlDtLang}
        //     });
        // }
    }
    @auth
        asyncCall('appointment/icon', '#alertsDropdown', true);
        asyncCall('appointment/summary', '#top-navigator-appointments', true, false);
        asyncCall('messaging/icon', '#messagesDropdown', true);
        //  $('#messagesDropdown').click();
        asyncCall('messaging/summary', '#top-navigator-messages', true, false);
    @endauth
    @if($errors->any())
        showInlineError(0, "{{ implode(', ', $errors->all()) }}", 20);
    @endif

    @if(session('js_code'))
        {!! session('js_code') !!}
    @endif
    @isset ($js_code))
        {!! $js_code !!}
    @endisset

    @if(isset($okMessage))
        showInlineMessage("{{ $okMessage }}", 30);
    @endif  

    {{-- Code for nav-main.blade.php --}}
    if (screen.width >= 1024){
        @if((Request::is('users/create','users*','patients*','staff*')))
            $('#collapseUserManagement').collapse('show');
        @elseif ((Request::is('messaging*','videoCall*')))
            $('#collapseCommunication').collapse('show');
        @elseif ((Request::is('schedule*')))
            $('#collapseSchedule').collapse('show');
        @elseif ((Request::is('appointment*')))
            $('#collapseAppoinment').collapse('show');
        @endif
    }
    else{
        $(".sidebar").toggleClass("toggled");
        $('#mainCardShadow').removeClass(['card','shadow']);
    }
    
    @if (!Request::is('videoCallContainer*'))

        // Dictionaries from the OpenSource site www.oxygenxml.com/spell_checking.html and the repository https://github.com/wooorm/dictionaries
        
        let _dictionary = null;
        @auth
            @if (auth()->user()->has_spelling_checker)
                @if (auth()->user()->has_spelling_checker == 1)
                    switch(_lang){
                        case "es":
                            _dictionary = new Typo("es_ES", false, false, { dictionaryPath: "{{ asset('js/typo/dictionaries')}}" });
                            break;
                        case "en":
                            _dictionary = new Typo("en_US", false, false, { dictionaryPath: "{{ asset('js/typo/dictionaries')}}" });
                            break;
                        case "it":
                            // _dictionary = new Typo("it_IT", false, false, { dictionaryPath: "{{ asset('js/typo/dictionaries')}}" });
                            _dictionary = null;
                            break;
                        case "pt":
                            _dictionary = null;
                            break;
                        case "fr":
                            _dictionary = new Typo("fr_FR", false, false, { dictionaryPath: "{{ asset('js/typo/dictionaries')}}" });
                            break;
                        case "ro":
                            _dictionary = null;
                            break;
                        case "de":
                            _dictionary = new Typo("de_DE", false, false, { dictionaryPath: "{{ asset('js/typo/dictionaries')}}" });
                            break;
                        case "ar":
                            _dictionary = null;
                            break;
                        case "ru":
                            _dictionary = null;
                            break;     
                        case "zh_CN":
                            _dictionary = null;
                            break;
                        case "ja":
                            _dictionary = null;
                            break; 
                        default:
                            _dictionary = null;
                            break;
                    }
                @endif
            @endif
        @endauth

    @endif  

    @if(Request::is('user/create') || Request::is('user/newUser'))
        $('#navSubitemCreateNewUser').css('background-color', '#eaecf4');
        $('#navSubitemCreateNewUser').addClass('active');
    @elseif(Request::is('users*'))
        $('#navSubitemShowUsers').css('background-color', '#eaecf4');
        $('#navSubitemShowUsers').addClass('active');
    @elseif(Request::is('patients*'))
        $('#navSubitemPatientManagement').css('background-color', '#eaecf4');
        $('#navSubitemPatientManagement').addClass('active');
    @elseif(Request::is('staff*'))
        $('#navSubitemStaffManagement').css('background-color', '#eaecf4');
        $('#navSubitemStaffManagement').addClass('active');
    @endif

    @if(Request::is('messaging'))
        $('#navSubitemMessaging').css('background-color', '#eaecf4');
        $('#navSubitemMessaging').addClass('active');
    @elseif(Request::is('videoCall'))
        $('#navSubitemVideocall').css('background-color', '#eaecf4');
        $('#navSubitemVideocall').addClass('active');
    @endif

    @if(Request::is('schedule'))
        $('#navSubItemMySchedule').css('background-color', '#eaecf4');
        $('#navSubItemMySchedule').addClass('active');
    @elseif(Request::is('schedule/staff*'))
        $('#navSubItemAllSchedules').css('background-color', '#eaecf4');
        $('#navSubItemAllSchedules').addClass('active');
    @endif

    @if(Request::is('appointment/listPending*'))
        $('#navSubitemPendingAppointments').css('background-color', '#eaecf4');
        $('#navSubitemPendingAppointments').addClass('active');
    @elseif(Request::is('appointment/listAccepted*'))
        $('#navSubitemAcceptedAppointments').css('background-color', '#eaecf4');
        $('#navSubitemAcceptedAppointments').addClass('active');
    @elseif(Request::is('appointment/listRejected*'))
        $('#navSubitemRejectedAppointments').css('background-color', '#eaecf4');
        $('#navSubitemRejectedAppointments').addClass('active');
    @elseif(Request::is('appointment'))
        $('#navSubitemShowAppointments').css('background-color', '#eaecf4');
        $('#navSubitemShowAppointments').addClass('active');
    @elseif(Request::is('appointment/listOld*'))
        $('#navSubitemOldAppointments').css('background-color', '#eaecf4');
        $('#navSubitemOldAppointments').addClass('active');
    @elseif(Request::is('appointment/create*'))
        $('#navSubitemCreateAppointment').css('background-color', '#eaecf4');
        $('#navSubitemCreateAppointment').addClass('active');
    @elseif(Request::is('appointment/calendar*'))
        $('#navSubitemAppointmentCalendar').css('background-color', '#eaecf4');
        $('#navSubitemAppointmentCalendar').addClass('active');
    @endif
    
</script>

