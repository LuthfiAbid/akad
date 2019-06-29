@extends('layout.dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
<script type="text/javascript" src="{{URL::asset('DataTables/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('DataTables/js/datatables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= url("pendingPo/api/get") ?>',
            columns: [
                {data: 'no',name:'no'},
                {data: 'buyer_name', name: 'buyer_name'},
                {data: 'status', name: 'status'},
                {data: 'transaction', name: 'transaction'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
    <table class="display" id="table_id">
        <h2>Purchase Order Pending</h2>        
        <thead>
        <tr>
            <td>No Transaction </td>
            <td>Buyer Name</td>
            <td>Status</td>
            <td>Date Transaction</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        </tbody>
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