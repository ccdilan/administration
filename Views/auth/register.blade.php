@extends('layouts.login')
@section('title','Login')
@section('content')
    <div class="row flex-grow">
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo">
                    {{--                    <img src="../../images/logo.svg" alt="logo">--}}
                    Cyntrek Solutions
                </div>
                <h4>New here?</h4>
                <h6 class="font-weight-light">Join us today! It takes only few steps</h6>
                {!! Form::open(['route' => 'register', 'method' => 'post']) !!}
                <div class="form-group">
                    <label>Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-user text-primary"></i>
                      </span>
                        </div>
                        <input id="name" type="text" placeholder="Username"
                               class="form-control form-control-lg border-left-0 @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="far fa-envelope-open text-primary"></i>
                      </span>
                        </div>
                        <input id="email" placeholder="Email" type="email"
                               class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-lock text-primary"></i>
                      </span>
                        </div>
                        <input id="password" type="password" autocomplete="new-password" placeholder="Password"
                               class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror"
                               name="password" required>

                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-lock text-primary"></i>
                      </span>
                        </div>
                        <input id="password-confirm" type="password" name="password_confirmation"
                               autocomplete="new-password" placeholder="Password"
                               class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror"
                               required>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                </div>
                {{--                <div class="mb-4">--}}
                {{--                    <div class="form-check">--}}
                {{--                        <label class="form-check-label text-muted">--}}
                {{--                            <input type="checkbox" class="form-check-input">--}}
                {{--                            I agree to all Terms & Conditions--}}
                {{--                        </label>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                    Already have an account? <a href="{{route('login')}}" class="text-primary">Login</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-lg-6 register-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018
                All rights reserved.</p>
        </div>
    </div>
@endsection
