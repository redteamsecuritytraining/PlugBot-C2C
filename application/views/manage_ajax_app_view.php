<OPTION SELECTED VALUE="">--Select App--</OPTION>
<?php foreach($app_data->result() as $app): ?>
    <option value="<?php echo $app->app_random; ?>"><?php echo $app->app_name; ?></option>
<?php endforeach;?>