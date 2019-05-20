@extends('dashboard')
@section('content')
<section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Edit Data Pelanggan</h1>
            <hr>
            <form action="{{url('admin/dataUser/editPost')}}" method="post">
                {{ csrf_field() }}
            <input type="hidden" value="{{$data->id_buyer}}" name="id_buyer">
                <div class="form-group">
                    <label for="nama">Name :</label>
                    <input type="text" required class="form-control" id="buyer_name" name="buyer_name" value="{{ $data->buyer_name }}">
                </div>
                <div class="form-group">
                    <label for="nama">Address :</label>
                    <input type="text" required class="form-control" id="address" name="address" value="{{ $data->address }}">
                </div>
                <div class="form-group">
                    <label for="nama">City :</label>
                    <input type="text" required class="form-control" id="city" name="city" value="{{ $data->city }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    <button type="reset"  class="btn btn-md btn-danger">Cancel</button>
                    <a href="{{ URL::previous() }}" class="btn btn-md btn-info">Back</a>
                </div>
            </form>
        </div>
        <!-- /.content -->
    </section>
    @endsection
    @section('navmenu')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>{{$data_admin}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="{{ url('admin/logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
        </ul>
    </li>
    @endsection