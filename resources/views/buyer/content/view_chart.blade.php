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
    .qty .count2 {
    color: #000;
    display: inline-block;
    vertical-align: top;
    font-size: 20px;
    font-weight: 700;
    line-height: 30px;
    padding: 0 2px;
    min-width: 35px;
    text-align: center;
    background-color: #f6f5fa;
}
.qty .plus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    color: black;
    width: 30px;
    height: 30px;
    font: 30px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 50%;
    }
.qty .minus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    color: black;
    width: 30px;
    height: 30px;
    font: 30px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 50%;
    background-clip: padding-box;
}
div {
    text-align: center;
}
.minus:hover{
    background-color: #717fe0 !important;
}
.plus:hover{
    background-color: #717fe0 !important;
}
/*Prevent text selection*/
span{
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
input{
    border: 0;
    width: 2%;
}
nput::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input:disabled{
    background-color:white;
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
                            <td><p style="margin-top:90%;">{{$detail_transaction2->id_goods}}</p></td>
                            <td><img height="10%" width="40%"
                                    src="{{asset('productImages/shirt').'/'.$detail_transaction2->picture}}" alt="">
                            </td>
                            <td><p style="margin-top:35%;">{{$detail_transaction2->cat_name}}</p></td>
                            <td>
                                {{-- <p style="margin-top:40%;" id="goods_{{$detail_transaction2->id_detail}}" onclick="edit_stok('goods_{{$detail_transaction2->id_detail}}');" >{{$detail_transaction2->qty}}</p>
                                <input type="hidden" id="id_check_{{$detail_transaction2->id_detail}}" name="id_check" value="id_check_{{$detail_transaction2->id_detail}}"> --}}
                                <div class="qty mt-5" style="margin-top:30%">
                                    <span class="minus bg-dark" onclick="minus({{$detail_transaction2->id_detail}})">-</span>
                                    <input type="number" id="qty" class="count2 count_{{$detail_transaction2->id_detail}}" name="qty" value="{{$detail_transaction2->qty}}">
                                    <span class="plus bg-dark" onclick="plus({{$detail_transaction2->id_detail}})">+</span>
                                </div>
                            </td>
                            <td><p style="margin-top:35%;">Rp. {{number_format($detail_transaction2->subtotal,0,'.','.')}}</p></td>
                            <td><button style="margin-top:30%;" onclick="deleteDetail({{$detail_transaction2->id_detail}})" class="btn btn-danger"><i class="fa fa-close"></i></button></td>
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

$(document).ready(function(){


         });
    function plus($id){
                var count_plus = parseInt($('.count_'+$id+'').val()) + 1;
                $('.count_'+$id+'').val(count_plus);
                var qty = $("#count_"+$id+"").val()
                // alert(count_plus);
                updateQty($id,count_plus);
                refreshsum();
                }
        function minus($id){
                    var count_minus = parseInt($('.count_'+$id+'').val()) - 1;
                    $('.count_'+$id+'').val(count_minus);
    				if ($('.count_'+$id+'').val() == 0) {
                        $('.count_'+$id+'').val(1);
                    }
                    var qty = $("#count_"+$id+"").val()
                        // alert(count_minus);
                        updateQty($id,count_minus);
                        refreshsum();
                }

    function updateQty($id,$qty) {
            $.ajax({
                type: "get",
                url: "{{ url('buyer/updateQty') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    id_detail: $id,
                    qty: $qty
                },
                success: function (data) {
                    if(data == 1){
                        alert("Add success")
                    }else{
                        alert('gagal Add');
                    }
                }
            });
	}

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

</script>
