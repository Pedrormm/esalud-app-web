<link rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/roleEdit.css') }}">  
  
  <form action="{{ URL::asset('/user/roleManagement/update')  }}" method="POST" id="newRole">
    {{ csrf_field() }}
    {{-- {{ dd($permissions) }} --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="firstName">Nombre del rol</label>
                                <input id="name" name="name" class="form-control" type="text" 
                                placeholder="Introuzca el nombre del rol">
                                <div  class="invalid-feedback">
                                    <div>
                                        El Nombre del rol es requerido
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="bulgy-radios" role="radiogroup" aria-labelledby="bulgy-radios-label">
                            <table class="table table-stripped table-bordered table-hover table-sm w-auto tabla_permisos_roles text-center">
                            <caption>Permisos asociados al rol</caption>
                            <thead>
                                <th>Módulo</th>
                                <th>Lectura</th>
                                <th>Lectura y escritura</th>
                                <th>Sin permisos</th>
                            </thead>
                            <tbody class="text-center">                                          
                                <tr>
                                @if(count($permissions)>0)
                                    @foreach ($permissions as $permission)

                                        <tr>
                                        <td>{{ $permission['flag_meaning'] }}</td>
                                        <td>
                                            <label class="posRButton">
                                            <input type="radio" name="optradio{{ $permission['id'] }}" style="display:none"
                                             value="1"/>
                                            <span class="radio"></span>
                                            <span class="label"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="posRButton">
                                            <input type="radio" name="optradio{{ $permission['id'] }}" style="display:none"
                                             value="2"/>
                                            <span class="radio"></span>
                                            <span class="label"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="posRButton">
                                            <input type="radio" name="optradio{{ $permission['id'] }}" style="display:none"
                                             checked value="0"/>
                                            <span class="radio"></span>
                                            <span class="label"></span>
                                            </label>
                                        </td>
                                        </tr>
                                    @endforeach
                                @else
                                <td colspan="4">No hay permisos seleccionados...</td>
                                @endif                           
                                </tr>
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  </form>
  
 <script type="text/javascript" src="{{ asset('js/new-role.js') . '?r=' . rand() }}"></script>





 {{-- <script type="text/javascript" src="{{ asset('js/typo/typo.js') }}"></script>

 <script type="text/javascript">
    var dictionary;
    
    function load() {
        $( '#loading-progress' ).append( 'Loading affix data...' ).append( $( '<br />' ) );
        
        // $.get( 'js/typo/dictionaries/en_US/en_US.aff', function ( affData ) {
        $.get( 'http://localhost/esalud-app-web/public/js/typo/dictionaries/en_US/en_US.aff', function ( affData ) {      
        // $.get( "{{ asset('js/typo/dictionaries/en_US/en_US.aff') }}", function ( affData ) {

            $( '#loading-progress' ).append( 'Loading English dictionary (this takes a few seconds)...' ).append( $( '<br />' ) );
            
            // $.get( 'js/typo/dictionaries/en_US/en_US.dic', function ( wordsData ) {
            $.get( 'http://localhost/esalud-app-web/public/js/typo/dictionaries/en_US/en_US.dic', function ( wordsData ) {

            // $.get( "{{ asset('js/typo/dictionaries/en_US/en_US.dic') }}", function ( wordsData ) {

                $( '#loading-progress' ).append( 'Initializing Typo...' );
        
                dictionary = new Typo( "en_US", affData, wordsData );
                
                checkWord( 'mispelled' );
            } );
        } );
    }
    
    function checkWord( word ) {
        var wordForm = $( '#word-form' );
        wordForm.hide();
        
        var resultsContainer = $( '#results' );
        resultsContainer.html( '' );
        
        resultsContainer.append( $( '<p>' ).text( "Is '" + word + "' spelled correctly?" ) );

        var is_spelled_correctly = dictionary.check( word );
        
        resultsContainer.append( $( '<p>' ).append( $( '<code>' ).text( is_spelled_correctly ? 'yes' : 'no' ) ) );
        
        if ( ! is_spelled_correctly ) {
            resultsContainer.append( $( '<p>' ).text( "Finding spelling suggestions for '" + word + "'..." ) );
            
            var array_of_suggestions = dictionary.suggest( word );

            resultsContainer.append( $( '<p>' ).append( $( '<code>' ).text( array_of_suggestions.join( ', ' ) ) ) );
        }
        
        wordForm.show();
    }
</script>
<div onload="load();">
    <h1>Typo.js Demo</h1>
    <p>This page is an example of how you could use <a href="http://github.com/cfinke/Typo.js">Typo.js</a> in a webpage if you need spellchecking beyond what the OS provides.</p>
    <p id="loading-progress"></p>
    <div id="results"></div>
    <form method="GET" action="" onsubmit="checkWord( document.getElementById( 'word' ).value ); return false;" id="word-form" style="display: none;">
        <p>Try another word:</p>
        <input type="text" id="word" value="mispelled" />
        <input type="submit" value="Spellcheck" />
    </form>
</div> --}}
