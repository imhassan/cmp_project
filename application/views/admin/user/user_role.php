<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Role
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User Roles</a></li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="<?=base_url()?>admin/user/user_role/<?php echo $user_id_encoded;?>">
                        <div class="box-body">

                            <?php foreach($user_role_list as $role_module_key => $role_module_value){?>
                            <div class="row">
                            <div class="form-group">
                                <label><?php echo ucfirst($role_module_key);?></label>
                            </div>
                            <?php foreach($role_module_value as $role_key => $role){?>
                            
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input name="user_role[]" class="cls_user_role" type="checkbox" <?php if($role['user_role_status']=='yes'){echo "checked";}?> value="<?php echo $role['role_module'].'##'.$role['role_name']?>">
                                        </span>
                                        <input type="text" class="form-control" readonly=""  value="<?php echo $role['role_description'];?>">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->

                           
                            <?php  }?> </div>
                                
                            <?php  }?>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="action" value="update role">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
