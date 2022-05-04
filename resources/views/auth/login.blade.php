@extends('index')
@section('body')
    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(assets/media/bg/bg-1.jpg);">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                                <img src="assets/media/logos/logo-mini-2-md.png">
                            </a>
                        </div>
                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Вход в систему</h3>
                            </div>
                            <form class="kt-form" action="{{route('login')}}" method="post" novalidate="novalidate" id="kt_login_form">
                                @csrf
                                <div class="input-group">
                                    <input autocomplete="off" type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('adminlte::adminlte.password') }}">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="row kt-login__extra">
                                    <div class="col">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="remember"> Запомнить меня
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col kt-align-right">
                                        <a href="/password/reset" id="kt_login_forgot" class="kt-link kt-login__link">Забыли пароль ?</a>
                                    </div>
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary">Войти</button>
                                </div>
                            </form>
                        </div>
                        <div class="kt-login__signup">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Регистрация</h3>
                                <div class="kt-login__desc">Введите данные для добавления нового аккаунта:</div>
                            </div>
                            <form class="kt-login__form kt-form" action="{{route('register')}}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}"
                                           placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <input autocomplete="off" type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
                                           placeholder="{{ __('adminlte::adminlte.email') }}">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                           placeholder="{{ __('adminlte::adminlte.password') }}">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                           placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_signup_submit" class="btn btn-pill kt-login__btn-primary">Регистрация</button>&nbsp;&nbsp;
                                    <button id="kt_login_signup_cancel" class="btn btn-pill kt-login__btn-secondary">Отмена</button>
                                </div>
                            </form>
                        </div>
                        <div class="kt-login__forgot">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Забыли пароль ?</h3>
                                <div class="kt-login__desc">Введите ваш email для восстановления пароля:</div>
                            </div>
                            <form class="kt-form" action="password/reset" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ Session::token() }}">
                                <div class="input-group">
                                    <input autocomplete="off" type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ trans('adminlte::adminlte.email') }}" autofocus>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ trans('adminlte::adminlte.password') }}">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_forgot_submit" class="btn btn-pill kt-login__btn-primary">Отправить</button>&nbsp;&nbsp;
                                    <button id="kt_login_forgot_cancel" class="btn btn-pill kt-login__btn-secondary">Отмена</button>
                                </div>
                            </form>
                        </div>
                        <div class="kt-login__account">
								<span class="kt-login__account-msg">
									Еще нет аккаунта ?
								</span>&nbsp;&nbsp;
                            <a href="javascript:;" id="kt_login_signup" class="kt-link kt-link--light kt-login__account-link">Регистрация</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Page -->
    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#2c77f4",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>

    <!-- end::Global Config -->
@stop
