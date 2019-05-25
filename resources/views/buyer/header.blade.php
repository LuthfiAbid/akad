<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/bootstrap.min.css')}}"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/slick.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/slick-theme.css')}}"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/nouislider.min.css')}}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{URL::asset('buyer/css/font-awesome.min.css')}}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/style.css')}}"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> akadstore@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Jl Kedoya</a></li>
					</ul>
					<ul class="header-links pull-right">
						<!-- <li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li> -->
					
						@if(Session::get('login'))
						
         {
					<!-- <li><i class="fa fa-user-o"></i><label style="color:white;" for="">{{$data}}</label></li> -->
					<li class="dropdown">
						<a href="#" data-toggle="dropdown"><i class="fa fa-user-o"></i>{{$data}}</a>
							<ul class="dropdown-menu">
							<li><a href="#"><p style="color:black;"><i class="fa fa-cog" aria-hidden="true"> Setting</i></p></a></li>
								<li><a onclick="logout_buyer()" href="#"><p style="color:black;"><i class="fa fa-sign-out" aria-hidden="true"> Logout</i></p></a></li>
										<input id="id_logout" type="hidden" value="1">
							</ul>
						</li>
         }
         @else{
					<li><a href="{{URL::asset('buyer/login')}}"><i class="fa fa-user-o"></i>Login</a></li>
         }
         @endif
						<li><a href="{{URL::asset('buyer/register')}}"><i class="fa fa-registered"></i>Register</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<!-- <img width='180px' height="80px"  src="./img/logo-akad.png" alt=""> -->
									<h1 align="center" style="font-size: 50px; color:white;">AKAD</h1><hr width="200px" style="margin-top: -10px;">
										<h4 align="center" style="color:white;margin-top: -15px;">Belanja Halal Hati Lega</h4>
								</a>
							</div>
						</div>
						<!-- /LOGO -->
	
						<!-- SEARCH BAR -->
						<div class="col-md-7">
							<div class="header-search">
								<form>
									<select class="input-select" style="width:150px;">
										<option value="0">All Category </option>
										<option value="pakaian">T-shirt</option>
										<option value="aksesori">shirt</option>
										<option value="aksesori">koko shirt</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-2 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown" style="cursor: pointer;">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Chart</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="view_chart.php">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->

				<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						<li class="dropdown">
						<a href="#" data-toggle="dropdown">Clothes</a>
							<ul class="dropdown-menu">
								<li><a href="#">Shirt</a></li>
								<li><a href="#">Batik Shirts</a></li>
								<li><a href="#">T-shirt</a></li>
							</ul>
						</li>
						<li class="dropdown">
						<a href="#" data-toggle="dropdown">Koko Clothes</a>
							<ul class="dropdown-menu">
								<li><a href="#">Koko Clothes</a></li>
							</ul>
						</li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
		</header>