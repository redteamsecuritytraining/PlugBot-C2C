<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>login/manage">Dashboard</a> &raquo;</li>
      <li><a href="<?php echo base_url(); ?>login/sethelp">Set Help</a></li>
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
        <h1>Set Help</h1>
      </div>
      <!-- End Page Header -->

      <!-- Start Grid -->
      <div class="container_12">

        <!-- Start Table -->
        <div class="grid_12">
        <?php echo $this->session->flashdata('messages'); ?>
          <div class="box-header"> Set Help </div>
          <div class="box">
            <form method="post" action="<?php echo base_url(); ?>login/doChangeHelp">

                <div class="row">
                    <label>Enable Help?</label>

                    <?php if ($help == 1): ?>
                        <input type="checkbox" checked="checked" name="set_help" />
                    <?php endif; ?>
                    <?php if ($help == 0): ?>
                        <input type="checkbox" name="set_help"/>
                    <?php endif; ?>
                    <br class="cl" />
                </div>


                <label></label>
                <input type="submit" value="Save Setting" class="button" />
                <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />
              </div>

            </form>
          </div>
        </div>
        <!-- End Table -->





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