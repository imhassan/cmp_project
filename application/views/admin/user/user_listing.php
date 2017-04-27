<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>User List</h1>
		<!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol> -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<!-- <h3 class="box-title">Data Table With Full Features</h3> -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Score</th>
									<th>Game Life</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
                        <?php foreach($user_list as $user):?>
                      <tr>
									<td><a href="https://facebook.com/<?php echo $user['fb_id'];?>"
										target="_blank">
											<div class="leaderboard-img"
												style="float: left; margin-right: 5px;">
												<img src="<?php echo getProfileImage($user);?>" width="50">
											</div><?=$user['first_name']?> <?=$user['last_name']?>
										</a></td>
									<td><?=$user['email']?></td>
									<td><?=$user['score']?></td>
									<td><?=$user['game_life']?></td>

									<td><a
										href="<?php echo base_url()?>admin/user/edit_user/<?php echo $user['id'];?>"
										class="btn btn-warning btn-xs" data-toggle="tooltip"
										data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
										<a
										href="<?php echo base_url()?>admin/user/delete_user/<?php echo $user['id'];?>"
										class="btn btn-danger btn-xs" data-toggle="tooltip"
										data-placement="top" title="delete"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
                      <?php endforeach;?>
                    </tbody>

						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
