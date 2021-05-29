<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
<body>
    @include('inc.audio')
    @include('inc.header')

    @yield('nav-bar-top')
    @include('inc.nav-main')
    <main>
        @yield('content')
    </main>
    <div id="debug" style="display:none"></div>
    <div class="modal fade" tabindex="-1" role="dialog">
  <div id="generic-modal" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close!</button>
        <button type="button" class="btn btn-primary">Save changes!</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>
