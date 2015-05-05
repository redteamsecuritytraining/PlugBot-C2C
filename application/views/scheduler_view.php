<?php
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
$this->output->set_header("Pragma: no-cache");
?>
<?php echo header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0"?>'; ?>
<schedulers>
    <?php foreach($scheduler->result() as $entry): ?>
    <schedule>
        <id><?php echo $entry->scheduler_id; ?></id>
        <type><?php echo $entry->scheduler_type; ?></type>
        <min><?php echo $entry->scheduler_minute; ?></min>
        <hour><?php echo $entry->scheduler_hour; ?></hour>
        <dom><?php echo $entry->scheduler_dom; ?></dom>
        <month><?php echo $entry->scheduler_month; ?></month>
        <dow><?php echo $entry->scheduler_dow; ?></dow>
        <cmd><?php echo $entry->scheduler_command; ?></cmd>
    </schedule>
    <?php endforeach; ?>
</schedulers>