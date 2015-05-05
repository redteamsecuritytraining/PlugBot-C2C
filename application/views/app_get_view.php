<?php
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
$this->output->set_header("Pragma: no-cache");
?>
<?php echo header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0"?>'; ?>
<apps>
        <detail>
                <num><?php echo $num; ?></num>
        </detail>
	<?php foreach($apps->result() as $entry): ?>
	<app>
		<id><?php echo $entry->app_id; ?></id>
		<status><?php echo $entry->app_status; ?></status>
		<random><?php echo $entry->app_random; ?></random>
                <name><?php echo trim($entry->app_name); ?></name>
                <dir><?php echo trim($entry->app_dir); ?></dir>
                <exec><?php echo trim($entry->app_exec); ?></exec>
                <url><?php echo trim($entry->app_download); ?></url>
                <file><?php echo trim($entry->app_file); ?></file>
	</app>
	<?php endforeach; ?>
</apps>