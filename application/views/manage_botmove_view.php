<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>login/manage">Dashboard</a> &raquo;</li>
      <li><a href="<?php echo base_url(); ?>login/addbot">Edit Bot</a></li>
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
        <h1>Move Bot -> <?php echo $botname; ?></h1>
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
                <div class="notification warning"> <span class="strong">WARNING! </span>This will delete the bot/data and move it to another PlugBot botnet</div>
          <div class="box-header"> Bot Info </div>
          <div class="box">
            <form id="editbotform" name="editbotform" method="post" action="<?php echo base_url(); ?>login/doMoveBot">

              <div class="row">
                <label>Bot Dropzone URL</label>
                <input type="text" id="bot_dropzone" name="bot_dropzone" class="error app_tips" size="50" title="Enter a descriptive Bot name" />
                <input type="hidden" name="botkey" id="botkey" value="<?php echo $botkey; ?>" />              
                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
              </div>

              <div class="row">
                <label></label>
                <input type="submit" value="Move Bot" class="button" onclick="return confirm('Are you sure you want to move this Bot?')" />
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
            <h2>Move Bot</h2>
            <p>This option is used remotely move the bot to an entirely different PlugBot botnet. As a result, all bot and job data will be deleted! <br><br>Enter in the new C&C dropzone URL and the bot
                once the bot checks in, it will update its configuration and check in to the new PlugBot botnet.<br><br>Fields that have a red highlight are required. </p>
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