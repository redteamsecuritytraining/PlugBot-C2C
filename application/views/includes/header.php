<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>/css/base.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>/css/jquery-ui.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>/css/grid.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>/css/visualize.css" />

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>

<!--Highcharts stuff-->
<script src="https://ajax.googleapis.com/ajax/libs/mootools/1.3.0/mootools-yui-compressed.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/js/adapters/mootools-adapter.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/js/highcharts.js" type="text/javascript"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>/js/excanvas.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/visualize.jQuery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/functions.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.tipTip.minified.js"></script>


<title>&#8709;</title>
</head>
<body>

<!-- start header -->
<div id="header">
  <div class="header-top tr">
    <p>Hello <strong> <?php echo strtoupper($this->session->userdata('username')); ?></strong> | <a href="<?php echo base_url(); ?>login/logout">Logout</a></p>

    <?php /*
    <!-- start dialogue box -->
    <div id="dialog" title="Last 5 Log Entries">
     
      <!-- start log -->
      <?php foreach($log_data->result() as $log): ?>
          <div class="message">
            <h4><?php $time = strtotime($log->log_date); echo date('n/d/Y g:i:s A', $time); ?>     <small class="fr"> <?php echo $botname = $this->bot_model->getBotName($log->log_botkey); ?> <a href="#"> Code <?php echo $log->log_type; ?></a></small></h4>
            <p> <?php echo $log->log_action; ?></p>
          </div>
      <?php endforeach;?>
      <!-- end log view -->

    </div>
    <!-- end dialogue box -->
     * 
     */ ?>



  </div>
  <div class="header-middle">
    <!-- Start Nav -->
    <ul id="nav" class="fr ">
      <!-- Nav - Start Help -->
      <li class="help"><a class="help" href="#">Help</a>
        <ul>
          <li><a href="<?php echo base_url(); ?>login/about">About</a></li>
          <li><a href="<?php echo base_url(); ?>login/license">License</a></li>
        </ul>
      </li>
      <!-- Nav - End Help -->


      <!-- Nav - Start Content -->
      <li class="content"><a class="content" href="#">Logs</a>
        <ul>
 
                <li><a href="<?php echo base_url(); ?>login/viewlogs">View All Logs</a></li>
                <li><a href="<?php echo base_url(); ?>login/viewlogsnci">Supress Check-Ins</a></li>
        </ul>
      </li>
      <!-- Nav - End Content -->
      <!-- Nav - Start Settings -->
      <li class="dashboard"><a class="dashboard" href="#">Settings</a>
        <ul>
           <li><a href="<?php echo base_url(); ?>login/changePwd">Change Password</a></li>
           <li><a href="<?php echo base_url(); ?>login/sethelp">Help Setting</a></li>
          <li><a href="<?php echo base_url(); ?>login/stopbot">Stop Bot</a></li>
        </ul>
      </li>
      <!-- Nav - End Settings -->
      <!-- Nav - Start Help -->
      <li class="settings"><a class="settings" href="<?php echo base_url(); ?>login/manage">Dashboard</a></li>
      <!-- Nav - End Dashboard -->
    </ul>
    <!-- End Nav -->
    <!-- Start Logo -->
    <a href="<?php echo base_url().'login/manage' ?>"><img id="logo" src="<?php echo base_url(); ?>/img/logo.png" alt="The PlugBot" /></a>
    <!-- End Logo -->
    <br class="cl" />
  </div>
<!-- end header -->