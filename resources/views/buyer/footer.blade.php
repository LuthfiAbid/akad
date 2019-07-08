<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Tulis Pendapat <strong> Anda</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Tulis Pendapat Anda">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Send</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /NEWSLETTER -->

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">About Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut.</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>Kl kedoya</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>akadstore@gmail.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Categories</h3>
                        <ul class="footer-links">
                            <li><a href="#">Pakaian</a></li>
                            <li><a href="#">Aksesori</a></li>
                            <li><a href="#">Makanan & Minuman</a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Information</h3>
                        <ul class="footer-links">
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Kontak Kami</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->
        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{URL::asset('buyer/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('buyer/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('buyer/js/slick.min.js')}}"></script>
<script src="{{URL::asset('buyer/js/nouislider.min.js')}}"></script>
<script src="{{URL::asset('buyer/js/jquery.zoom.min.js')}}"></script>
<script src="{{URL::asset('buyer/js/main.js')}}"></script>
<script src="{{URL::asset('buyer/js/jquery-confirm.js')}}"></script>

<script>
    $( document ).ready(function() {


        refreshsum();

        })
        function refreshsum(){
        var id_transaction = $('#id_transaction').val();
            $.ajax({
                type: "get",
                url: "{{ url('buyer/viewCountSubtotal') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    id_transaction: id_transaction
                },
                dataType : 'json',
                success: function (data) {

                    var count = data.data_count;
                    var sum2 = data.data_sum;

                    var	number_string = sum2.toString(),
                        sisa 	= number_string.length % 3,
                        sum 	= number_string.substr(0, sisa),
                        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        sum += separator + ribuan.join('.');
                    }

                    if (count == 0) {
                        $('#count').html('<small>0 Item(s) selected</small>');
                        $('#count2').html('<div class="qty">0</div>');
                        $('#sum').html('<h5">SUBTOTAL: Rp. 0</h5>');
                        $('#sum2').html('<h3 align="right">SUBTOTAL: Rp. 0</h3>');
                        $('#sum3').html('<strong class="order-total">RP. 0</strong><input type="hidden" id="total_price" name="total_price" value="0">');

                    }else{
                        $('#count').html('<small>'+count+' Item(s) selected</small>');
                        $('#count2').html('<div class="qty">'+count+'</div>');
                        $('#sum').html('<h5>SUBTOTAL: Rp. '+sum+'</h5>');
                        $('#sum2').html('<h3 align="right">SUBTOTAL: Rp. '+sum+'</h3>');
                        $('#sum3').html('<strong class="order-total">Rp. '+sum+'</strong><input type="hidden" id="total_price" name="total_price" value='+sum2+'>');
                    }
                }

        });
    }
    $("#form-search").on('submit', function(e){
        e.preventDefault()
        var search = $("#search").val();
       		$.ajax({
			    type: "get",
                url: "{{ url('buyer/searchCategory') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    search: search
                },
                success : function (data){
                    //   if(data == 1){
                    //        window.location.replace("{{url('buyer/login')}}");
                    //   }else{
                    //         alert("error");
                    //     }
                    }
                  })

    })


        function viewChart() {
            window.location.replace("{{url('buyer/viewChart')}}");
        }

        function viewCheckout() {
            window.location.replace("{{url('buyer/viewCheckout')}}");
        }

        $('a.logout_confirm').confirm({
            title: 'Logout!',
            content: 'Are you sure to Logout?',
            type: 'red',
            theme: 'dark',
            boxWidth: '500px',
            useBootstrap: false,
            typeAnimated: true,
            buttons: {
                Logout: {
                    text: 'Logout',
                    btnClass: 'btn-red',
                    action: function(){
                        logout_buyer();
                    }
                },
                close: function () {
                }
            }
        });

		function logout_buyer() {
		var id_logout = $('#id_logout').val();
            $.ajax({
                type: "get",
                url: "{{ url('buyer/logout') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    id_logout: id_logout
                },
                success: function (response) {
                    $.confirm({
                        title: 'Alert!',
                        content: 'Logout Success!',
                        type: 'red',
                        theme: 'dark',
                        typeAnimated: true,
                        buttons: {
                            Ok: {
                                text: 'Ok',
                                btnClass: 'btn-red',
                                action: function(){
                                    window.location.replace("{{url('buyer/home')}}");
                                }
                            }
                        }
                    });
                }
            });

	}

    function deleteDetail($id_detail) {
        $.confirm({
            title: 'Delete?',
            content: 'Are you sure Delete data?',
            type: 'red',
            theme: 'dark',
            boxWidth: '500px',
            useBootstrap: false,
            typeAnimated: true,
            buttons: {
                Yes: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                     $.ajax({
                            type: "post",
                            url: "{{ url('buyer/deleteDetail') }}",
                            data: {
                                _token: "{{csrf_token()}}",
                                id_detail: $id_detail
                            },
                            success: function (data) {
                                if(data == 1){
                                    $.confirm({
                                    title: 'Data Deleted!',
                                    content: 'Deleted Success!',
                                    type: 'red',
                                    theme: 'dark',
                                    typeAnimated: true,
                                    buttons: {
                                        Ok: {
                                            text: 'Ok',
                                            btnClass: 'btn-red',
                                            action: function(){
                                                location.reload();
                                            }
                                        }
                                        }

                                });
                                }else{
                                    alert('gagal delete');
                                }
                            }
                        });
                    }
                },
                No: function () {
                }
            }
        });

    }
</script>
</body>

</html>
