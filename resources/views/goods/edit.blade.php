@extends('layout.dashboard')
@section('content')
{{-- <script src="cleave.min.js"></script> --}}
<section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Edit Goods Data</h1>
            <hr>
            <form action="{{url('admin/stock/editPost',$data->id_goods)}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{method_field('PUT')}}
            <!-- <input type="hidden" value="{{$data->id_category}}" name="id_category"> -->
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                <div class="form-group">
                    <label for="nama">Goods Name :</label>
                    <input type="text" required class="form-control" id="goods_name" name="goods_name" value="{{ $data->goods_name }}">
                </div>
                <div class="form-group">
                    <label for="nama">Stock :</label>
                    <input type="text" required class="form-control" id="stock" name="stock" value="{{ $data->stock }}">
                </div>
                <div class="form-group">
                    <label for="nama">Price :</label>
                    <input type="text" required class="form-control" id="price" name="price" value="{{ $data->price }}">
                </div>
                <div class="form-group">
                        <label for="nama">Categores : </label>
                        <select class="form-control" class="col-md-5" name="id_category">
                        @foreach($categories as $cat){
                            <option value={{ $cat->id_category }}>{{$cat->category_name}}</option>                                            
                        }
                        @endforeach
                        </select>
                    </div>
                <div class="form-group">
                    <label for="nama">Picture :</label>
                    <div class="col-md-3-lg"></div>
                    <input type="file" required class="form-control" name="picture">
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