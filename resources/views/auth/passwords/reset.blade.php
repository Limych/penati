@extends('_layout.app')

@php($auth_mode = true)

@section('body-classes')auth flex-row align-items-center @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h1>Reset Password</h1>
                        <form role="form" method="POST" action="{{ url('/password/reset') }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="token" value="{{ $token }}" />
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    <input id="dlgLoginEmail" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           placeholder="E-mail" name="email" value="{{ $email or old('email') }}" autofocus="autofocus" />
                                </div>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           placeholder="New Password" />
                                </div>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           placeholder="Confirm New Password" />
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fa fa-btn fa-refresh mr-2"></i>Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
