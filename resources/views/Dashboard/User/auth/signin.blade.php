@extends('Dashboard.layouts.master2')
@section('title')
    تسجيل الدخول
@stop
@section('css')
    <style>
        .loginform {
            display: none
        }
    </style>
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('Dashboard/img/media/login.png') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href=""><img
                                                src="{{ URL::asset('Dashboard/img/brand/favicon.png') }}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Mariel<span>So</span>ft</h1>
                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>{{ trans('Dashboard/login_tans.welcome_back') }}</h2>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">{{ trans('Dashboard/login_tans.choos_login') }}</label>
                                                <select class="form-control" id="SelectionChooser">
                                                    <option value="" selected disabled>--{{ trans('Dashboard/login_tans.choos_account') }}--</option>
                                                    <option value="user">{{ trans('Dashboard/login_tans.user_account') }}</option>
                                                    <option value="admin">{{ trans('Dashboard/login_tans.admin_account') }}</option>
                                                    <option value="doctor">{{ trans('Dashboard/login_tans.doctor_account') }}</option>
                                                    <option value="ray_employee">{{ trans('Rays.ray_employee_account') }}</option>
                                                    <option value="laboratorie_employee">{{ trans('laboratorie.laboratorie_employees') }}</option>
                                                    <option value="pharmacy">الدخول كصيدلي</option>
                                                    
                                                </select>
                                            </div>
                                            <!---form user---->
                                            <div class="loginform" id="user">
                                                <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_tans.user_account') }}</h5>
                                                <form method="POST" action="{{ route('login.patient') }}">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label>{{ trans('Dashboard/login_tans.email') }}</label> <input class="form-control" type="email"
                                                            name="email" value="{{ old('name') }}" id="email"
                                                            placeholder="Enter your email"autofocus required>
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{ trans('Dashboard/login_tans.password') }}</label> <input name="password" class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            autocomplete="current-password" required>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
                                                    <button class="btn btn-main-primary btn-block">{{ trans('Dashboard/login_tans.sign') }}</button>
{{--                                                     
                                                    <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i class="fab fa-facebook-f"></i>
                                                            {{ trans('Dashboard/login_tans.facebook') }}</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i
                                                                    class="fab fa-twitter"></i>{{ trans('Dashboard/login_tans.twitter') }}</button>
                                                        </div>
                                                    </div> --}}
                                                </form>
                                                {{-- <div class="main-signin-footer mt-5">
                                                    <p><a href="">{{ trans('Dashboard/login_tans.forgot') }}</a></p>
                                                    <p>{{ trans('Dashboard/login_tans.dont_have_account') }}<a
                                                            href="{{ route('register') }}">     {{ trans('Dashboard/login_tans.create_account') }}</a>
                                                    </p>
                                                </div> --}}
                                            </div>
                                            <!---end form user---->

                                            {{-- -form admin --}}
                                            <div class="loginform" id="admin">
                                                <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_tans.admin_account') }}</h5>
                                                <form method="POST" action="{{ route('login.admin') }}">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control" type="email"
                                                            name="email" value="{{ old('name') }}" id="email"
                                                            placeholder="Enter your email"autofocus required>
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input name="password" class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            autocomplete="current-password" required>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
                                                    <button class="btn btn-main-primary btn-block">Sign In</button>
                                                    {{-- <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i class="fab fa-facebook-f"></i>
                                                                Signup with Facebook</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i
                                                                    class="fab fa-twitter"></i> Signup with Twitter</button>
                                                        </div>
                                                    </div> --}}
                                                </form>
                                                {{-- <div class="main-signin-footer mt-5">
                                                    <p><a href="">Forgot password?</a></p>
                                                    <p>Don't have an account? <a
                                                            href="{{ url('/' . ($page = 'signup')) }}">Create an Account</a>
                                                    </p>
                                                </div> --}}
                                            </div>
                                            <!---end form user---->
                                            
                                              {{-- -form doctor --}}
                                              <div class="loginform" id="doctor">
                                                <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_tans.doctor_account') }}</h5>
                                                <form method="POST" action="{{ route('login.doctor') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control" type="email"
                                                            name="email" value="{{ old('name') }}" id="email"
                                                            placeholder="Enter your email"autofocus required>
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input name="password" class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            autocomplete="current-password" required>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
                                                    <button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                            </div>
                                            <!---end form user---->

                                             {{-- -form employee --}}
                                             <div class="loginform" id="ray_employee">
                                                <h5 class="font-weight-semibold mb-4">{{ trans('Rays.ray_employee_account') }}</h5>
                                                <form method="POST" action="{{ route('login.ray_employee') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control" type="email"
                                                            name="email" value="{{ old('name') }}" id="email"
                                                            placeholder="Enter your email"autofocus required>
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input name="password" class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            autocomplete="current-password" required>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
                                                    <button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                            </div>
                                            <!---end form user---->

                                             {{-- -form laboratorie employee --}}
                                             <div class="loginform" id="laboratorie_employee">
                                                <h5 class="font-weight-semibold mb-4">{{ trans('laboratorie.laboratorie_employees') }}</h5>
                                                <form method="POST" action="{{ route('login.laboratorie_employee') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control" type="email"
                                                            name="email" value="{{ old('name') }}" id="email"
                                                            placeholder="Enter your email"autofocus required>
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input name="password" class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            autocomplete="current-password" required>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
                                                    <button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                            </div>
                                            <!---end form employee---->

                                             {{-- -form laboratorie employee --}}
                                             <div class="loginform" id="pharmacy">
                                                <h5 class="font-weight-semibold mb-4">الدخول كصيدلي</h5>
                                                <form method="POST" action="{{ route('login.pharmacy') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label> <input class="form-control" type="email"
                                                            name="email" value="{{ old('name') }}" id="email"
                                                            placeholder="Enter your email"autofocus required>
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input name="password" class="form-control"
                                                            placeholder="Enter your password" type="password"
                                                            autocomplete="current-password" required>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
                                                    <button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                            </div>
                                            <!---end form employee---->

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#SelectionChooser').change(function() {
            var myID = $(this).val();
            $('.loginform').each(function() {
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
@endsection
