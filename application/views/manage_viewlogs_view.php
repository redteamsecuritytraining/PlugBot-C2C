<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>login/manage">Dashboard</a> &raquo;</li>
      <li><a href="<?php echo base_url(); ?>login/viewlogs">View Logs</a></li>
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
        <h1>View All Logs</h1>
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

            <div class="box-header"> Utilities </div>
              <div class="box">
                <form method="post" action="<?php echo base_url(); ?>login/delLogs ">
                  <div class="row">
                    <label>Log: </label>
                   <input type="submit" value="Clear All Log Entries" class="button" onclick="return confirm('Are you sure you want to clear all logs?')"/>
                   <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />
                  </div>                  
                </form>
              </div>

          <div class="box-header"> Log Entries </div>
          <div class="box table">
            <table cellspacing="0">
              <thead>
                <tr>
                  <td>Date</td>
                  <td>Bot</td>
                  <td>Type</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach($log_entry->result() as $log): ?>
                <tr>
                    <td> <?php $time = strtotime($log->log_date); echo date('m/d/y g:i:s A', $time); ?> </td>
                    <td> <?php echo $this->bot_model->getBotName($log->log_botkey);    ?> </td>
                    <td> Code: <?php echo $log->log_type; ?> </td>
                    <td> <?php echo $log->log_action; ?> </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>              
          </div>
          <?php echo $this->pagination->create_links(); ?>
        </div>

        
        <!-- End Table -->





 <?php if ($help == 1): ?>

        <!-- Start Formatting -->
        <div class="grid_4">
          <div class="box-header"> Quick View</div>
          <div class="box">
            <h2>View All Logs</h2>
            <p>This view shows all log entries for all bots. This table could grow to be quite lengthy as Bot CHECK-INs occur quite frequently. See other Log options for a more subdued list.</p>
            <p>There are currently <b><a href="#"><?php echo $this->db->count_all('tblLog'); ?></a></b> log entries</p>
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