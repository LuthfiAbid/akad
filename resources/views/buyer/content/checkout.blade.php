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
            <form class="w3-container w3-display-middle w3-card-4 w3-padding-16" action="{!! URL('buyer/updateTransaction') !!}" method="POST" id="payment-form">
                {{ csrf_field() }}
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
                </div>
                <!-- /Shiping Details -->

                <!-- Order notes -->
                <div class="order-notes">
                    <textarea class="input" name="description" placeholder="Order Notes"></textarea>
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
                        <div class="order-col" style="height: 20%;width: 100%;">
                            <div style="width: 80%;">{{$detail_transaction2->qty}}x {{$detail_transaction2->goods_name}}</div>
                            <div>Rp. {{number_format($detail_transaction2->subtotal,0,'.','.')}}</div>
                            <input type="hidden" name="id_transaction" value="{{$detail_transaction2->id_transaction}}">
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
                        {{-- {{csrf_token()}} --}}
                        <button type="submit" class="primary-btn order-submit col-md-12">Place Order</button>
                {{-- <a style="cursor:pointer;" onclick="updateTransaction()" class="primary-btn order-submit">Place order</a> --}}
                    </form>
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
    // function updateTransaction() {
    //     var id_transaction = $('#id_transaction').val();
    //     var total_price = $('#total_price').val();
    // $.ajax({
    //             type: "GET",
    //             url: "{{ url('buyer/updateTransaction') }}",
    //             data: {
    //                 _token: "{{csrf_token()}}",
    //                 id_transaction: id_transaction,
    //                 total_price: total_price
    //             },
    //             success: function (data) {
    //                 if(data == 1){
    //                     // alert("Oreder Success")
    //                     // location.reload();
    //                     $.confirm({
    //                             title: 'Transaction!',
    //                             content: 'Are you sure to order!',
    //                             type: 'green',
    //                             theme: 'modern',
    //                             typeAnimated: true,
    //                             buttons: {
    //                                 Ok: {
    //                                     text: 'Ok',
    //                                     btnClass: 'btn-green',
    //                                     action: function(){
    //                                          $.confirm({
    //                                             title: 'Alert Transaction!',
    //                                             content: 'Transaction Successfully!',
    //                                             type: 'green',
    //                                             theme: 'light',
    //                                             buttons: {
    //                                                 Ok: {
    //                                                     text: 'Ok',
    //                                                     btnClass: 'btn-green',
    //                                                     action: function(){
    //                                                         window.location.replace("{{url('buyer/home')}}");
    //                                                     }
    //                                                 }
    //                                             }
    //                                         });
    //                                     }
    //                                 },
    //                                 cancel: function () {
    //                                 }
    //                             }
    //                         });
    //                 }else{
    //                     alert('Order Failed');
    //                 }
    //             }
    //         });
// }
</script>
