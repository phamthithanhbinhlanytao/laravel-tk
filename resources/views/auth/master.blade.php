<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ trans('messages.auth.login') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ Html::style(asset('/assets/css/bootstrap.min.css')) }}
    {{ Html::style(asset('/assets/vendor/bootstrap/css/bootstrap.min.css')) }}
    {{ Html::style(asset('/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')) }}
    {{ Html::style(asset('/assets/css/util.css')) }}
    {{ Html::style(asset('/assets/css/login.css')) }}
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            @yield('auth_content')
        </div>
    </div>
    <div id="dropDownSelect1"></div>

    {{ Html::script(asset('/assets/vendor/jquery/jquery-3.2.1.min.js')) }}
    {{ Html::script(asset('/assets/js/login.js')) }}
</body>
</html>
