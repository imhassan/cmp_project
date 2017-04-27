<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['site_name']?>  | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css" media="screen">
   .flashdiv-success,.flashdiv-error,.flashdiv-warning{line-height:28px;margin:10px;position:relative;color: #ffffff;padding: 0 5px}
    .flashdiv-success{background-color:#edb234;}.flashdiv-error{background-color:#FC5F5F;}
    .flashdiv-warning{background-color:#f6a828;}
    label.error{
      color: red;
    } 
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b><?=$setting['site_name']?> </b>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="text-center">
      <h4 class="text-uppercase font-bold m-b-0">Reset Password</h4>
        <p class="text-muted m-b-0 font-13 m-t-20">please reset your password.</p>
    </div>
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
    <form id="form" action="<?=base_url()?>admin/user/change_password/<?=$code?>" method="post">
      <div class="form-group has-feedback">
        <input type="password" id="password" name="user_password" class="form-control" placeholder="Pasword" required>
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="cpassword" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Change Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->
    <div class="row">
      <div class="col-sm-12 text-center">
        <p class="text-muted">Already have account?<a href="<?= base_url() ?>admin/user/login" class="text-primary m-l-5"><b>Sign In</b></a></p>
      </div>
    </div>

    <!-- <a href="<?= base_url() ?>admin/user/forgotpassword">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?= base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url() ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url() ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/validate/jquery.validate.min.js"></script>
<script>
  $(function () {
    $('#form').validate({
      rules : {
          confirm_password : {
              equalTo : "#password"
          }
      }
    }); 
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
