		<!-- HEADER -->
		@include('buyer.header')
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		@include('sweet::alert')
		<!-- /HEADER -->
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
						@if ($message = Session::get('success'))
						<div class="w3-panel w3-green w3-display-container">
							<span onclick="this.parentElement.style.display='none'"
									class="w3-button w3-green w3-large w3-display-topright">&times;</span>
							<p>{!! $message !!}</p>
						</div>
						<?php Session::forget('success');?>
						@endif
				
						@if ($message = Session::get('error'))
						<div class="w3-panel w3-red w3-display-container">
							<span onclick="this.parentElement.style.display='none'"
									class="w3-button w3-red w3-large w3-display-topright">&times;</span>
							<p>{!! $message !!}</p>
						</div>
						<?php Session::forget('error');?>
						@endif
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img height="240" src="{{asset('productImages/shirt/1.jpg')}}" alt="">
							</div>						
							<div class="shop-body">
								<h3>collection<br>Upper clothes</h3>
								<a href="{{url('buyer/viewSelectedCategory/Shirt')}}" style="cursor:pointer" class="cta-btn">Show all<i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img height="240px" src="{{asset('productImages/dress/1.jpg')}}" alt="">
							</div>
							<div class="shop-body">
								<h3>collection<br>Down clothes</h3>
								<a href="{{url('buyer/viewSelectedCategory/Pants')}}" style="cursor:pinter" class="cta-btn">Show all<i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img height="240px" src="{{asset('productImages/pants/1.jpg')}}"" alt="">
							</div>
							<div class="shop-body">
								<h3>collection<br>Dress</h3>
								<a href="{{url('buyer/viewSelectedCategory/Dress')}}" style="cursor:pinter"" class="cta-btn">Show all <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
							<div class="section-nav">
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->

										@foreach ($goods as $goods)
										<div class="product" onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods->id_goods}}'" style="cursor:pointer;">
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
												<h4 class="product-price">Rp. {{number_format($goods->price,0,'.','.')}}<del class="product-old-price"></del></h4>
												<div class="product-rating">
												</div>
												<div class="product-btns">
													<button onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods->id_goods}}'" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
										</div>
										@endforeach

										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->

		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top Sell</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
												<li class="dropdown">
										<a href="#" data-toggle="dropdown">Clothes</a>
											<ul class="dropdown-menu">
												<li><a href="#">Shirt</a></li>
												<li><a href="#">Batik Shirts</a></li>
												<li><a href="#">T-shirt</a></li>
											</ul>
										</li>
										<li class="dropdown">
										<a href="#" data-toggle="dropdown">Koko Clothes</a>
											<ul class="dropdown-menu">
												<li><a href="#">Koko Clothes</a></li>
											</ul>
										</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										@foreach ($goodss as $goodss)
										<div class="product" onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goodss->id_goods}}'" style="cursor:pointer;">
											<div class="product-img">
												<img height="360" width="42" src="{{asset('productImages/shirt').'/'.$goodss->picture}}" alt="">
												<div class="product-label">
													<!-- <span class="sale">-30%</span> -->
													<!-- <span class="new">NEW</span> -->
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{$goodss->cat_name}}</p>
												<h3 class="product-name"><a href="#">{{$goodss->goods_name}}</a></h3>
												<h4 class="product-price">Rp. {{number_format($goodss->price,0,'.','.')}}<del class="product-old-price"></del></h4>
												<div class="product-rating">
												</div>
												<div class="product-btns">
													<button onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goodss->id_goods}}'" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
										</div>
										@endforeach
										<!-- /product -->
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
        <!-- /SECTION -->

                <!-- SECTION -->
                <div class="section">
                    <!-- container -->
                    <div class="container">
                        <!-- row -->
                        <div class="row">
                                <div class="col-md-4 col-xs-6">
                                        <div class="section-title">
                                            <h4 class="title">Top Sell</h4>
                                            <div class="section-nav">
                                                <div id="slick-nav-3" class="products-slick-nav"></div>
                                            </div>
                                        </div>
                                        <div class="products-widget-slick" data-nav="#slick-nav-3">
                                            @php
                                            $a = 0;
                                            @endphp
                                            @for ($i = 0; $i < 2; $i++)
                                            <div>
                                                @for ($c = 0; $c < 3; $c++)
                                                <div class="product-widget" onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods_w_ts[$a]->id_goods}}'" style="cursor:pointer;">
                                                    <div class="product-img">
                                                        <img src="{{asset('productImages/shirt').'/'.$goods_w_ts[$a]->picture}}" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">{{ $goods_w_ts[$a]->cat_name }}</p>
                                                        <h3 class="product-name"><a href="#">{{ $goods_w_ts[$a]->goods_name }}</a></h3>
                                                        <h4 class="product-price">Rp. {{number_format($goods_w_ts[$a]->price,0,'.','.')}}<del class="product-old-price"></del>
                                                        </h4>
                                                    </div>
                                                </div>

                                                @php
                                                    $a++;
                                                @endphp
                                        @endfor

                                    </div>
                                    @endfor


                        </div>
                    </div>
                    <div class="container">
                            <!-- row -->
                            <div class="row">
                                    <div class="col-md-4 col-xs-6">
                                            <div class="section-title">
                                                <h4 class="title">New Product</h4>
                                                <div class="section-nav">
                                                    <div id="slick-nav-4" class="products-slick-nav"></div>
                                                </div>
                                            </div>
                                            <div class="products-widget-slick" data-nav="#slick-nav-4">
                                                @php
                                                $a = 0;
                                                @endphp
                                                @for ($i = 0; $i < 2; $i++)
                                                <div>
                                                    @for ($c = 0; $c < 3; $c++)
                                                    <div class="product-widget"  onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods_w_np[$a]->id_goods}}'" style="cursor:pointer;">
                                                        <div class="product-img">
                                                            <img src="{{asset('productImages/shirt').'/'.$goods_w_np[$a]->picture}}" alt="">
                                                        </div>
                                                        <div class="product-body">
                                                            <p class="product-category">{{ $goods_w_np[$a]->cat_name }}</p>
                                                            <h3 class="product-name"><a href="#">{{ $goods_w_np[$a]->goods_name }}</a></h3>
                                                            <h4 class="product-price">Rp. {{number_format($goods_w_np[$a]->price,0,'.','.')}}<del class="product-old-price"></del>
                                                            </h4>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $a++;
                                                    @endphp
                                            @endfor

                                        </div>
                                        @endfor


                            </div>
                        </div>
                        <div class="container">
                                <!-- row -->
                                <div class="row">
                                        <div class="col-md-4 col-xs-6">
                                                <div class="section-title">
                                                    <h4 class="title">Product Branded</h4>
                                                    <div class="section-nav">
                                                        <div id="slick-nav-5" class="products-slick-nav"></div>
                                                    </div>
                                                </div>
                                                <div class="products-widget-slick" data-nav="#slick-nav-5">
                                                    @php
                                                    $a = 0;
                                                    @endphp
                                                    @for ($i = 0; $i < 2; $i++)
                                                    <div>
                                                        @for ($c = 0; $c < 3; $c++)
                                                        <div class="product-widget"  onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods_w_a[$a]->id_goods}}'" style="cursor:pointer;">
                                                            <div class="product-img">
                                                                <img src="{{asset('productImages/shirt').'/'.$goods_w_a[$a]->picture}}" alt="">
                                                            </div>
                                                            <div class="product-body">
                                                                <p class="product-category">{{ $goods_w_a[$a]->cat_name }}</p>
                                                                <h3 class="product-name"><a href="#">{{ $goods_w_a[$a]->goods_name }}</a></h3>
                                                                <h4 class="product-price">Rp. {{number_format($goods_w_a[$a]->price,0,'.','.')}}<del class="product-old-price"></del>
                                                                </h4>
                                                            </div>
                                                        </div>

                                                        @php
                                                            $a++;
                                                        @endphp
                                                @endfor

                                            </div>
                                            @endfor


                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /container -->
                </div>
                <!-- /SECTION -->

		@include('buyer.footer')

