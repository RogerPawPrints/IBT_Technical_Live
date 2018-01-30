
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>IBT</b></a>
      <img src="<?php echo base_url('img/IBT_LogoMain.jpg'); ?>" class="img-responsive"  > 
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   <?php if($this->session->flashdata('message')){?>
          <div class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>
    <p class="login-box-msg">Sign in to start your session</p>


<form method="post" action="<?php echo site_url('welcome/login'); ?>" name="data_register">
      <div class="form-group has-feedback">
      <input type="text" name="Username" class="form-control" placeholder="Username" required >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <input type="password" name="Password" class="form-control" placeholder="Password" required >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
       
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->

</body>
</html>

