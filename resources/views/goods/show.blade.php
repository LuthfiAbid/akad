@extends('layout.dashboard')
@section('content')
<div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <table style="border: none;" width="100%">
                        <tr>
                            <td>Admin</td>
                            <td> : </td>
                            <td>{{$admin}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <table class="table table-striped table-hover table-responsive" id="table-detail">
                <thead>
                    <tr>
                        <th width="20%">No.</th>
                        <th width="20%">Goods Name</th>
                        <th width="20%">Price</th>
                        <th width="20%">Stock</th>
                        <th width="20%">Picture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; $subTotal = 0;?>
                    
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->goods_name}}</td>
                            <td style="padding-right:12px">Rp. {{number_format($data->price,0, ',' , '.')}} </td>
                            <td>{{$data->stock}}</td>
                            @if($data->id_category == 1)
                            <td style="padding-right:12px"><img src="{{asset('productImages/shirt/'.$data->picture)}}" style="height:100px;"></td>
                            @elseif($data->id_category ==2)
                            <td style="padding-right:12px"><img src="{{asset('productImages/pants/'.$data->picture)}}" style="height:100px;"></td>
                            @else
                            <td style="padding-right:12px"><img src="{{asset('productImages/dress/'.$data->picture)}}" style="height:100px;"></td>
                            @endif
                        </tr>                    
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-4">
                        <table>
                            <tr>
                                <td>
                                    <label>Description</label>
                                </td>
                                <td>&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp</td>
                                @if($data->description == null)
                                <td><b> - </b></td>
                                @else
                                <td><b>{{$data->description}}</b></td>
                                @endif
                            </tr>                            
                        </table>
                    </div>
                <div class="col-md-1"></div>
            </div>
            <hr>  
            <a href="{{ URL::previous() }}" class="btn btn-md btn-info">Back</a>      
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/datatables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">

        $('#table-detail').DataTable({
           'paging': false,
           'lengthChange': false,
           'searching': true,
           'ordering': true,
           'info': true,
           'autoWidth': true,
           "language": {
               "emptyTable": "Data Kosong",
            //    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
               "info": "",
               "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
               "infoFiltered": "(disaring dari _MAX_ total data)",
               "search": "Cari:",
               "lengthMenu": "Tampilkan _MENU_ Data",
               "zeroRecords": "Tidak Ada Data yang Ditampilkan",
               "oPaginate": {
                   "sFirst": "Awal",
                   "sLast": "Akhir",
                   "sNext": "Selanjutnya",
                   "sPrevious": "Sebelumnya"
               },
           },
            'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['nosort']
          }],
        });
    </script>
@endsection