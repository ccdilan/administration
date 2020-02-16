@extends('layouts.login')
@section('title','Login')
@section('content')
    <div class="row flex-grow">
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo">
                    {{--                            <img src="../../images/logo.svg" alt="logo">--}}
                    Cyntrek Solutions
                </div>
                <h4>Welcome back!</h4>
                <h6 class="font-weight-light">Happy to see you again!</h6>
                {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
                <div class="form-group">
                    <label for="exampleInputEmail">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-user text-primary"></i>
                      </span>
                        </div>
                        <input id="email" placeholder="Email" type="email" class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-lock text-primary"></i>
                      </span>
                        </div>
                        <input placeholder="Password" id="password" type="password" class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" class="form-check-input">
                            Keep me signed in
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="auth-link text-black" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

                <div class="my-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >LOGIN</button>
                </div>

                <div class="mb-2 d-flex">
                    <button disabled type="button" class="btn btn-facebook auth-form-btn flex-grow mr-1">
                        <i class="fab fa-facebook-f mr-2"></i>Facebook
                    </button>
                    <button disabled type="button" class="btn btn-google auth-form-btn flex-grow ml-1">
                        <i class="fab fa-google mr-2"></i>Google
                    </button>
                </div>

{{--                <div class="text-center mt-4 font-weight-light">--}}
{{--                    Don't have an account? <a href="{{route('register')}}" class="text-primary">Create</a>--}}
{{--                </div>--}}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; {{date("Y")}}  All rights reserved.</p>
        </div>
    </div>
@endsection
