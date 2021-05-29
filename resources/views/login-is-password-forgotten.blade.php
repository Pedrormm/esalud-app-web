
<div class="box request_password">
    <form id="rememberForgotten""method="post" action="{{ url('loginForgotten') }}">
        {{ csrf_field() }}

        <label>@lang('messages.Should you have forgotten your password enter your dni or email to request a new one')</label> 
        <input type="text" name="rem_password" class="form-control form-control-lg" value="" placeholder="DNI o email">
    </form>
</div>