@include('buyer.header')

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Register AKAD</h3>
					</div>
				</div>
                <!-- /row -->
                         <div>
						 <form action="" method="POST" id="form-register">
						{{ csrf_field() }}
						{{ method_field('post') }}
                        <br>
                        <br>
                        <label for="">Name</label>
                         <br>
                         <input type="text" id="buyer_name" class="col-xs-4" name="buyer_name" placeholder="Name">
                        <br>
                        <br>
                        <label for="">Username</label>
                        <br>
                         <input type="text" id="username" class="col-xs-4" name="username" placeholder="Username">
                        <br>
                        <br>
                        <label for="">Password</label>
                        <br>
                        <input type="password" id="password" class="col-xs-4" name="password" placeholder="Password">
                        <br>
                        <br>
												<label for="">Address.</label>
                        <br>
												<textarea name="address" id="address" cols="30" rows="3"></textarea>
                         <!-- <input type="text" id="address" class="col-xs-4" name="address" placeholder="Address"> -->
                        <br>
                        <br>
												<label for="">City</label>
                        <br>
                         <input type="text" id="city" class="col-xs-4" name="city" placeholder="City">
                        <br>
                        <br>
                    <button type="submit" class="btn btn-primary">Save</button>
					</form>
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
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		@include('buyer.footer')
		<script>
		$("#form-register").on('submit', function(e){
        e.preventDefault()
       				 $.ajax({
						type: "post",
                		url: "{{ url('buyer/registerBuyer') }}",
						data : new FormData(this),
                        contentType :false,
                        cache : false,
                        processData : false,
                        success : function (data){

                          if(data == 1){
							alert('Register Succces')
                            window.location.replace("{{url('buyer/login')}}");
                          }else{
                            alert("error");
                          }

                        }
                  })

    })
    
		</script>
