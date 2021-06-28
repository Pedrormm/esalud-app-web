
<div class="box request_password">
    <form id="rememberForgotten" method="post" action="{{ url('loginForgotten') }}">
        {{ csrf_field() }}

        <label>@lang('messages.should_you_have_forgotten_your_password_enter_your_DNI_or_email_to_request_a_new_one')</label> 
        <input type="text" name="rem_password" class="form-control form-control-lg" value="" placeholder="@lang('messages.DNI_or_email')">
    </form>
</div>