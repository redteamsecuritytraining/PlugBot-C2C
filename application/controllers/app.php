<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App Extends CI_Controller {

    function index()
    {
        // Blank page
        $this->load->view('default_view');
    }

    function get()
    {
        /*
         * Description:
         * This is used by bots in order to pickup
         * any apps that have been installed
         *
         * Usage
         * http://theplugbot.com/pb/app/get/<BOTKEY>
         */
        
        // Get botkey from the URI
        $botkey = xss_clean($this->uri->segment(3));

        // Validate key
        $result = $this->bot_model->validateBot($botkey);

        // Count number of apps to be installed/downloaded
        $num = $this->app_model->countApps('1',$botkey); // Status of '1' means its ready for bot to pick up

        if ($result AND $num > 0)
        {
            // Key match and apps available
            $data['apps'] = $this->app_model->getAllNewApps($botkey);
            $data['num'] = $num;

            // Log action
            $this->log_model->log_checkin($botkey,'500','APP: Displayed '.$num.' app(s).');
            
            // Load the view
            $this->load->view('app_get_view', $data);
        }

        if (!$result)
        {
            // Log event
            $this->log_model->log_checkin($botkey,'540','APP: Botnet key mismatch!!');
            $this->load->view('app_get_nothing_view');
        }

    }

    function upd()
    {
       /*
        * Description:
        * This is used by bots to update the app_status
        * to signify that it has been received
        *
        * Usage:
        * http://www.somedomain.com/pb/app/upd/<APP_RECORD_ID_HERE>/<BOT_KEY_HERE>
        *
        */

        //Get app_id from the URI
        $app_id = xss_clean($this->uri->segment(3));

        // Get botkey from the URI
        $botkey = xss_clean($this->uri->segment(4));

        // Validate record exists; gets rowcount
        $result_id = $this->app_model->validateID($app_id);

        // Validate key
        $result_key = $this->bot_model->validateBot($botkey);

        if ($result_key AND $result_id)
        {
            // Valid key and valid bot record; update bot_status = 2
            $data = array(
                'app_status' => '2' // 2 = App received by bot
            );

            // Update the record
            $this->db->where('app_id', $app_id);
            $this->db->where('app_botid', $botkey);
            $this->db->update('tblApp', $data);

            // Log the event
            $this->log_model->log_checkin($botkey,'502','APP: Bot received application.');

            // Load the xml view
            $data['id'] = $app_id;
            $data['status'] = '2'; // App received by bot
            $this->load->view('app_upd_view',$data);
            
        }

        if (!$result_id OR !$result_key)
        {
            // Uh oh, something went wrong

            // Log action
            $this->log_model->log_checkin($botkey,'560','APP: Botkey or app_id mismatch!');

            // Load the xml view
            $data['id'] = $app_id;
            $data['status'] = '5'; // ERROR!!!
            $this->load->view('app_upd_view',$data);
        }
    }
}
