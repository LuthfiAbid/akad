<!-- HEADER -->
@include('buyer.header')
<!-- /HEADER -->

<!-- SECTION -->

<style type="text/css">
    #outtable {
        padding: 20px;
        border: 1px solid #e3e3e3;
        width: 600px;
        border-radius: 5px;
    }

    .short {
        width: 50px;
    }

    .normal {
        width: 150px;
    }

    #aaa_table {
        border-collapse: collapse;
        font-family: arial;
        color: #5E5B5C;
    }

    #aaa_thead th {
        text-align: left;
        padding: 10px;
    }

    #aaa_tbody td {
        border-top: 1px solid #e3e3e3;
        padding: 10px;
    }

    #aaa_tbody tr:nth-child(even) {
        background: #F6F5FA;
    }

    #aaa_tbody tr:hover {
        background: #EAE9F5
    }

    #aaa_thead,
    #aaa_tbody {
        display: block;
    }

    #aaa_tbody {
        height: 400px;
        width: 100%;
        /* Just for the demo          */
        overflow-y: auto;
        /* Trigger vertical scroll    */
        overflow-x: hidden;
        /* Hide the horizontal scroll */
    }
</style>
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- product -->
            <div class="col-md-12">
                <table class="table" width="100%" style="float: left;" id="aaa_table">
                    <thead id="aaa_thead">
                    </thead>
                    <tbody align="center" id="aaa_tbody">
                        <tr align="center">
                            <td width="1%"><b>
                                    <font color="">id_goods</font>
                                </b></td>
                            <td width="20%"><b>
                                    <font color="">Picture</font>
                                </b></td>
                            <td width="10%"><b>
                                    <font color="">Product Name</font>
                                </b></td>
                            <td width="10%"><b>
                                    <font color="">Quantity</font>
                                </b></td>
                            <td width="10%"><b>Subtotal</b></td>
                            <td width="10%"><b>Action</b></td>
                        </tr>
                        @foreach ($detail_transaction as $detail_transaction2)
                        <tr>
                            <td><p style="margin-top:100%;">{{$detail_transaction2->id_goods}}</p></td>
                            <td><img height="10%" width="40%"
                                    src="{{asset('productImages/shirt').'/'.$detail_transaction2->picture}}" alt="">
                            </td>
                            <td><p style="margin-top:40%;">{{$detail_transaction2->cat_name}}</p></td>
                            <td><p style="margin-top:40%;" id="goods_{{$detail_transaction2->id_detail}}" onclick="edit_stok('goods_{{$detail_transaction2->id_detail}}');" >{{$detail_transaction2->qty}}</p>
                                <input type="hidden" id="id_check_{{$detail_transaction2->id_detail}}" name="id_check" value="id_check_{{$detail_transaction2->id_detail}}">
                            </td>
                            <td><p style="margin-top:40%;">Rp. {{number_format($detail_transaction2->subtotal,0,'.','.')}}</p></td>
                            <td><button style="margin-top:40%;" onclick="deleteDetail({{$detail_transaction2->id_detail}})" class="btn btn-danger"><i class="fa fa-close"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5 id="sum2"></h5>
            </div>
            <!-- /product -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->

<!-- /HOT DEAL SECTION -->

@include('buyer.footer')

<script>

    function deleteDetail($id_detail) {
        if (confirm('Are you sure you want to save this thing into the database?')) {
            $.ajax({
                type: "post",
                url: "{{ url('buyer/deleteDetail') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    id_detail: $id_detail
                },
                success: function (data) {
                    if(data == 1){
                        alert("Success Delete")
                        location.reload();
						// window.location.replace("{{url('buyer/viewChart')}}");
                    }else{
                        alert('gagal delete');
                    }
                }
            });
        } else {
            // Do nothing!
        }


	}

    function edit_stok(good_id) {
    console.log(good_id);
    inputIdWithHash = "#" + good_id;
    elementValue = $(inputIdWithHash).text();
    $(inputIdWithHash).replaceWith('<input name="test" style="margin-top:40%; width: 70px;border-radius: 5px;" id="' + good_id + '" type="number" value="' + elementValue + '">');

    $(document).click(function (event) {
        var id_check = $('#id_check').val()
        var qty = $('#goods_'+id_check+'').val()
        var edit = 'goods_'+id_check+'';
        if (!$(event.target).closest(inputIdWithHash).length) {
            $(inputIdWithHash).replaceWith('<p style="margin-top:40%;" id="' + edit + '" onclick="edit_stok(\''+ edit +'\')">' + qty + '</p>');

            $('#'+edit+'').val(qty);
        }

    });
}
</script>
