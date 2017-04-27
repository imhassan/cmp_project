<section id="page-head">
	<div class="container">
		<div class="row col-md-12">
			<div class="page-heading">
				<h1>Reset Password?</h1>
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
						<p>Reset your password.</p>
						<form method="post" class="form-group" id="form">
							<div class="form-input">
								<span class="fa fa-unlock-alt form-control-feedback"></span> <input
									type="password" id="password" name="user_password"
									class="form-control" placeholder="Pasword"
									data-validation="required">
							</div>

							<div class="form-input">
								<span class="fa fa-unlock-alt form-control-feedback"></span> <input
									type="password" id="cpassword" name="confirm_password"
									class="form-control" placeholder="Confirm Password"
									data-validation="required">
							</div>

							<div class="form-input">
								<input type="submit" name="Change_Password"
									value="Reset Password">
							</div>
						</form>

						<p>
							Are you a new here? <a
								href="<?php echo base_url('user/register'); ?>" class="col">Get
								Register Free</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
  $(function () {
	  $.validate({
		  
	  });
 
  });
</script>