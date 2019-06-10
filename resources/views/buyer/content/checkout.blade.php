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
                <h3 class="breadcrumb-header">Checkout</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Checkout</li>
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

            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Billing address</h3>
                    </div>
                    <div style="margin-left:-4.5%;" class="form-group col-md-12">
                        <div class="col-md-2">
                            <label for="">Fullname</label>
                        </div>
                        <div class="col-md-3">
                            <p> {{Session::get('buyer_name')}} </p>
                        </div>
                    </div>
                    <div style="margin-left:-4.5%;" class="form-group col-md-12">
                        <div class="col-md-2">
                            <label for="">Address</label>
                        </div>
                        <div class="col-md-3">
                            <p> {{Session::get('buyer_address')}} </p>
                        </div>
                    </div>
                    <div style="margin-left:-4.5%;" class="form-group col-md-12">
                        <div class="col-md-2">
                            <label for="">City</label>
                        </div>
                        <div class="col-md-3">
                            <p> {{Session::get('buyer_city')}} </p>
                        </div>
                    </div>
                </div>
                <!-- /Billing Details -->

                <!-- Shiping Details -->
                <div class="shiping-details">
                    <div class="section-title">
                        <h3 class="title">Shiping address</h3>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="shiping-address">
                        <label for="shiping-address">
                            <span></span>
                            Ship to a diffrent address?
                        </label>
                        <div class="caption">
                            <div class="form-group">
                                <input class="input" type="text" name="first-name" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="address" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="city" placeholder="City">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Shiping Details -->

                <!-- Order notes -->
                <div class="order-notes">
                    <textarea class="input" placeholder="Order Notes"></textarea>
                </div>
                <!-- /Order notes -->
            </div>

            <!-- Order Details -->
            <div class="col-md-5 order-details">
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
                        <div class="order-col">
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
                        <div><strong>TOTAL</strong></div>
                        <div id="sum3"></div>
                    </div>
                </div>
                <div class="payment-method">
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-1">
                        <label for="payment-1">
                            <span></span>
                            Direct Bank Transfer
                        </label>
                        <div class="caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-2">
                        <label for="payment-2">
                            <span></span>
                            Cheque Payment
                        </label>
                        <div class="caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-3">
                        <label for="payment-3">
                            <span></span>
                            Paypal System
                        </label>
                        <div class="caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="input-checkbox">
                    <input type="checkbox" id="terms">
                    <label for="terms">
                        <span></span>
                        I've read and accept the <a href="#">terms & conditions</a>
                    </label>
                </div>
                <a style="cursor:pointer;" onclick="updateTransaction()" class="primary-btn order-submit">Place order</a>
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
    function updateTransaction() {
        var id_transaction = $('#id_transaction').val();
        var total_price = $('#total_price').val();
    $.ajax({

                type: "get",
                url: "{{ url('buyer/updateTransaction') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    id_transaction: id_transaction,
                    total_price: total_price
                },
                success: function (data) {
                    if(data == 1){
                        // alert("Oreder Success")
                        // location.reload();
                        $.confirm({
                                title: 'Transaction!',
                                content: 'Are you sure to oder!',
                                type: 'green',
                                theme: 'modern',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'Ok',
                                        btnClass: 'btn-green',
                                        action: function(){
                                             $.confirm({
                                                title: 'Alert Transaction!',
                                                content: 'Transaction Successfully!',
                                                type: 'green',
                                                theme: 'light',
                                                buttons: {
                                                    Ok: {
                                                        text: 'Ok',
                                                        btnClass: 'btn-green',
                                                        action: function(){
                                                            window.location.replace("{{url('buyer/home')}}");
                                                        }
                                                    }
                                                }
                                            });
                                        }
                                    },
                                    cancel: function () {
                                    }
                                }
                            });
                    }else{
                        alert('Order Failed');
                    }
                }
            });
}
</script>
