<section id="page-head">
	<div class="container">
		<div class="row col-md-12">
			<div class="page-heading">
				<h1>Forget Password?</h1>
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
						<p>Enter your email address and we'll send you an email with
							instructions to reset your password.</p>
						<form method="post" class="form-group">
							<div class="form-input">
								<span class="fa fa-user form-control-feedback"></span> <input
									type="email" name="email" class="form-control"
									placeholder="Email" required>
							</div>

							<div class="form-input">
								<input type="submit" name="login" value="Submit">
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