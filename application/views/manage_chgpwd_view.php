<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>login/manage">Dashboard</a> &raquo;</li>
      <li><a href="<?php echo base_url(); ?>login/changePwd">Change Password</a></li>
    </ul>
  </div>
  <!-- End Breadcrumbs -->
</div>








<!-- start page header -->
<div id="page-wrapper">
  <div class="page">

<?php include('includes/sidebar.php'); ?>

    <!-- Star Page Content  -->
    <div id="page-content">

      <!-- Start Page Header -->
      <div id="page-header">
        <h1>Change Password</h1>
      </div>
      <!-- End Page Header -->
      
      <!-- Start Grid -->
      <div class="container_12">

        <!-- Start Table -->
        <?php if ($help == 0): ?>
            <div class="grid_12">
        <?php endif; ?>
        <?php if ($help == 1): ?>
            <div class="grid_8">
        <?php endif; ?>
        <?php echo $this->session->flashdata('messages'); ?>
          <div class="box-header"> User Info </div>
          <div class="box">
            <form method="post" action="<?php echo base_url(); ?>login/doChangePassword">
              <div class="row">
                <label>New password</label>
                <input type="password" id="password" name="password" class="error"/>
              </div>
              <div class="row">
                <label>Confirm password</label>
                <input type="password" class="error" id="new_password" name="new_password" />
              </div>
              <div class="row">
                <label></label>
                <input type="submit" value="Change Password" class="button" />
                <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />
              </div>

            </form>
          </div>
        </div>
        <!-- End Table -->





<?php if ($help == 1): ?>

        <!-- Start Formatting -->
        <div class="grid_4">
          <div class="box-header"> Change Password </div>
          <div class="box">
            <h2>About</h2>
            <p> Although there are not restrictions on password strength, you are highly encouraged to choose a strong password.<br><br>Fields that have a red highlight are required. </p>
          </div>
        </div>
 <?php endif; ?>

        <br class="cl" />
        <!-- End Formatting -->






        <!-- End Grid -->
      </div>
      <!-- End Page Wrapper -->
    </div>
    <!-- End Page Content  -->
  </div>
</div>

<?php include('includes/footer.php'); ?>