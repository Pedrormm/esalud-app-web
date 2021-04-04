@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Mi horario disponible</h4>
            </div>

            <div class="card-body" id="mainCardBody">
              <div class="hv-schedule">
                <div class='hv-header'>
                    <div></div>
                    <div>Lunes</div>
                    <div>Martes</div>
                    <div>Miércoles</div>
                    <div>Jueves</div>
                    <div>Viernes</div>
                    <div>Sábado</div>
                    <div>Domingo</div>
                </div>
                <div class="hv-hours"></div>
                {{-- <div class='hv-hours'>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>01:00 am</span></div>
                        <div class="hv-time-selection hv-time-selection-active"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>02:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                    <div class="hv-row">
                        <div class="hv-time-caption"><span>00:00 am</span></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                    </div>
                </div> --}}
            </div>

        </div>
        <!-- /.container-fluid -->

@endsection

@section('scriptsPropios')
    <script>

      var model;
      $.ajax(PublicURL + 'schedule/generateSchedule', {
          dataType: 'json',
          data: {},
          method:'post',
      }).done(function(res){
          model = res;
          console.log("RESPU",res);
      })
      .fail(function(xhr, st, err) {
          console.error("error in schedule/generateSchedule " + xhr, st, err);
      }); 

      function refresh(){
        fillSchedule(model);
      }
      fillSchedule(null);
      function fillSchedule(model){
        var hvHours = document.querySelector('.hv-hours');
        var minHour = 0;
        var maxHour = 23;
        var minDay = 1;
        var maxDay = 7;

        
        for(var hour = minHour; hour<=maxHour; hour++){
          var hourDiv =createTimeCaptionDiv(hour);
          for(var day = minDay; day<=maxDay; day++){
            createHourDiv(hourDiv,hour);
          }
        }

        /*for(var i= 0; i<model.length;i++)
        {
          var hour = model[i];
          updateHourDiv(hour)
        }   */     


        
      }

      function createTimeCaptionDiv(hour){
        var hvHours = document.querySelector('.hv-hours');
        var hourDiv = document.createElement('div');
        hourDiv.classList.add('hv-row');
        var timeCaptionDiv  = document.createElement('div');
        timeCaptionDiv.classList.add('hv-time-caption');
        var timeCaptionSpan = document.createElement('span');
        timeCaptionSpan.innerText = hour + ':00';
        timeCaptionDiv.appendChild(timeCaptionSpan);
        hourDiv.appendChild(timeCaptionDiv);
        hvHours.appendChild(hourDiv);
        return hourDiv;
      }

      function createHourDiv(hourDiv,hour){
        var selectionDiv  = document.createElement('div');
        selectionDiv.classList.add('hv-time-selection');
        selectionDiv.addEventListener('click', function(){
          this.classList.add('hv-time-selection-active');
        })
        hourDiv.appendChild(selectionDiv);
      }
      
    </script>
@endsection