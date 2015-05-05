<?php foreach($app_data->result() as $app): ?>
    <option value="4">
        <?php if ($app->app_interactive == '2')
            {
                echo '<option selected value="4"> Interactive: There is no output to save</option>';
                /*
                 * Uncomment the lines below to offer other options for handling output. However,
                 * If the app is an interactive app, there should only be one option
                 */
                //echo '<option value="1">Save output to the local Bot Database</option>';
                //echo '<option value="2">Save output to the Bot Database and the DropZone Database</option>';
                //echo '<option value="3">Save output to the DropZone via FTP</option>';
            } else {
                /*
                 * Uncomment the last option. However, if the app is not an interactive
                 * app, there should be output and it must be handled somehow
                 */
                echo '<option selected value="">--Select Output--</option>';
                echo '<option value="1">Save output files locally on the Bot</option>';
                echo '<option value="2">Upload output to the C&C database</option>';
                //echo '<option value="3">Upload output to the C&C DropZone via FTP</option>'; // Removing this from the options
                // echo '<option value="4"> Interactive: There is no output to save</option>';
            }
        ?>
    </option>
<?php endforeach;?>