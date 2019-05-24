@extends('dashboard')
@section('content')
{{-- <link rel="stylesheet" type="text/css" href="{{URL::assets('assets/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::assets('assets/DataTables/DataTables/css/jquery.dataTables.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::assets('assets/DataTables/DataTables/css/dataTables.bootstrap.css')}}"> --}}
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{URL::asset('assets/DataTables/DataTables/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/DataTables/DataTables/js/jquery.dataTables.js')}}"></script>
<script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        });
    </script>
    <table class="display" id="table_id">
        <h2>Goods Warehouse</h2>        
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
            @foreach ($data as $data)                
            <td>{{$data->goods_name}}</td>
            <td>{{$data->stock}}</td>
            <td>Rp. {{number_format($data->price,0,'.','.')}}</td>
            <td><img src="{{asset('productImages/food').'/'.$data->picture}}" height="50px"></td>
            <td>{{$data->cat_name}}</td>
            <td>
            <a href="{{url('admin/stock/edit',$data->id_goods)}}" class=" btn btn-sm btn-warning">Edit</a>
            </td>
        </tbody>
        @endforeach
    </table>
@endsection