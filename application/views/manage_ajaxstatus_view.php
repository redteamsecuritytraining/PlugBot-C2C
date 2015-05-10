<?php
$st = $status;
if ($st == '1') { $status = 'Pending...'; echo $status; }
if ($st == '2') { $status = 'Running Job...'; echo $status; }
if ($st == '8') { $status = 'Output Saved to Bot'; echo $status; }
if ($st == '9') { $status = 'Interactive Job Initiated'; echo $status; }
if ($st == '10') { $status = 'Output Received'; echo $status; }
if ($st == '11') { $status = 'Dropzone Changed'; echo $status; }
if ($st == '12') { $status = 'Botnet Changed'; echo $status; }
?>