<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>/css/base.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>/css/jquery-ui.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>/css/grid.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>/css/visualize.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/excanvas.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/visualize.jQuery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/functions.js"></script>
<title>&#8709;</title>
</head>

<body>
<div id="login-wrapper">
<div class="box-header login">
<!--<span class="fr"><a href="#">Back to the site</a></span>-->
Login
</div>
<div class="box">

<!--<div class="notification tip">-->
<?php echo $this->session->flashdata('messages'); ?>
<form method="post" action="<?php echo base_url(); ?>index.php/login/doLogin" class="login">
  <div class="row">
    <label>Username:</label>
    <input type="text" value="" id="username" name="username" />
 </div>

  <div class="row">
    <label>Password:</label>
    <input type="password" id="password" name="password" value="" />
 </div>
   <div class="row tr">
<!--   <input type="checkbox" id="rememberme" checked="checked" class="checkbox" /> <label class="checkbox tl strong" for="rememberme" style="width:105px">Remember me</label>-->
    <input type="submit" value="Login" class="button" style="width:90px!important;" />
    </div>
 </form>

</div>
</div>

</body>
</html>