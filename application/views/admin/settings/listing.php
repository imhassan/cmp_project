<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Site Settings
          </h1>
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
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php
                            $messages = $this->session->flashdata('validate');

                            if ($messages) {
                                if ($messages['type'] == 'success') {
                                    $type = 'flashdiv-success';
                                } else if ($messages['type'] == 'error') {
                                    $type = 'flashdiv-error';
                                } else if ($messages['type'] == 'warning') {
                                    $type = 'flashdiv-warning';
                                }
                                ?>
                                <div class="<?php echo $type; ?>">
                                    <div class="flash-nav-container">
                                        <div>
                                            <?php echo $messages['message']; ?>
                                        </div>
                                    </div>
                                </div>
                        <?php }?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>value</th>
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
                        <td><?=$list['setting_key']?></td>
                        <td><?=$list['setting_value']?></td>                        
                        <td>
                            <a href="<?=base_url();?>admin/settings/edit/<?=$list['id']?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
                              <i class="fa fa-pencil-square"></i>
                            </a>
                        </td>
                      </tr>
                      <?php }
                      }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>value</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      