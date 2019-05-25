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
                        <br>
                        <br>
                        <label for="">Name</label>
                         <br>
                         <input type="text" id="name" class="col-xs-4" name="name" placeholder="Name">
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
                    <button type="submit" class="btn btn-primary">Save</button>
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
