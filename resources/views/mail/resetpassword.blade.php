
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.headPass')
<body id="page-top">

<main class="login">
    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="box access_login">
            <h3>@lang('messages.password_reset')</h3>
            <form method="post" action="{{ url('/passwordChanged') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <label>@lang('messages.enter_the_new_password')
                    <input type="password" name="password" autocomplete="on" placeholder="@lang('messages.password_stat')" id="password"/>
                </label>
                <label>@lang('messages.repeat_the_new_password')
                    <input type="password" name="password_confirmation" autocomplete="on" id="password_confirmation" placeholder="@lang('messages.password_stat')"/>
                <span id='message'></span><br/>
                <span id='messageLength'></span><br/>
                <span id='messageValidity'></span>
                </label>
                <button type="submit" class="button green" type="submit">@lang('messages.save_stat')</button>
            </form>
        </div>
        </div>
    </div>
</main>

<div id="debug" style="display:none"></div>

@include('inc.jsDeclaration')
@include('inc.jsGlobalsDefinition')
@include('inc.jsCustomScripts')

@include('inc.scripts')
<script>
    let regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\W]).{6,}$/;

    $('#password, #password_confirmation').on('keyup', function () {
    if ($('#password').val() == $('#password_confirmation').val()) {
        $('#message').html(_messagesLocalization.passwords_match).css('color', 'green');
        if ($('#password').val().length < 6) {
            $('#messageLength').show();
            $('#messageLength').html(_messagesLocalization.the_password_must_be_at_least_6_characters_long).css('color', 'blue');
        }
        else{
            $('#messageLength').html('');
            $('#messageLength').hide();
        }
        if (!regex.test($('#password').val())) {
            $('#messageValidity').show();
            $('#messageValidity').html(_messagesLocalization.the_password_must_contain_at_least_one_number_lowercase_uppercase_special_character).css('color', 'purple');
        }
        else{
            $('#messageValidity').html('');
            $('#messageValidity').hide();
        }
    } else 
        $('#message').html(_messagesLocalization.passwords_do_not_match).css('color', 'red');
    });

</script>
</body>

</html>