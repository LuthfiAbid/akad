@extends('layout.dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
<script type="text/javascript" src="{{URL::asset('DataTables/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('DataTables/js/datatables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')
<script type="text/javascript">
        $(document).ready( function () {
            $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?= url("stock/api/get") ?>',
                columns: [
                    {data: 'goods_name', name: 'goods_name'},
                    {data: 'stock', name: 'stock'},
                    {data: 'price', name: 'price'},
                    {data: 'picture', name: 'picture'},
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
</script>
    <table class="display" id="table_id">
        <div class="row">
                <div class="col-md-12">                
                    @if (session('success'))
                    <div class="alert alert-success">
                        <center>{{ session('success') }}</center>
                        @endif
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">                
                @if (session('delete'))
                <div class="alert alert-success">
                    <center>{{ session('delete') }}</center>
                    @endif
                </div>
            </div>
        </div>
        <h2>Goods Warehouse</h2>     
        <center><a href="{{url('admin/stock/add')}}" class="btn btn-info"><li class="fa fa-plus">Add Goods</li></a>   </center>
        <thead>
        <tr>
            <td>Goods name</td>
            <td>Stock</td>
            <td>Price</td>
            <td>Picture</td>
            <td>Category</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
            {{-- @foreach ($data as $data)                
                <form action="{{url('admin/stock/delete',$data->id_goods)}}" method="POST">
                    <td>{{$data->goods_name}}</td>
                    <td>{{$data->stock}}</td>
                    <td>Rp. {{number_format($data->price,0,'.','.')}}</td>
                    <td><img src="{{asset('productImages/shirt').'/'.$data->picture}}" height="50px"></td>
                    <td>{{$data->cat_name}}</td>
                    <td>
                    <a href="{{url('admin/stock/edit',$data->id_goods)}}" class=" btn btn-sm btn-warning">Edit</a>        
                    <form action="{{url('admin/stock/delete',$data->id_goods)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
            </form> --}}
        </tbody>
            {{-- @endforeach --}}
        </table>
    @endsection
    @section('navmenu')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>{{$data_admin}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="{{ url('admin/logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
        </ul>
    </li>
@endsection