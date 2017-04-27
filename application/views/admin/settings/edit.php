<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h5><a href="<?=base_url()?>admin/settings"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></h5>
          <h1>
            Edit Site Setting
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
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="setting_key">Name</label>
                      <input type="text" class="form-control" name="setting_key" placeholder="Name" value="<?=$site_setting['setting_key']?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="setting_value">Value</label>
                      <input type="text" class="form-control" name="setting_value" placeholder="Value" value="<?=$site_setting['setting_value']?>" required>
                    </div>                                                           
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="id" value="<?=$site_setting['id']?>">
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      