@extends('dashboard')
@section('content')
<section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Add Goods Data</h1>
            <hr>
            <form action="{{url('admin/stock/addPost')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="nama">Goods Name :</label>
                    <input type="text" required class="form-control" id="goods_name" name="goods_name">
                </div>
                <div class="form-group">
                    <label for="nama">Stock :</label>
                    <input type="number" required class="form-control" id="stock" name="stock">
                </div>
                <div class="form-group">
                    <label for="nama">Price :</label>
                    <input type="number" required class="form-control" id="price" name="price">
                </div>
                <div class="form-group">
                        <label for="nama">Categories : </label>
                        <select class="form-control" class="col-md-5" name="id_category">
                            @foreach ($category as $item)
                                <option value="{{$item->id_category}}">{{$item->category_name}}</option>                                                                              
                            @endforeach
                        </select>
                    </div>
                <div class="form-group">
                    <label for="nama">Picture : </label>
                    <input type="file" name="picture">
                </div>
                <div class="form-group">
                    <textarea name="description" cols="50" rows="5" placeholder="Description . . ."></textarea>
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