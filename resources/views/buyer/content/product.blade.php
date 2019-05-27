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
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">All Categories</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Headphones</a></li>
                    <li class="active">{{$data_goods->goods_name}}</li>
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
            <!-- Product main img -->
            <div class="col-md-4 col-md-push-1">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="{{asset('productImages/shirt').'/'.$data_goods->picture}}" alt="">
                    </div>
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2 ">
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-6">
                <div class="product-details">
                    <h2 class="product-name">{{$data_goods->goods_name}}</h2>
                    <input type="hidden" id="id_goods" name="id_goods" value="{{$data_goods->id_goods}}">
                    <div>
                        <h3 class="product-price">Rp. {{number_format($data_goods->price,0,'.','.')}}<del
                                class="product-old-price"></del></h3>
                                <input type="hidden" id="price" name="price" value="{{$data_goods->price}}">
                        <span class="product-available">{{$data_goods->stock}} Stock</span>
                    </div>
                    <p>{{$data_goods->description}}</p>
                    <form id="form-goods" action="" method="get">
                    <div class="add-to-cart">
                        <div class="qty-label">
                            Qty
                            <input id="qty" name="qty" style="width:75px;" type="number">
                        </div>
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                    </div>
                </form>

                    <ul class="product-btns">
                        {{-- <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li> --}}
                    </ul>

                    <ul class="product-links">
                        <li>Category:</li>
                        <li><a href="#">{{$data_goods->cat_name}} </a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                        culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                        culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab2  -->

                        <!-- tab3  -->
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">New Products</h3>
                </div>
            </div>

            <!-- product -->
            @foreach ($goods as $goods)
            <div class="col-md-3 col-xs-6">

                <div class="product" onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods->id_goods}}'"
                    style="cursor:pointer;">
                    <div class="product-img">
                        <img height="360" width="42" src="{{asset('productImages/shirt').'/'.$goods->picture}}" alt="">
                        <div class="product-label">
                            <!-- <span class="sale">-30%</span> -->
                            <span class="new">NEW</span>
                        </div>
                    </div>
                    <div class="product-body">
                        <p class="product-category">{{$goods->cat_name}}</p>
                        <h3 class="product-name"><a href="#">{{$goods->goods_name}}</a></h3>
                        <h4 class="product-price">Rp. {{number_format($goods->price,0,'.','.')}}<del
                                class="product-old-price"></del></h4>
                        <div class="product-rating">
                        </div>
                        <div class="product-btns">
                            <button
                                onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods->id_goods}}'"><i
                                    class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
            <!-- /product -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->

@include('buyer.footer')

<script>
    $("#form-goods").on('submit', function(e){
    e.preventDefault()
    var id_goods = $('#id_goods').val();
    var qty = $('#qty').val();
    var price = $('#price').val();
    var subtotal = (qty * price).valueOf();
    // alert(id_goods +" = "+ qty +" + "+ price+" = "+ subtotal);
    if(qty == ""){
       alert("qty harus di isi!!!");
    } else {
        $.ajax({
            type: "get",
            url: "{{url('buyer/createTransaction')}}",
            data: {
                _token: "{{csrf_token()}}",
                id_goods: id_goods,
                qty: qty,
                subtotal: subtotal
            },
            success: function (data) {
                if(data == 1){
                    alert("Berhasil Ditabah di Chart")
                    location.reload();
                    // window.location.replace("{{url('buyer/viewChart')}}");
                }else{
                    alert("Gagal Ditambahkan");
                  }

            }
        });
    }

})
    </script>
