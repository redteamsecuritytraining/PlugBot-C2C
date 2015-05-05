<?php
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
$this->output->set_header("Pragma: no-cache");
?>
<?php echo header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0"?>'; ?>
<jobs>
        <detail>
                <num><?php echo $num; ?></num>
        </detail>
	<?php foreach($jobs->result() as $entry): ?>
	<job>
		<id><?php echo $entry->job_id; ?></id>
		<name><?php echo $entry->job_name; ?></name>
		<status><?php echo $entry->job_status; ?></status>
		<random><?php echo $entry->job_random; ?></random>
                <apprandom><?php echo $entry->job_app_random; ?></apprandom>
                <command><?php echo $entry->job_command; ?></command>
                <output><?php echo $entry->job_output; ?></output>
	</job>
	<?php endforeach; ?>
</jobs>
