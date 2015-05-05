<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_in extends CI_Controller {

    function index()
    {
        /*
         * load blank page
         */
        echo '';
    }
	
    function checkin()
    {
        /*
        *  Bot Check-in
        *  
        *  Description:
        *  Bots phone home here to show that they have
        *  proper network access to do so
        *
        * Also downloads changes in Scheduling. At the time
        * of this comment, cron performs the Scheduling
        *   
        *  Usage:
        *  http://www.somedomain.com/pb/check_in/checkin/<BOT_KEY_HERE>
        *  
        */

        // Get the botkey from the URI
        $b_key = xss_clean($this->uri->segment(3));

        // Get bot ip from the URI
        $b_ip = xss_clean($this->uri->segment(4));
        
        // Error handle if its not a valid bot ip
        if (!$this->input->valid_ip($b_ip))
        {
            /*
             * If it's not a valid ip, just use this
             */
            
            $b_ip = '0.0.0.0'; // Couldn't get the IP address
        }        
        
        // Validate key
        $result = $this->bot_model->validateBot($b_key);

        // Process the check in
        if ($result and $b_ip)
        {
            $data['status'] = '200'; // OK code

            // Update bot ip
            $this->bot_model->updateIP($b_key, $b_ip);

            // Count schedule changes, if any
            $data['sched_num'] = $this->scheduler_model->countSchedulers($b_key);

            // Count num of jobs for pickup, if any
            $data['job_num'] = $this->bot_model->countJobs('1',$b_key); // All jobs with status of 1 and per this botkey

            // Count apps for pickup, if any
            $data['app_num'] = $this->app_model->countApps('1',$b_key);

            // Load view
            $this->load->view('checkin_view', $data);

            // log check in
            $this->log_model->log_checkin($b_key,'200','CHECK-IN: Bot check in from: '.$_SERVER['REMOTE_ADDR']);

        } else {
            
            if (!$b_key)
            {
                // Missing botkey in URI
                $data['status'] = '260'; // Error code	
                $this->log_model->log_checkin('0','260','CHECK-IN: Botkey missing in URI.');
                $this->load->view('checkin_view', $data);				
            } else {
                // Incorrect botkey
                $data['status'] = '250'; // Error code
                $this->log_model->log_checkin($b_key,'250','CHECK-IN: Botkey does not match!');
                $this->load->view('checkin_view', $data);			
            }
        }
    }
}

/* End of file check_in.php */
/* Location: ./application/controllers/check_in.php */