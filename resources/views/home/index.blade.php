@extends('layout.dashboard')
@section('box')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="tile-stats">
                            <div class="panel-body">
                            <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                            <h3><div class="count">{{$poPending}}</div></h3>
                            <h3>PO Pending</h3>
                            <a href="{{url('admin/pendingPO')}}" type="button" class="btn btn-info">Show</a>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="tile-stats">
                            <div class="panel-body">
                            <div class="icon"><i class="fa fa-usd"></i></div>
                            <h3><div class="count">{{$payementPending}}</div></h3>
                            <h3>Payment Pending</h3>
                            <a href="{{url('')}}" type="button" class="btn btn-info">Show</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<h2>Selamat Datang {{$data}} !</h2>
@endsection
@section('navmenu')
<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>{{$data}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a onclick="Logout()"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
        </ul>
    </li>
@endsection