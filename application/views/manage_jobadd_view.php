<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="manage">Dashboard</a> &raquo;</li>
      <li><a href="changePwd">Add Job</a></li>
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
        <h1>Add Job</h1>
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
          <div class="box-header"> Job Info </div>
          <div class="box">
            <form method="post" action="doAddJob">
              <div class="row">
                <label>Job Name</label>  
                <input type="text" id="job_name" name="job_name" class="error app_tips" size="32" title="Enter the job name here"/>
              </div>
              <div class="row">
                <label>Select Bot</label>
                <select name="job_botkey" id="job_botkey" class="error app_tips" title="Select the bot that will run this job">
                    <OPTION SELECTED VALUE="">--Select Bot--</OPTION>
                    <?php foreach($bot_data->result() as $bot): ?>
                        <option value="<?php echo $bot->bot_key;?>"><?php echo $bot->bot_name; ?></option>
                    <?php endforeach;?>
                </select>
              </div>
              <div class="row">
                <label>Select Application</label>
                <select name="job_app_random" id="job_app_random" class="app_tips" title="Select the app you wish to run">
                    
                </select>
              </div>

              <div class="row">
                <label>Job Command</label>
                <input type="text" id="job_command" name="job_command" class="error app_tips" size="50" title="Enter the command here"/>
              </div>

              <div class="row">
                <label>Job Output</label>
                <select id="job_output" name="job_output" class="error app_tips" title="Choose how the output will be handled "/>                    
                </select>
              </div>


              <div class="row">
              <div class="row">
                <label>Schedule</label>
                <input name="demoradio" type="radio" class="radio" checked="checked" disabled />
                <label class="radio">Run Now</label>
                <input name="demoradio" type="radio" class="radio" disabled />
                <label class="radio">Schedule</label>
                <br class="cl" />
              </div>
                <label></label>
                <input type="submit" value="Add Job" class="button" />
                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
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
            <h2>Add Job</h2>
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