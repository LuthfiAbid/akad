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
                            <li><a onclick="window.location.href='{{url('buyer/home')}}'" style="cursor:pointer;">Home</a></li>
                            @if ($category_name == "")

                            <li><a onclick="window.location.href='{{url('buyer/category')}}'" style="cursor:pointer;">All Categories ({{$count_data_goods}})</a></li>
                            @else
                            <li><a onclick="window.location.href='{{url('buyer/viewSelectedCategory')}}/{{$category_name}}'" style="cursor:pointer;">{{$category_name}}</a></li>
                            @endif

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
                                    @foreach ($category as $category)
								<div class="input-checkbox">
									<label for="category-1">∎</label>
									<label for="category-1">
										<span></span>
                                        <a onclick="window.location.href='{{url('buyer/viewSelectedCategory')}}/{{$category->category_name}}'">{{$category->category_name}}</a>
									</label>
                                </div>
                                    @endforeach
							</div>
						</div>
						<div class="aside">
                            <h3 class="aside-title">Top selling</h3>
                            @foreach ($goods_w_ts as $goods_w_ts)
							<div onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods_w_ts->id_goods}}'" style="cursor:pointer;" class="product-widget">
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
                            {{-- {{$count_goods}} --}}
                            @if (!empty($count_goods))
                                @if (empty($search))
                                <div>
                                        <label for="">Item Found ({{$count_goods}})</label>
                                </div>
                                @else
                                <div>
                                        <label for="">Item Found ({{$count_goods}})</label>
                                </div>
                                @endif


                            @foreach ($all as $no => $goods)
							<div onclick="window.location.href='{{url('buyer/getViewGoods')}}/{{$goods->id_goods}}'" style="cursor:pointer;" class="col-md-4 col-xs-6">

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
                            @else
                               <label for=""> Item Not Found </label>
                            @endif

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
