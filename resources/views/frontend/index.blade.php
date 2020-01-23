<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <link rel="shortcut icon" type="image/png" href="<?php echo asset('img/favicon_icon/favi.png') ?>"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body id="app-layout">
        <div class="main">
            <div class="container">                
                <center>
                    <div class="row">
                        <div class="col col-md-6">
                            @include('includes.partials.opmessage')
                        </div>
                    </div>
                    <div class="middle">                        
                        <div id="login">
                            @if (! $logged_in_user)
                            <form action="{{ route('frontend.auth.login') }}" method="POST">
                                @csrf
                                <fieldset class="clearfix">
                                    <p ><span class="fa fa-user"></span><input placeholder="E-mail Address" name="email" type="text" id="email" required></p>
                                    <p><span class="fa fa-lock"></span><input placeholder="Password" name="password" type="password" id="password" required></p>
                                    <div>
                                        <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Forgot
                                                password?</a></span>
                                        <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Login"></span>
                                    </div>
                                </fieldset>
                                <div class="clearfix"></div>
                            </form>
                            @else
                                <ul class="withlogin_login_style">
                                    @permission('view-backend')
                                        <li>{{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) }}</li>
                                    @endauth

                                    <li>{{ link_to_route('frontend.user.account', trans('navs.frontend.user.account')) }}</li>
                                    <li>{{ link_to_route('frontend.auth.logout', trans('navs.general.logout')) }}</li>
                                </ul>
                            @endif
                            <div class="clearfix"></div>
                        </div> <!-- end login -->
                        <div class="logo">
                            <img src="{{ asset('img/site_images/site_logo.png') }}"/>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>