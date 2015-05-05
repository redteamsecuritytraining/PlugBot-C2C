<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url().'/login/manage' ;?>">Dashboard</a> &raquo;</li>
      <li><a href="<?php echo base_url().'/login/managejobs' ;?>">Manage Jobs</a> &raquo;</li>
      <li><a href="#">Edit Job</a></li>
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
        <h1> Edit Job</h1>
      </div>
      <!-- End Page Header -->

      <!-- Start Grid -->
      <div class="container_12">

        <!-- Start Table -->
        <div class="grid_8">
        <?php echo $this->session->flashdata('messages'); ?>
          <div class="box-header"> Job Info </div>
          <div class="box">
            <form method="post" action="http://theplugbot.com/pb/login/doUpdateJob/<?php echo trim(xss_clean($this->uri->segment(3))) ?>"  >
              <div class="row">
                <label>Job Name</label>
                <input type="text" id="job_name" name="job_name" class="error" size="32" value="<?php echo $job_name; ?>" />
              </div>
              <div class="row">
                <label>Select Bot</label>
                <select name="job_botkey" id="job_botkey">
                    <OPTION SELECTED VALUE="<?php echo $bot_key; ?>"><?php echo $bot_name; ?></OPTION>
                    <?php foreach($bot_data->result() as $bot): ?>
                        <option value="<?php echo $bot->bot_key;?>"><?php echo $bot->bot_name; ?></option>
                    <?php endforeach;?>
                </select>
              </div>
              <div class="row">
                <label>Select Application</label>
                <select name="job_app_random" id="job_app_random">
                    <OPTION SELECTED VALUE="<?php echo $app_random; ?>"><?php echo $app_name; ?></OPTION>
                </select>
              </div>
              <div class="row">
                <label>Job Command</label>
                <input type="text" id="job_command" name="job_command" class="error" size="50" value="<?php echo $job_command; ?>"/>
              </div>
              <div class="row">


              <div class="row">
                <label>Select Output</label>
                <select name="job_output" id="job_output">
                    <?php
                        // selected value
                        if ($app_output == '1')
                        {
                            echo '<option selected value="1">Save output to the local Bot Database</option>';
                            echo '<option value="2">Save output to the Bot Database and the DropZone Database</option>';
                            echo '<option value="3">Save output to the DropZone via FTP</option>';
                            echo '<option value="4"> Interactive: There is no output to save</option>';
                        }

                        if ($app_output == '2')
                        {
                            echo '<option selected value="2">Save output to the Bot Database and the DropZone Database</option>';
                            echo '<option value="1">Save output to the local Bot Database</option>';
                            echo '<option value="3">Save output to the DropZone via FTP</option>';
                            echo '<option value="4"> Interactive: There is no output to save</option>';
                        }

                        if ($app_output == '3')
                        {
                            echo '<option selected value="3">Save output to the DropZone via FTP</option>';
                            echo '<option value="1">Save output to the local Bot Database</option>';
                            echo '<option value="2">Save output to the Bot Database and the DropZone Database</option>';
                            echo '<option value="4"> Interactive: There is no output to save</option>';
                        }

                        if ($app_output == '4')
                        {
                            echo '<option selected value="4"> Interactive: There is no output to save</option>';
                            echo '<option value="1">Save output to the local Bot Database</option>';
                            echo '<option value="2">Save output to the Bot Database and the DropZone Database</option>';
                            echo '<option value="3">Save output to the DropZone via FTP</option>';
                        }
                    ?>
                </select>
              </div>



              <div class="row">
                <label>Schedule</label>
                <input name="demoradio" type="radio" class="radio" checked="checked" disabled/>
                <label class="radio">Run Now</label>
                <input name="demoradio" type="radio" class="radio" disabled />
                <label class="radio">Schedule</label>
                <br class="cl" />
              </div>
                <label></label>
                <input type="submit" value="Update Job" class="button" />
              </div>

            </form>
          </div>
        </div>
        <!-- End Table -->






        <!-- Start Formatting -->
        <div class="grid_4">
          <div class="box-header"> Quick View </div>
          <div class="box">
            <h2>Edit Job</h2>
            <p>Complete all of the information here to issue a new job. Be sure to select the appropriate bot, in the event you are using more than one bot.<br><br>Fields that have a red highlight are required. </p>
          </div>
        </div>
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