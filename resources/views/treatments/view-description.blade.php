  
  <form id="confirmChecked">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                @if ($hasDescription)
                                    <textarea disabled id="tDescription" value="{{ $description }}">{{ $description }}</textarea>   
                                @else
                                    <label id="labelDescription">
                                        {{ $description }}
                                    </label>   
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>

  <script>
    $('#saveModal').hide();
  </script>
  


