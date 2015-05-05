<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>login/manage">Dashboard</a> &raquo;</li>
      <li>Job Output</li>
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
        <h1>Job Output</h1>
      </div>
      <!-- End Page Header -->

      <!-- Start Grid -->
      <div class="container_12">

        <!-- Start Table -->
        <div class="grid_12">
        <?php echo $this->session->flashdata('messages'); ?>
          <div class="box-header">Date: <?php $time = strtotime($job_date); echo date('n/d/y g:i:s A', $time); ?>
              <br>
                Name:  <?php echo $job_name; ?>
              <br>
                Command:  <?php echo $job_command; ?>
              <br>
          </div>
          <div class="box">

            <pre><?php echo ($job_output); ?></pre>
            

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