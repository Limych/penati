{{--@php--}}
    {{--if (empty($errors)){--}}
        {{--$errors = new \Illuminate\Support\Collection();--}}
    {{--}--}}
{{--@endphp--}}
<h1>Login</h1>
<p class="text-muted">Sign In to your account</p>
<form role="form" method="POST" action="{{ url('/login') }}">
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
    <div class="form-group mb-3">
        <div class="input-group">
            <span class="input-group-addon"><i class="icon-lock"></i></span>
            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   placeholder="Password" />
        </div>
        @if ($errors->has('password'))
            <div class="invalid-feedback d-block">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label class="custom-control custom-checkbox ml-5">
            <input type="checkbox" class="custom-control-input" name="remember" />
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Remember Me</span>
        </label>
    </div>
    <div class="row align-items-center">
        <div class="col-6">
            <button type="submit" class="btn btn-primary px-4"><i class="fa fa-btn fa-sign-in mr-2"></i>Login</button>
        </div>
        <div class="col-6 text-right">
            <a class="px-0" href="{{ url('/password/reset') }}">Forgot password?</a>
        </div>
    </div>
</form>
