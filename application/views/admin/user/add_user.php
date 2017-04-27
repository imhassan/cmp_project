<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add New User
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
            <li class="active">Add New User</li>
          </ol>
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
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="add_form" role="form" method="post" action="">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" class="form-control" name="first_name" id="exampleInputEmail1" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail2">Last Name</label>
                      <input type="text" class="form-control" name="last_name" id="exampleInputEmail2" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">User Name</label>
                      <input type="text" class="form-control" name="user_name" id="exampleInputEmail3" placeholder="User Name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" class="form-control" name="user_password" id="exampleInputPassword4" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail5">Email Address</label>
                      <input type="text" class="form-control" name="email" id="exampleInputEmail5" placeholder="Email Address" required>
                    </div>
                      <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Authentication Pin</label>
                      <input type="text" class="form-control" name="auth_pin" id="exampleInputEmail1" placeholder="Authentication Pin" value="<?php echo rand(0,9999);?>">
                    </div> -->
                      
                    <!-- <div class="form-group">
                      <label>Group</label>
                      <select class="form-control" name="group_id_fk" required>
                          <?php foreach($group_list as $group){?>
                        <option value="<?=$group['group_id'];?>"><?=$group['group_title'];?></option>
                          <?php }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Branch</label>
                      <select class="form-control" name="branch_id_fk">
                          <?php $sess = get_logged_session();
                          if($sess['login_group_id']!='11'){?>
                            <option value="">Branch Less</option>
                          <?php }?>
                        <?php foreach($branch_list as $branch){?>
                        <option value="<?=$branch['branch_id'];?>"><?=$branch['branch_code'].'-'.$branch['branch_name'];?></option>
                          <?php }?>
                      </select>
                    </div> -->
                    <div class="form-group">
                      <label>User Type</label>
                      <select class="form-control" name="type">
                        <option value="web">Web User</option>
                        <option value="admin">Admin User</option>
                      </select>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <script type="text/javascript">
        $(document).ready(function(){
          //custom validation rule
          $.validator.addMethod("customemail", 
              function(value, element) {
                  return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
              }, 
              "Please enter valid email address"
          );
          $('#add_form').validate({             
            rules: {
                email: {
                    required: true,
                    customemail: true,
                    email: true,
                    remote: {
                        url: "<?=base_url()?>admin/user/check_email",
                        type: "post"
                     }
                },
                user_name: {
                    required: true,
                    remote: {
                        url: "<?=base_url()?>admin/user/check_username",
                        type: "post"
                     }
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address.",
                    remote: "Email already in use!"
                },
                user_name: {
                    required: "Please enter username.",
                    remote: "Username already in use!"
                }
            }
          });
        });
      </script>
      