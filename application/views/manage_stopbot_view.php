<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="#">Settings</a> &raquo;</li>
      <li><a href="stopbot">Stop Bot</a></li>
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
        <h1>Stop Bot</h1>
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
        <div class="notification warning"> <span class="strong">WARNING! </span> After you stop a bot, you cannot re-start it from this interface.</div>
              <div class="box-header"> User Info </div>
              <div class="box">
                <form method="post" action="<?php echo base_url(); ?>login/doStopBot">
                  <div class="row">
                    <label>Select Bot</label>
                    <select name="bot_key" id="bot_key">
                        <OPTION SELECTED VALUE="">--Select Bot--</OPTION>
                        <?php foreach($bot_data->result() as $bot): ?>
                            <option value="<?php echo $bot->bot_key;?>"><?php echo $bot->bot_name; ?></option>
                        <?php endforeach;?>
                    </select>
                  </div>
                  <div class="row">
                    <label></label>
                    <input type="submit" value="Stop Bot" class="button" onclick="return confirm('Are you sure you want to stop this bot?')"/>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
                  </div>
                </form>
              </div>
        <!-- End Table -->



        <!-- Start Table -->
              <div class="box-header"> Stop Bot History </div>
              <div class="box table">
                <table cellspacing="0">
                  <thead>
                    <tr>
                      <td class="tc">#</td>
                      <td>Date</td>
                      <td>Bot</td>
                      <td>Action</td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $num = 0; ?>
                  <?php foreach($stopbot_data->result() as $log): ?>
                    <tr>
                      <td class="tc"><?php $num = $num + 1; echo $num; ?></td>
                      <td><?php echo $log->log_date; ?></td>
                      <td><?php echo $this->bot_model->getBotName($log->log_botkey); ?></td>
                      <td><?php echo $log->log_action; ?></td>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
              </div>              
        <!-- End Table -->
        </div>


 <?php if ($help == 1): ?>

        <!-- Start Formatting -->
        <div class="grid_4">
          <div class="box-header"> Quick View </div>
          <div class="box">
            <h2>Stop Bot</h2>
            <p>Use this feature to stop the bot from checking in for new jobs and applications. Stopping the bot will prevent it from receiving new job information. You may want to do this if your pen test engagement period has ended.<br><br>If you stop the bot, you can easily restart the it through its web-based management interface.</p>
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