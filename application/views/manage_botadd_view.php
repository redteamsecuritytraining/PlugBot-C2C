<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>login/manage">Dashboard</a> &raquo;</li>
      <li><a href="<?php echo base_url(); ?>login/addbot">Add Bot</a></li>
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
        <h1>Add Bot</h1>
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
            <div class="notification info"> <span class="strong">UNIQUE KEYS:&nbsp;&nbsp;&nbsp;</span> <?php echo mt_rand(); ?> and  <?php echo mt_rand(); ?></div>
          <div class="box-header"> App Info </div>
          <div class="box">
            <form id="addbotform" name="addbotform" method="post" action="<?php echo base_url(); ?>login/doAddBot">

              <div class="row">
                <label>Bot Key</label>
                <input type="text" id="bot_key" name="bot_key" class="error app_tips" size="50" title="Enter the Bot Key here. Must match the bot.It must be unique!" />
              </div>              
              <div class="row">
                <label>Bot Private Key</label>
                <input type="text" id="bot_privatekey" name="bot_privatekey" class="error app_tips" size="50" title="Enter the Bot Private Key. Must match the bot. It must be unique!" />
              </div>

              <div class="row">
                <label>Bot Name</label>
                <input type="text" id="bot_name" name="bot_name" class="error app_tips" size="50" title="Enter a descriptive Bot name" />
                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
              </div>

              <div class="row">
                <label>Add Base Apps?</label>
                <input name="addapps" type="radio" class="radio" value="yes" disabled />
                <label class="radio">Yes</label>
                <input name="addapps" type="radio" class="radio" checked="checked" value="no" disabled />
                <label class="radio">No</label>
                <br class="cl" />
              </div>

              <div class="row">
                <label></label>
                <input type="submit" value="Add Bot" class="button" />
              </div>

            </form>
          </div>
        </div>
        <!-- End Table -->



<?php if ($help == 1): ?>
        <!-- Start Formatting -->
        <div class="grid_4">
          <div class="box-header"> Quick View </div>
          <div class="box">
            <h2>Add Bot</h2>
            <p>Complete all of the information here to add a new bot. Bot Keys must be unique. For best results, please use the recommended bot key.<br><br>Fields that have a red highlight are required. </p>
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