<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheduler Extends CI_Controller {

    function index()
    {
        // Load blank page
        $this->load->view('default_view');
    }
    
    function get()
    {
        /*
         * Query tblScheduler for all records pertaining to
         * that bot for schedule change requests
         */

        // Get botkey from the URI
        $b_key = xss_clean($this->uri->segment(3));

        // Validate botkey
	$result = $this->bot_model->validateBot($b_key);

        // Count jobs ready for pickup
	$num = $this->scheduler_model->countSchedulers($b_key);

        if ($result and $num > 0)
        {
            $data['scheduler'] = $this->scheduler_model->getAllNewScheduler($b_key);
            $this->load->view('scheduler_view', $data);

            // Log action
            $this->log_model->log_checkin($b_key,'400','SCHEDULE: Displayed '.$num.' schedule change(s).');

        }

        if ($result AND $num == 0)
        {
            // Log no schedule changes to display
            $this->log_model->log_checkin($b_key,'450','SCHEDULE: Nothing to display.');
        }

        if (!$result)
        {
            // Log invalid botkey
            $this->log_model->log_checkin($b_key,'400','SCHEDULE: Invalid botkey!');
        }
        
    }

    function upd()
    {
        /*
         * This updates the downloaded scheduler
         * record that has been downloaded by the bot
         * Usage:
         * http://www.somedomain.com/pb/scheduler/upd/<JOB_RECORD_ID_HERE>/<BOT_KEY_HERE>/<SCHEDULER_TYPE_HERE>
         */
        
        //Get scheduler_id from the URI
        $id = xss_clean($this->uri->segment(3));

        //Get botkey from the URI
        $botkey = xss_clean($this->uri->segment(4));

        //Get scheduler type from the URI
        $s_type = xss_clean($this->uri->segment(5));

        // Validate key
        $result_botkey = $this->bot_model->validateBot($botkey);

        // Validate record exists; gets rowcount
        $result_id = $this->scheduler_model->validateID($id);

        if ($result_botkey AND $result_id AND $s_type)
        {
            // Valid key and valid job record; update job_status = 2
            $data = array(
                        'scheduler_type' => '2' // 2 = Scheduler received
                    );

            // Update the record
            $this->db->where('scheduler_id', $id);
            $this->db->where('scheduler_botkey', $botkey);
            $this->db->update('tblScheduler', $data);

            // Log the event
            $this->log_model->log_checkin($botkey,'2','Bot: Bot received schedule.');

            // Log Killswitch event
            if ($s_type == '99')
            {
                $this->log_model->log_checkin($botkey,'999','Bot: REMOTE KILLSWITCH ENGAGED!');
            }

            // Load the xml view
            $data['id'] = $id;
            $data['botkey'] = $botkey;
            $data['status'] = '2'; // Scheduler received by bot
            $this->load->view('scheduler_upd_view',$data);

        }
    }

}
