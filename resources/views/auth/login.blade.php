<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Betler Multipurpose Forms HTML Template">
    <meta name="author" content="Ansonika">
    <title>QUADMIN</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/form-vendor.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/form.css')}}" rel="stylesheet">
</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->

	<div class="container-fluid p-0">
	    <div class="row no-gutters row-height">
	        <div class="col-lg-6 background-image " data-background="url({{asset('assets/images/1280_writing-down-goals_4460x4460.jpg')}})">
	            <div class="content-left-wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
	                <div class="text-left">
	                	<small>Welcome back</small>
	                    <h1>Duis aute irure dolor in reprehenderit in voluptate velit esse.</h1>
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-6 d-flex flex-column content-right">
                <div class="text-center pt-5">
                    <img src="{{asset('assets/logo.png')}}" alt="">
                </div>
	            <div class="container my-auto py-5">
	                <div class="row">
	                    <div class="col-lg-9 col-xl-7 mx-auto">
							@if ($errors->any())
								<div class="mb-4 text-danger">
									<div class="font-medium text-red-600">
										{{ __('Whoops! Something went wrong.') }}
									</div>

									<ul class="mt-3 list-disc list-inside text-sm text-red-600">
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif

	                        <form class="input_style_2" method="post" action="{{ route('login') }}">
								@csrf
	                            <div class="form-group">
	                                <label for="email_address">Email Address</label>
	                                <input type="email" name="email" id="email_address" class="form-control" value="{{old('email')}}">
	                            </div>
	                            <div class="form-group">
	                                <label for="password">Password</label>
	                                <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
	                            </div>
	                            <div class="clearfix mb-3">
	                                <div class="float-left">
	                                    <label class="container_check">Remember Me
	                                        <input type="checkbox">
	                                        <span class="checkmark"></span>
	                                    </label>
	                                </div>
	                                <div class="float-right">
	                                    <a id="forgot" href="javascript:void(0);">Forgot Password?</a>
	                                </div>
	                            </div>
	                            <button type="submit" class="btn_1 full-width">Login</button>
	                        </form>
	                        <form class="input_style_2" method="post">
	                            <div id="forgot_pw">
	                                <h4 class="mb-4">Forgot Password</h4>
	                                <div class="form-group">
	                                    <label for="email_forgot">Login email</label>
	                                    <input type="email" class="form-control" name="email_forgot" id="email_forgot">
	                                </div>
	                                <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
	                                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	            <div class="container pb-3 copy">© 2021 Quadque Technologies ltd - All Rights Reserved.</div>
	        </div>
	    </div>
	    <!-- /row -->
	</div>
	<!-- COMMON SCRIPTS -->
    <script src="{{asset('assets/js/common_scripts.js')}}"></script>
	<script src="{{asset('assets/js/common_func.js')}}"></script>
</body>
</html>