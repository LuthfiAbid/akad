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
                ajax: '<?= url("payment/api/get") ?>',
                columns: [
                    {data: 'id_transaction', name: 'id_transaction'},
                    {data: 'buyer_name', name: 'buyer_name'},
                    {data: 'status', name: 'status'},
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
        <h2>Payment Status</h2>     
        <thead>
        <tr>
            <td width="10%">ID Transaction</td>
            <td width="20%">Buyer Name</td>
            <td width="10%">Status</td>
            <td width="10%">Action</td>
        </tr>
        </thead>
        <tbody>  
                      
        </tbody>
        </table>
    @endsection
    @section('navmenu')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>{{$dataAdmin}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="{{ url('admin/logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
        </ul>
    </li>
@endsection