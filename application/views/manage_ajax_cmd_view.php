<?php foreach($app_data->result() as $app): ?>
<?php //<input type="text" id="job_command" name="job_command" class="error" size="60" value="<?php // echo $app->app_exec;  ?>
<?php echo $app->app_exec.' '; ?>
<?php endforeach;?>