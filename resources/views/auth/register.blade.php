@php
    $seo_title =  "Register | ". config('app.name', 'Serviced By ONE');
@endphp

@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><h1>{{ __('Register') }}</h1></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label"><b>{{ __('Name') }}</b></label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-12 col-form-label"><b>{{ __('E-Mail Address') }}</b></label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-12 col-form-label"><b>{{ __('User Name') }}</b></label>

                                <div class="col-md-12">
                                    <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" required>

                                    @if ($errors->has('user_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-12 col-form-label"><b>{{ __('Phone') }}</b></label>

                                <div class="col-md-12">
                                    <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-12 col-form-label"><b>{{ __('Password') }}</b></label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-12 col-form-label"><b>{{ __('Confirm Password') }}</b></label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-register">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <a href="{{ route('social.login', 'facebook') }}" class="d-block mb-1">
                                <img class="w-75" src="{{ asset('images/login-fb.png') }}" alt=""></a>
                            <a href="{{ route('social.login', 'google') }}"  class="d-block">
                                <img class="w-75" src="{{ asset('images/login-google.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
