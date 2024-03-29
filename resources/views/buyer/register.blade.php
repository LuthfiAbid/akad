@include('buyer.header')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container" style="box-shadow:1px 1px 5px lightgrey;padding:30px;margin-left:35%;margin-right:35%;width:450px;background-color:#FFFFFF;">
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
                <input type="text" id="buyer_name" class="col-xs-12" name="buyer_name" placeholder="Name" required>
                <br>
                <br>
                <label for="">Username</label>
                <br>
                <input type="text" id="username" class="col-xs-12" name="username" placeholder="Username" required>
                <br>
                <br>
                <label for="">Password</label>
                <br>
                <input type="password" id="password" class="col-xs-12" name="password" placeholder="Password" required>
                <br>
                <br>
                <label for="">Address</label>
                <br>
                <textarea name="address" id="address" class="col-xs-12" cols="30" rows="3" required></textarea>
                <!-- <input type="text" id="address" class="col-xs-4" name="address" placeholder="Address"> -->
                <br>
                <br>
                <label for="">City</label>
                <br>
                <input type="text" id="city" class="col-xs-12" name="city" placeholder="City" required>
                <br>
                <br>
                <button type="submit" class="btn btn-primary" style="width:100%;border:4px;height:35px;">Save</button>
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
</div>
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
                            $.confirm({
                                title: 'Register!',
                                content: 'Register Success!',
                                type: 'green',
                                theme: 'light',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'Ok',
                                        btnClass: 'btn-green',
                                        action: function(){
                                            window.location.replace("{{url('buyer/login')}}");
                                        }
                                    }
                                }
                            });
							// alert('Register Succces')
                            // window.location.replace("{{url('buyer/login')}}");
                          }else{
                            alert("error");
                          }

                        }
                  })

    })

    </script>
