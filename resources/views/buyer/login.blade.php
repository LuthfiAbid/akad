@include('buyer.header')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container" style="box-shadow:1px 1px 5px lightgrey;padding:30px;margin-left:35%;margin-right:35%;width:auto;background-color:#FFFFFF;">
				<!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="breadcrumb-header" style="text-align:center;">Login AKAD</h3>
                    </div>
                </div>
                <br>
                <form class="form-auth-small" id="form-login" action="" method="get">
                    <label for="">Username</label>
                    <br>
                    <input type="text" id="username" class="col-xs-12" name="username" placeholder="Username">
                    <br>
                    <br>
                    <label for="">Password</label>
                    <br>
                    <input type="password" id="password" class="col-xs-12" name="password" placeholder="Password">
                    <br>
                    <br>
                    <button type="submit" style="width:100%;border:1px;height:35px;" class="btn-primary">Login</button>
                </form>
            </div>
			<!-- /container -->
        </div>

		@include('buyer.footer')

		<script>
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
                success: function (data) {

                    if(data == 1){
                        $.confirm({
                                title: 'Login!',
                                content: 'Login Success!',
                                type: 'green',
                                theme: 'light',
                                typeAnimated: true,
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
						// alert("Berhasil Masuk")
						// window.location.replace("{{url('buyer/home')}}");
                    }else{
                        $.confirm({
                                title: 'Alert Login!',
                                content: 'Undifined Username or Password!',
                                type: 'orange',
                                theme: 'light',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'Ok',
                                        btnClass: 'btn-orange',
                                        action: function(){
                                        }
                                    }
                                }
                            });
                    	// alert("Username dan Password tidak terdaftar");
                 	 }

                }
            });
        }

    })
		</script>
