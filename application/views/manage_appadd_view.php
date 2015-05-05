<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="manage">Dashboard</a> &raquo;</li>
      <li><a href="addapp">Add App</a></li>
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
        <h1>Add Application</h1>
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
          <div class="box-header"> App Info </div>
          <div class="box">
            <form id="addappform" name="addappform" method="post" action="doAddApp">
              <div class="row">
                <label>Select Bot</label>
                <select name="app_botid" id="app_botid" class="app_tips" title="Select a bot where you want to install this app">
                    <OPTION SELECTED VALUE="">--Select Bot--</OPTION>
                    <?php foreach($bot_data->result() as $bot): ?>
                        <option value="<?php echo $bot->bot_key;?>"><?php echo $bot->bot_name; ?></option>
                    <?php endforeach;?>
                </select>
              </div>

              <div class="row">
                <label>App Name</label>
                <input type="text" id="app_name" name="app_name" class="error app_tips" size="32" title="Enter a short name for the app" />
              </div>

              <div class="row">
                <label>App Description</label>
                <input type="text" id="app_description" name="app_description" class="error app_tips" size="50" title="Enter a short description" />
              </div>

              <div class="row">
                <label>App Download Link</label>
                <input type="text" id="app_download" name="app_download" class="error app_tips" size="50" value="http://" title="Enter URL to download app without the filename. For example: http://site.com/download" />
              </div>

              <div class="row">
                <label>Download Filename</label>
                <input type="text" id="app_file" name="app_file" class="error app_tips"  title="Example: hackme_app.zip" />
              </div>

              <div class="row">
                <label>App Executable</label>
                <input type="text" id="app_exec" name="app_exec" class="error app_tips" title="Enter the command to execute this app. For example: nmap" />
              </div>

              <div class="row">
                <label>Interactive App?</label>
                <select id="app_interactive" name="app_interactive" class="error app_tips" title="Select No if this app outputs data that will be saved"/>
                    <option selected value="1">No</option>
                    <option value="2">Yes</option>
                </select>
                <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />
              </div>

              <div class="row">
                <label></label>
                <input type="submit" value="Add Application" class="button" />
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
            <h2>Add App</h2>
            <p>Complete all of the information here to issue a new job. Be sure to select the appropriate bot, in the event you are using more than one bot.<br><br>Fields that have a red highlight are required. </p>
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