@extends('layout.dashboard')
@section('content')
<div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <table style="border: none;" width="100%">
                        <tr>
                            <td>Kode Sales Order</td>
                            <td></td>
                            <td>{{$detailSalesOrder[0]->so_code}}</td>
                        </tr>
                        <tr>
                            <td>Customer</td>
                            <td></td>
                            <td>{{$detailSalesOrder[0]->customer}}</td>
                        </tr>
                        <tr>
                            <td>Sales</td>
                            <td></td>
                            <td>{{$detailSalesOrder[0]->sales}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{ date('d-m-Y',strtotime($detailSalesOrder[0]->so_date)) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Kirim</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{ date('d-m-Y',strtotime($detailSalesOrder[0]->sending_date)) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <table style="border: none;">
                        <tr>
                            <td>User Input</td>
                            <td></td>
                            <td>{{$detailSalesOrder[0]->userinput}}</td>
                        </tr>
                        <tr>
                            <td>Penerima SO</td>
                            <td></td>
                            <td>{{$detailSalesOrder[0]->userReceive}}</td>
                        </tr>
                        <tr>
                            <td>TOP</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{ $detailSalesOrder[0]->top_hari }} Hari</td>
                        </tr>
                        <tr>
                            <td>Toleransi TOP</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{ $detailSalesOrder[0]->top_toleransi }} Hari</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <table class="table table-striped table-hover table-responsive" id="table-detail">
                <thead>
                    <tr>
                        <th>No.</th>
                        {{-- <th>Sales Order</th> --}}
                        {{-- <th>Customer</th> --}}
                        {{-- <th>Sales</th> --}}
                        <th width="20%">Barang</th>
                        <th width="15%">Harga</th>
                        <th>Disc(%)</th>
                        <th>Disc(Rp)</th>
                        <th>M(%)</th>
                        <th>M(Rp)</th>
                        <th>Qty</th>
                        <th>Free Qty</th>
                        {{-- <th>Satuan</th> --}}
                        {{-- <th>Tanggal Transaksi</th> --}}
                        <th width="15%">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; $subTotal = 0;?>
                    @foreach($detailSalesOrder as $data)
                        <tr>
                            <td>{{$i++}}</td>
                            {{-- <td>{{ $data->so_code }}</td> --}}
                            {{-- <td>{{ $data->customer }}</td> --}}
                            {{-- <td>{{ $data->sales }}</td> --}}
                            <td>{{ $data->produk }}</td>
                            <td style="text-align:right; padding-right:12px">Rp. {{ number_format($data->customer_price,0,'.','.') }} </td>

                            <td>{{  ( $data->diskon_persen != 0 ) ? $data->diskon_persen.' %' : '-' }}</td>

                            <td style="text-align:right; padding-right:12px">{{  ($data->diskon_potongan != 0 ) ? 'Rp. '.number_format($data->diskon_potongan,0,'.','.') : '-' }}</td>

                            <td>{{  ( $data->markup_persen != 0 ) ? $data->markup_persen.' %' : '-' }}</td>


                            <td style="text-align:right; padding-right:12px">{{  ($data->markup != 0 ) ? 'Rp. '.number_format($data->markup,0,'.','.') : '-' }}</td>

                            <td>{{ $data->qty }} {{ $data->code_unit }}</td>
                            <td>{{ $data->free_qty }} {{ $data->code_unit }}</td>
                            {{-- <td>{{ date('d-m-Y',strtotime($data->so_date)) }}</td> --}}
                            <td style="text-align:right; padding-right:12px">Rp. {{ number_format($data->total,0,'.','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-4 col-md-offset-7">
                    <div class="pull-right">
                        <table class="" style="">
                            <tr>
                                <td>
                                    <label for="">Total</label>
                                </td>
                                <td style="width:20%"></td>
                                <td><b>Rp. {{number_format($subTotal1,0,'.','.')}}</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Diskon(%)</label>
                                </td>
                                <td style="width:20%"></td>
                                <td> <b>{{  ( $detailSalesOrder[0]->diskon_header_persen != 0 ) ? $detailSalesOrder[0]->diskon_header_persen.' %' : '-' }}</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Diskon (Rp) </label>
                                </td>
                                <td style="width:20%"></td>
                                <td>
                                    <b>{{  ($detailSalesOrder[0]->diskon_header_potongan != 0 ) ? 'Rp. '.number_format($detailSalesOrder[0]->diskon_header_potongan,0,'.','.') : '-' }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">PPN (%) </label>
                                </td>
                                <td style="width:20%"></td>
                                <td>
                                    <b>{{$detailSalesOrder[0]->ppn}} %</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Amount PPN </label>
                                </td>
                                <td style="width:20%"></td>
                                <td>
                                    <b>Rp. {{number_format($detailSalesOrder[0]->amount_ppn,0,'.','.')}}</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Grand Total</label>
                                </td>
                                <td style="width:20%"></td>
                                <td>
                                    <b>Rp. {{number_format($detailSalesOrder[0]->grand_total,0,'.','.')}}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <hr>
            @if( $detailSalesOrder[0]->status_aprove == 'cancel')
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>User Cancel</td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$detailSalesOrder[0]->user_cancel}}</td>
                            </tr>
                            <tr>
                                <td>Tipe Alasan</td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$detailSalesOrder[0]->cancel_reason}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi Cancel</td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$detailSalesOrder[0]->cancel_description}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif
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