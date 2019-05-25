<!doctype html>
<html lang="en">

<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->	
	<link rel="stylesheet" href="{{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/vendor/chartist/css/chartist-custom.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	{{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/DataTables/DataTables/css/jquery.dataTables.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/DataTables/DataTables/css/dataTables.bootstrap.css')}}"> --}}
	<link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!-- GOOGLE FONTS -->
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a><img src="{{URL::asset('assets/img/logo-dark.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
                    <div id="navbar-menu">
                            <ul class="nav navbar-nav navbar-right">
                                {{-- <li active="dropdown">
                                    <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                        <i class="lnr lnr-alarm"></i>
                                        <span class="badge bg-danger">5</span>
                                    </a>
                                    <ul class="dropdown-menu notifications">
                                        <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
                                        <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
                                        <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
                                        <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
                                        <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
                                        <li><a href="#" class="more">See all notifications</a></li>
                                    </ul>
                                </li> --}}
                                {{-- <li active="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Basic Uses</a></li>
                                        <li><a href="#">Working With Data</a></li>
                                        <li><a href="#">Security</a></li>
                                        <li><a href="#">Troubleshooting</a></li>
                                    </ul>
                                </li> --}}
                                @yield('navmenu')
                                <!-- <li>
                                    <a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                                </li> -->
                            </ul>
                        </div>
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">												
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">            
			<div class="sidebar-scroll">
                <nav>
					<ul class="nav">
						<li active="@yield('admin/home')">
            				<a href="{{ url('admin/home') }}">
						<i class='fa fa-edit'></i>
							<span>Home</span>
            				</a>
						</li>
						<li active="@yield('admin/stock')">
            				<a href="{{ url('admin/stock') }}">
						<i class='fa fa-edit'></i>
							<span>Stock</span>
            				</a>
						</li>
						<li active="@yield('admin/dataUser')">
							<a href="{{ url('admin/dataUser') }}">
						<i class='fa fa-edit'></i>
							<span>Data User</span>
							</a>
						</li>
						<li active="@yield('admin/dataPelanggan')">
            				<a href="{{ url('admin/dataPelanggan') }}">
						<i class='fa fa-edit'></i>
							<span>Data Transaction</span>
            				</a>
						</li>
						<li active="@yield('admin/paymenVerification')">
            				<a href="{{ url('admin/paymenVerification') }}">
						<i class='fa fa-edit'></i>
							<span>Data Usage</span>
            				</a>
						</li>
						<li active="@yield('admin/history')">
            				<a href="{{ url('admin/history') }}">
						<i class='fa fa-edit'></i>
							<span>Payment Verification</span>
            				</a>
                        </li>
                        <li active="@yield('admin/logout')">
            				<a href="{{ url('admin/logout') }}">
						<i class='fa fa-edit'></i>
							<span>History Payment</span>
            				</a>
						</li>
						{{--<li active="@yield('admin/logout')">
            				<a href="{{ url('admin/logout') }}">
						<i class='fa fa-edit'></i>
							<span>Logout</span>
            				</a>
						</li--}}				
					</ul>
				</nav>
			</div>
        </div>       
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel">
						<div class="panel-body">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>		
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.12.0.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	{{-- <script src="{{URL::asset('assets/vendor/chartist/js/chartist.min.js')}}"></script> --}}
	<script src="{{URL::asset('assets/scripts/klorofil-common.js')}}"></script>		
	{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script> --}}

	<script>
    function Logout() {
		var id_logout = $('#id_logout').val();
            $.ajax({
                type: "get",
                url: "{{ url('admin/logout') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    id_logout: id_logout
                },
                success: function (response) {
						alert("berhasil Logout")
						window.location.replace("{{url('admin/home')}}");
                    
                }
            });
        
	}
        



</script>
</body>

</html>
