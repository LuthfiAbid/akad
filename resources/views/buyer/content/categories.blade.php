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
							<li><a href="#">All Categories ({{$count_data_goods}})</a></li>
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
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">

								<div class="input-checkbox">
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Laptops
										<small>(120)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-2">
									<label for="category-2">
										<span></span>
										Smartphones
										<small>(740)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-3">
									<label for="category-3">
										<span></span>
										Cameras
										<small>(1450)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-4">
									<label for="category-4">
										<span></span>
										Accessories
										<small>(578)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-5">
									<label for="category-5">
										<span></span>
										Laptops
										<small>(120)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-6">
									<label for="category-6">
										<span></span>
										Smartphones
										<small>(740)</small>
									</label>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
                            <h3 class="aside-title">Top selling</h3>
                            @foreach ($goods_w_ts as $goods_w_ts)
							<div class="product-widget">
								<div class="product-img">
									<img src="{{asset('productImages/shirt').'/'.$goods_w_ts->picture}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">{{$goods_w_ts->cat_name}}</p>
									<h3 class="product-name"><a href="#">{{$goods_w_ts->goods_name}}</a></h3>
									<h4 class="product-price">Rp. {{number_format($goods_w_ts->price,0,'.','.')}}</del></h4>
								</div>
							</div>
                            @endforeach

						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<div class="row">
                            <!-- product -->
                            @foreach ($all as $no => $goods)
							<div class="col-md-4 col-xs-6">

								<div class="product" style="height:550px;">
									<div class="product-img">
										<img height="340" width="42" src="{{asset('productImages/shirt').'/'.$goods->picture}}" alt="">
										<div class="product-label">
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">{{$goods->category_name}}</p>
										<h3 class="product-name"><a href="#">{{$goods->goods_name}}</a></h3>
										<h4 class="product-price">Rp. {{number_format($goods->price,0,'.','.')}}</h4>

                                        <div class="product-rating">
                                            </div>
                                            <div class="product-btns">
                                                <button onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods->id_goods}}'" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                            </div>
									</div>
								</div>
                            </div>
                            @endforeach
							<!-- /product -->
                        </div>

                        <div align="center">
                                @php
                                echo $all->render();
                                @endphp
                            </div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

        @include('buyer.footer')
