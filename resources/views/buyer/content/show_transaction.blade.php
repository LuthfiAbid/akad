<!-- HEADER -->
@include('buyer.header')
<!-- /HEADER -->


<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Show Transaction</h3>
                <ul class="breadcrumb-tree">
                    <li>Home</li>
                    <li class="">Status Transaction</li>
                    <li class="active">Status Transaction</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-5">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Billing address</h3>
                    </div>
                    <div style="margin-left:-4.5%;" class="form-group col-md-12">
                        <div class="col-md-3">
                            <label for="">Fullname</label>
                        </div>
                        <div class="col-md-3">
                            <p> {{Session::get('buyer_name')}} </p>
                        </div>
                    </div>
                    <div style="margin-left:-4.5%;" class="form-group col-md-12">
                        <div class="col-md-3">
                            <label for="">Address</label>
                        </div>
                        <div class="col-md-3">
                            <p> {{Session::get('buyer_address')}} </p>
                        </div>
                    </div>
                    <div style="margin-left:-4.5%;" class="form-group col-md-12">
                        <div class="col-md-3">
                            <label for="">City</label>
                        </div>
                        <div class="col-md-3">
                            <p> {{Session::get('buyer_city')}} </p>
                        </div>
                    </div>
                    <div style="margin-left:-4.5%;" class="form-group col-md-12">
                            <div class="col-md-3">
                                <label for="">Description</label>
                            </div>
                            <div class="col-md-3">
                                <p> Description</p>
                            </div>
                        </div>
                </div>
                <!-- /Billing Details -->
            </div>

            <!-- Order Details -->
            <div class="col-md-7 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Your Order</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>PRODUCT</strong></div>
                        <div><strong>TOTAL</strong></div>
                    </div>
                    <div class="order-products">
                        @foreach ($detail_transaction as $detail_transaction2)
                        <div class="order-col" style="height: 20%;width: 100%;">
                            <div style="width: 15%;"><img width="60" height="80" src="{{asset('productImages/shirt').'/'.$detail_transaction2->picture}}" alt=""></div>
                            <div>{{$detail_transaction2->qty}}x {{$detail_transaction2->goods_name}}</div>
                            <div>Rp. {{number_format($detail_transaction2->subtotal,0,'.','.')}}</div>
                        </div>
                        @endforeach
                    </div>
                    <div class="order-col">
                        <div>Shiping Cost</div>
                        <div><strong>FREE</strong></div>
                    </div>
                    <div class="order-col">
                        <div><strong>
                                <h4>TOTAL</h4>
                            </strong></div>
                        <div id="sum3"></div>
                    </div>
                </div>

                <a style="cursor:pointer;" onclick="accept()" class="btn btn-success order-submit"><i class="fa fa-check"></i>
                    be accepted</a>
            </div>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- FOOTER -->
@include('buyer.footer')
<!-- /FOOTER -->
<script>
    function accept() {
        var id_transaction = $('#id_transaction').val();
        var total_price = $('#total_price').val();

                        $.confirm({
                            title: 'Alert Accepted!',
                            content: 'Accepted Successfully!',
                            type: 'green',
                            theme: 'light',
                            buttons: {
                                Ok: {
                                    text: 'Ok',
                                    btnClass: 'btn-green',
                                    action: function(){
                                        window.location.replace("{{url('buyer/statusTransaction')}}");
                        }
                    }
        }
    });
}
</script>
