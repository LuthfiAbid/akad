@extends('layout.dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
        $(document).ready( function () {
            $('#table_id').DataTable();
        });
</script>
    <table class="display" id="table_id">
        <h2>Purchase Order Pending</h2>        
        <thead>
        <tr>
            <td>Buyer Name</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $data)                
                <form action="{{url('admin/stock/delete',$data->id_transaction)}}" method="POST">
                    <td>{{$data->buyer_name}}</td>
                    <td>{{$data->status}}</td>
                    {{-- <td>Rp. {{number_format($data->price,0,'.','.')}}</td>
                    <td><img src="{{asset('productImages/shirt').'/'.$data->picture}}" height="50px"></td>
                    <td>{{$data->cat_name}}</td> --}}
                    <td>
                    <a href="{{url('admin/stock/edit',$data->id_transaction)}}" class=" btn btn-sm btn-warning">Edit</a>        
                    {{-- <form action="{{url('admin/stock/delete',$data->id_goods)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> --}}
                    </td>
            </form>
        </tbody>
            @endforeach
        </table>
        <a href="{{ URL::previous() }}" class="btn btn-md btn-info">Back</a>
    @endsection
    @section('navmenu')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets/img/user.png')}}" class="img-circle" alt="Avatar"><span>{{$data_admin}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="{{ url('admin/logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
        </ul>
    </li>
@endsection