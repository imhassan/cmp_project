<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h5>
			<a href="<?=base_url()?>admin/user/listing"><i
				class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
		</h5>
		<h1>
            Edit User - <?php echo $user_name;?>
          </h1>
		<!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
            <li class="active">Edit User</li>
          </ol> -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title"></h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" method="post"
						action="<?=base_url()?>admin/user/edit_user/<?php echo $user_id;?>">
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1">First Name</label> <input
									type="text" class="form-control" name="first_name"
									id="exampleInputEmail1" placeholder="First Name"
									value="<?php echo $first_name;?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Last Name</label> <input
									type="text" class="form-control" name="last_name"
									id="exampleInputEmail1" placeholder="Last Name"
									value="<?php echo $last_name;?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">User Name</label> <input
									type="text" class="form-control" name="user_name"
									id="exampleInputEmail1" placeholder="Group Name"
									value="<?php echo $user_name;?>">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label> <input
									type="password" class="form-control" name="user_password"
									id="exampleInputPassword1" autocomplete="false"
									placeholder="Enter password if you want to change">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail5">Email Address</label> <input
									type="text" class="form-control" name="email"
									id="exampleInputEmail5" placeholder="Email Address"
									value="<?php echo $email;?>" required>
							</div>

							<div class="form-group">
								<label>User Type</label> <select class="form-control"
									name="type">
									<option <?php if($type=='user'){echo "selected";}?> value="user">Web
										User</option>
									<option <?php if($type=='admin'){echo "selected";}?>
										value="admin">Admin User</option>
								</select>
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
				<!-- /.box -->

			</div>
			<!--/.col (left) -->
			<!-- right column -->

		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
