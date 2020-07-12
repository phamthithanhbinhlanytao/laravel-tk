@extends('auth.master')
@section('auth_title')
    {{ trans('messages.auth.login') }}
@endsection
@section('auth_content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    @include('common.errors')
    {!! Form::open(['method' => 'post', 'route' => 'login.store',
        'class' => 'login100-form validate-form flex-sb flex-w']) !!}
        <span class="login100-form-title p-b-32">
            {{ trans('messages.auth.account_login') }}
        </span>
        <span class="txt1 p-b-11">
            Email
        </span>
        <div class="wrap-input100 validate-input m-b-36" data-validate = "{{ trans('messages.auth.require_email') }}">
            {!! Form::email('log_email', '', ['class' =>'input100']) !!}
            <span class="focus-input100"></span>
        </div>

        <span class="txt1 p-b-11">
            {{ trans('messages.auth.password') }}
        </span>
        <div class="wrap-input100 validate-input m-b-12" data-validate = "{{ trans('messages.auth.require_password') }}">
            <span class="btn-show-pass">
                <i class="fa fa-eye"></i>
            </span>
            {!!Form::password('log_password',['class' =>'input100']) !!}
            <span class="focus-input100"></span>
        </div>

        <div class="flex-sb-m w-full p-b-48">
            <div class="contact100-form-checkbox">
                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                <label class="label-checkbox100" for="ckb1">
                    {{ trans('messages.auth.remember_me') }}
                </label>
            </div>

            <div>
                <a href="#" class="txt3">
                    {{ trans('messages.auth.forgot_password') }}
                </a>
            </div>
        </div>
        <div class="container-login100-form-btn">
            {!! Form::submit(trans('messages.auth.login'), ['class' => 'login100-form-btn']) !!}
        </div>
    </form>
</div>
@endsection
