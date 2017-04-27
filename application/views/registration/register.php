<section id="page-head">
	<div class="container">
		<div class="row col-md-12">
			<div class="page-heading">
				<h1>LOGIN</h1>
				<h4>Login Required</h4>
			</div>
		</div>
	</div>
</section>
<!--end main page heading-->
<section id="formSubmit">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="user-form">
					<div class="user-form-set">
						<h4>REGISTER</h4>
						<form method="post" class="form-group">
							<div class="form-input">
								<span class="fa fa-user form-control-feedback"></span> <input
									type="text" class="form-control" name="first_name"
									placeholder="First Name" required
									value="<?php printkey($post_data,'first_name');?>">
							</div>

							<div class="form-input">
								<span class="fa fa-user form-control-feedback"></span> <input
									type="text" class="form-control" name="last_name"
									placeholder="Last Name" required
									value="<?php printkey($post_data,'last_name');?>">
							</div>

							<div class="form-input">
								<span class="fa fa-user form-control-feedback"></span> <input
									type="text" class="form-control" name="email"
									placeholder="Email Address" required
									value="<?php printkey($post_data,'email');?>">
							</div>

							<div class="form-input">
								<span class="fa fa-unlock-alt form-control-feedback"></span> <input
									type="password" class="form-control" name="user_password"
									placeholder="Password" required>
							</div>

							<div class="form-input">
								<span class="fa fa-unlock-alt form-control-feedback"></span> <input
									type="password" class="form-control" name="confirm_password"
									placeholder="Confirm Password" required>
							</div>

							<div class="form-input">
								<span class="fa fa-user form-control-feedback"></span> <input
									type="text" class="form-control" name="phone"
									placeholder="Phone" required
									value="<?php printkey($post_data,'phone');?>">
							</div>


							<div class="form-input hide">
								<input type="checkbox"> <label>Remember me</label>
							</div>
							<div class="form-input">
								<input type="submit" name="register" value="Register Now">
							</div>
						</form>
						<div class="social-login hide">
							<h4>LOGIN VIA SOCIAL ACCOUNT</h4>
							<div class="social-accounts">
								<a href="#"> <i class="fa fa-facebook"></i>
								</a> <a href="#"> <i class="fa fa-twitter"></i>
								</a> <a href="#"> <i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>