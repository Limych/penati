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
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/password/email') }}">
                            {!! csrf_field() !!}
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    <input id="dlgLoginEmail" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           placeholder="E-mail" name="email" value="{{ old('email') }}" autofocus="autofocus" />
                                </div>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fa fa-btn fa-envelope mr-2"></i>Send Password Reset Link
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
