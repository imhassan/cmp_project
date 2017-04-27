<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>All Questions</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header"></div>
					<div class="box-body">

<?php
$messages = $this->session->flashdata('validate');
if($messages){
	if($messages ['type'] == 'success'){
		$type = 'flashdiv-success';
	}else if($messages ['type'] == 'error'){
		$type = 'flashdiv-error';
	}else if($messages ['type'] == 'warning'){
		$type = 'flashdiv-warning';
	}
	?>
                                <div class="<?php echo $type; ?>">
							<div class="flash-nav-container">
								<div><?php echo $messages['message']; ?></div>
							</div>
						</div>
                        <?php }?>
                  <table id="list_table"
							class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Question</th>
									<th>Date</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
				<?php
				if($listings){
					foreach($listings as $list){
						?>
                      <tr>
									<td><?=$list['id']?></td>

									<td><?=$list['question_text']?></td>
									<td><?=print_date($list['created_at']) ?></td>
									<td><a href="<?=base_url();?>admin/questions/edit/<?=$list['id']?>"
										class="btn btn-warning btn-xs" data-toggle="tooltip"
										data-placement="top" title="Edit"> <i
											class="fa fa-pencil-square"></i>
									</a></td>
								</tr>
                      <?php
					}
				}
				?>
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

<script type="text/javascript">
      $(function () {
        $('#list_table').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "order": [[ 5, "desc" ]],
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
