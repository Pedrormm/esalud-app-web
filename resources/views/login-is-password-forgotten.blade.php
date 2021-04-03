
<div class="box request_password">
    <form id="rememberForgotten""method="post" action="{{ url('loginForgotten') }}">
        {{ csrf_field() }}

        <label>Si has olvidado tu contraseña introduce tu DNI o email para solicitar una nueva</label> 
        <input type="text" name="rem_password" class="form-control form-control-lg" value="" placeholder="DNI o email">
    </form>
</div>