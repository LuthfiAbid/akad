@extends('layout.dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<div class="row">
    <div class="col-md-6-lg">        
        <p class="lead">
            @if (session('alert'))
            <div class="alert alert-success">
                {{ session('alert') }}
            @endif                    
        </p> 
    </div>
</div>
<h2>Buyers</h2>
    <table class="table" id="table_id">
        <thead>
            <tr>
                <td>Name</td>
                <td>Address</td>
                <td>City</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
                @foreach ($data as $data)                           
            <input type="hidden" value="{{$data->id_buyer}}" name="id_buyer">
            <td>{{$data->buyer_name}}</td>
            <td>{{$data->address}}</td>
            <td>{{$data->city}}</td>
            <td>
            <a href="{{url('admin/dataUser/edit',$data->id_buyer)}}" class=" btn btn-sm btn-warning">Edit</a>
            {{-- <a href="{{}}"></a> --}}
            </td>
        </tbody>
        @endforeach
    </table>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table_id').DataTable();
         });
    </script>
@endsection
@section('navmenu')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>{{$data_admin}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="{{ url('admin/logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
        </ul>
    </li>
@endsection
