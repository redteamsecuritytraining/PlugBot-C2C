<?php
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
$this->output->set_header("Pragma: no-cache");
?>
<?php echo header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0"?>'; ?>
<jobs>
    <meta>
        <scheduler><?php echo $sched_num; ?></scheduler>
        <jobnum><?php echo $job_num; ?></jobnum>
        <appnum><?php echo $app_num; ?></appnum>
    </meta>
    <job>
        <status><?php echo $status; ?></status>
    </job>
</jobs>