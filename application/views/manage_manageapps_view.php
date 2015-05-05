<?php //include('includes/header.php'); ?>

<!--<script type="text/javascript">
 $(document).ready(function() {
 	 $("#responsestatus").load("ajaxappstatus").fadeIn("slow");
        $("#responsestatus").fadeIn("slow");

   var refreshId = setInterval(function() {
      $("#responsestatus").load('ajaxappstatus/<?php //echo $app->app_id; ?>');
   }, 5000);

});
</script>

<script type="text/javascript">
 $(document).ready(function() {
 	 $("#responseaction").load("ajaxappactions");

   var refreshId = setInterval(function() {
      $("#responseaction").load('ajaxappactions/<?php //echo $app->app_id; ?>');
   }, 5000);

});
</script>-->

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="manage">Dashboard</a> &raquo;</li>
      <li><a href="manageapps">Manage Apps</a></li>
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
        <h1>Manage Applications</h1>
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
            <div class="notification tip"> <span class="strong">TIP:</span> Click <a href="addapp">HERE</a> to add a new application </div>
        <?php endif; ?>                
          <div class="box-header"> All Applications </div>
          <div class="box table">
            <table cellspacing="0">
              <thead>
                <tr>
                  <td>App Name</td>
                  <td>Bot</td>
                  <td>Status</td>
                  <td>Actions</td>
                </tr>
              </thead>
              <tbody>
              <?php $cnt = 0; ?>
              <?php foreach($app_data->result() as $app): ?>
                <tr>
                  <td> <?php echo $app->app_name; ?> </td>
                  <td> <?php echo $this->bot_model->getBotName($app->app_botid); ?> </td>
                  <?php /* 
                  <td id="responsestatus_<?php $cnt = $cnt +1; echo $cnt;  ?>">
                       <div align="center"><img src="<?php echo base_url().'img/icons/small/loading.gif'; ?>" alt="Loading..." title="Loading..." /></div>
                  
                      <script type="text/javascript">
                           var refreshId = setInterval(function() {
                          // $("#responsestatus_<?php  echo $cnt; ?>").load('ajaxappstatus/<?php  echo $app->app_id; ?>');
                       }, 2000);
                      </script>
                  </td>
                  */ ?>
                  <td><?php if ($this->app_model->getStatus($app->app_id) == '1') { echo 'Pending...';}; if ($this->app_model->getStatus($app->app_id) == '2') { echo 'Installed';} ?></td>
                 <?php /*
                  <td class="tc" id="responseaction_<?php $cnt = $cnt+1; echo $cnt; ?>">
                  <div align="center"><img src="<?php echo base_url().'img/icons/small/loading.gif'; ?>" alt="Loading..." title="Loading..." /></div>
                      <script type="text/javascript">
                           var refreshId = setInterval(function() {
                          $("#responseaction_<?php echo $cnt; ?>").load('ajaxappactions/<?php echo $app->app_id; ?>');
                       }, 2000);
                      </script>
                  </td>
                  */ ?>
                  <td><?php if ($this->app_model->getStatus($app->app_id) == '1'): ?>
                            <img src="<?php echo base_url(); ?>img/icons/small/loading.gif" border="0" alt="Pending..." />
                       <?php endif;?>
                            <a href="<?php echo base_url().'login/delApp/'.$app->app_id.'/'.$token; ?>" title="Delete App"><img src="<?php echo base_url(); ?>/img/icons/small/Erase.png" onclick="return confirm('Are you sure you want to delete this App?')"  alt="Delete job" border="0" /></a></td>
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
            <h2>Manage Applications</h2>
            <p>Shown here is a table listing of the installed apps and scripts. Apps with a status of <b>Pending</b> indicate that it is waiting to be retrieved by the respective Bot. Some applications may be deleted however some pre-installed apps cannot be deleted. </p>
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