@include('buyer.header')

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Setting Profil AKAD</h3>
					</div>
				</div>
                <!-- /row -->
                         <div>
						 <form action="" method="post" id="form-setting">
						<!-- {{ csrf_field() }}
						{{ method_field('post') }} -->
                        <br>
                        <br>
                        <input type="hidden" value="{{$data_buyer->id_buyer}}" id="id_buyer" class="col-xs-4" name="id_buyer">
                        <label for="">Name</label>
                         <br>
                         <input type="text" value="{{$data_buyer->buyer_name}}" id="buyer_name" class="col-xs-4" name="buyer_name" placeholder="Name">
                        <br>
                        <br>
                        <label for="">Username</label>
                        <br>
                         <input type="text" value="{{$data_buyer->username}}" id="username" class="col-xs-4" name="username" placeholder="Username">
                        <br>
                        <br>
                        <label for="">New Password</label>
                        <br>
                        <input type="password" id="password" class="col-xs-4" name="password" placeholder="Password">
                        <br>
                        <br>
						<label for="">Address</label>
                        <br>
						<textarea name="address" id="address" cols="30" rows="3">{{$data_buyer->address}}</textarea>
                         <!-- <input type="text" id="address" class="col-xs-4" name="address" placeholder="Address"> -->
                        <br>
                        <br>
						<label for="">City</label>
                        <br>
                         <input type="text" id="city" value="{{$data_buyer->city}}" class="col-xs-4" name="city" placeholder="City">
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
		$("#form-setting").on('submit', function(e){
        e.preventDefault()
        var password;
            if($("#password").val()!=""){
                password = $("#password").val()
            }else{
                password = "no";
            }
            console.log(password)
       				 $.ajax({
						type: "post",
                		url: "{{ url('buyer/updateSettingBuyer') }}",
						data : {
                            _token : "{{csrf_token()}}",
                            id_buyer : $("#id_buyer").val(),
                            buyer_name : $("#buyer_name").val(),
                            username : $("#username").val(),
                            password : password,
                            address : $("#address").val(),
                            city : $("#city").val(),
                        },
                        success : function (data){

                          if(data == 1){
							alert('Setting Success')
                            window.location.replace("{{url('buyer/home')}}");
                          }else{
                            alert("error");
                          }

                        }
                  })

    })
    
		</script>
