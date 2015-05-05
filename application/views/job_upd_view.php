<?php
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
$this->output->set_header("Pragma: no-cache");
?>
<?php echo header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0"?>'; ?>
<jobs>
	<job>
		<id><?php echo $id; ?></id>
		<status><?php echo $status; ?></status>
	</job>
</jobs>
