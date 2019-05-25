@include('buyer.header')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Login AKAD</h3>
					</div>
				</div>
                <!-- /row -->
                         <div>
                        <br>
						<br>
						<form class="form-auth-small" id="form-login" action="" method="get">
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
					<button type="submit" class="btn btn-primary">Login</button>
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
	// 	$(document).ready(function(){
	// 	$.ajax({
    //             type: "get",
    //             url: "{{url('buyer/home')}}",
    //             data: {
    //                 _token: "{{csrf_token()}}",
    //                 username: $('#username').val()
    //             },
    //             success: function (response) {
       
                    
    //             }
    //         });
	// });


		$("#form-login").on('submit', function(e){
        e.preventDefault()
        var username = $('#username').val();
        var password = $('#password').val();
        if(username == ""){
           alert("Username harus di isi!!!");
        } else if (password == "") {
			alert("Password harus di isi!!!");
        } else {
            $.ajax({
                type: "get",
                url: "{{url('buyer/login/loginPostBuyer')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    username: username,
                    password: password
                },
                success: function (response) {
       
                        alert("Berhasil Masuk")
						window.location.replace("{{url('buyer/home')}}");
                    
                }
            });
        }

    })
		</script>