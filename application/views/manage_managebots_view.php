<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="manage">Dashboard</a> &raquo;</li>
      <li><a href="manageapps">Manage Bots</a></li>
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
        <h1>Manage Bots</h1>
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
          <div class="notification warning"> <span class="strong">WARNING! </span> Deleting a Bot will automatically remove all associated apps and jobs</div>
          <div class="box-header"> All Bots </div>
          <div class="box table">
            <table cellspacing="0">
              <thead>
                <tr>
                  <td class="tc">#</td>
                  <td>Bot Name</td>
                  <td>Bot Key</td>
                  <td>Bot Private Key</td>
                  <td>Bot IP Address</td>
                  <td>Actions</td>
                </tr>
              </thead>
              <tbody>
              <?php $num = 0; ?>
              <?php foreach($bot_data->result() as $bot): ?>
                <tr>
                  <td class="tc"><?php $num = $num + 1; echo $num; ?></td>
                  <td> <?php echo $bot->bot_name; ?> </td>
                  <td><?php echo $bot->bot_key; ?></td>
                  <td><?php echo $bot->bot_privatekey; ?></td>
                  <td> <?php echo $bot->bot_ip; ?> </td>
                  <td class="tc"> <a href="<?php echo base_url().'login/delBot/'.$bot->bot_id.'/'.$token; ?>"> <img src="<?php echo base_url(); ?>/img/icons/small/Erase.png" alt="delete job" border="0" onclick="return confirm('Are you sure you want to delete this Bot?')" /> </a></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Table -->

















<?php if ($help == 1): ?>

        <!-- Start Formatting -->
        <div class="grid_4">
          <div class="box-header"> Quick View </div>
          <div class="box">
            <h2>Manage Bots</h2>
            <p>Use the table shown here to remove Bots from your PlugBot network.<br><br>Fields that have a red highlight are required. </p>
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