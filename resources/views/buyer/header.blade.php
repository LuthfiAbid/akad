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
    <link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/bootstrap.min.css')}}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/slick.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/slick-theme.css')}}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/nouislider.min.css')}}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{URL::asset('buyer/css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/style.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{URL::asset('buyer/css/jquery-confirm.css')}}" />
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
                    <input type="hidden" id="id_buyer" value="{{Session::get('id_buyer')}}">
                    @if(Session::get('login_buyer'))

                    {

                    <!-- <li><i class="fa fa-user-o"></i><label style="color:white;" for="">{{Session::get('buyer_name')}}</label></li> -->
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i
                                class="fa fa-user-o"></i>{{Session::get('buyer_name')}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{URL::asset('buyer/setting')}}/{{Session::get('id_buyer')}}">
                                    <p style="color:black;"><i class="fa fa-cog" aria-hidden="true"> Setting</i></p>
                                </a></li>
                            <li><a class="logout_confirm" onclick="" href="#">
                                    <p style="color:black;"><i class="fa fa-sign-out" aria-hidden="true"> Logout</i></p>
                                </a></li>
                            <input id="id_logout" type="hidden" value="1">
                        </ul>
                    </li>
                    }
                    @else{
                    <li><a href="{{URL::asset('buyer/login')}}"><i class="fa fa-user-o"></i>Login</a></li>
                    <li><a href="{{URL::asset('buyer/register')}}"><i class="fa fa-registered"></i>Register</a></li>
                    }
                    @endif

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
                            <a href="{{URL::asset('buyer/home')}}" class="logo">
                                <!-- <img width='180px' height="80px"  src="./img/logo-akad.png" alt=""> -->
                                <h1 align="center" style="font-size: 50px; color:white;">AKAD</h1>
                                <hr width="200px" style="margin-top: -10px;">
                                <h4 align="center" style="color:white;margin-top: -15px;">Belanja Halal Hati Lega</h4>
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-8">
                        <div class="header-search">
                            <form>
                                {{-- <select class="input-select" style="width:150px;">
                                    <option value="0">All Category </option>
                                    <option value="pakaian">T-shirt</option>
                                    <option value="aksesori">shirt</option>
                                    <option value="aksesori">koko shirt</option>
                                </select> --}}
                                <input class="input" placeholder="Search here">
                                <button class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-1 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->

                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown" style="cursor: pointer;">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Cart</span>
                                    <div id="count2" class="qty"></div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        @if (Session::get('login_buyer'))

                                        @foreach ($detail_transaction as $detail_transaction)
                                        <input type="hidden" id="id_transaction" name="id_transaction"
                                            value="{{$detail_transaction->id_transaction}}">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{asset('productImages/shirt').'/'.$detail_transaction->picture}}"
                                                    alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a
                                                        href="#">{{$detail_transaction->goods_name}}</a></h3>
                                                <h4 class="product-price"><span
                                                        class="qty">{{$detail_transaction->qty}}x</span>Rp.
                                                    {{number_format($detail_transaction->subtotal,0,'.','.')}}</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                        @endforeach

                                        @else
                                        <div class="product-widget">
                                            No Items Purchased
                                        </div>

                                        @endif

                                    </div>
                                    <div class="cart-summary">
                                        <small id='count'></small>
                                        <h5 id="sum"></h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a onclick="viewChart()">View Cart</a>
                                        <a onclick="viewCheckout()">Checkout <i
                                                class="fa fa-arrow-circle-right"></i></a>
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
                        <li class="active"><a href="{{URL::asset('buyer/home')}}">Home</a></li>
                        <li class=""><a href="{{URL::asset('buyer/category')}}">Category</a></li>
                        {{-- <li class="dropdown">
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
                        </li> --}}
                    </ul>
                    <!-- /NAV -->
                </div>
                <!-- /responsive-nav -->
            </div>
            <!-- /container -->
        </nav>
        <!-- /NAVIGATION -->
    </header>
