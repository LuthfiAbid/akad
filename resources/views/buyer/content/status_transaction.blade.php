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
        height: 250px;
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

</style>
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- product -->
                <table class="table" width="100%" style="float: left;" id="aaa_table">
                    <thead id="aaa_thead">
                    </thead>
                    <tbody align="center" id="aaa_tbody">
                        <tr align="center">
                            <td width="5%"><b>
                                    <font color="">No Transaction</font>
                                </b></td>
                            <td width="20%"><b>
                                    <font color="">Name</font>
                                </b></td>
                            <td width="10%"><b>
                                    <font color="">Price</font>
                                </b></td>
                            <td width="10%"><b>
                                    <font color="">Buy at</font>
                                </b></td>
                            <td width="10%"><b>Action</b></td>
                        </tr>
                        @foreach ($transaction as $transaction)
                        <tr>
                            <td>{{$transaction->id_transaction}}</td>
                            <td>{{$transaction->buyer_name}}</td>
                            <td>Rp. {{number_format($transaction->total_price,0,'.','.')}}</td>
                            <td>{{$transaction->created_at}}</td>
                            <td><button onclick="window.location.href='{{url('buyer/showTransaction')}}/{{$transaction->id_transaction}}'" title="Show Transaction" class="btn btn-primary"><i class="fa fa-eye"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <h5 id="sum2"></h5> --}}
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

