<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

    function index()
    {
        /*
         * Display nothing
         */

        echo '';
    }
        
    function receiveOutput()
    {
        /*
         * This receives output from the Bot to be
         * inserted into the correspondig job
         */

        // Get POST data and cleanse
        $output = xss_clean(trim($this->input->post('output')));
        $botkey = xss_clean(trim($this->input->post('botkey')));
        $job_id = xss_clean(trim($this->input->post('job_id')));


        // Validate botkey
        $result = $this->bot_model->validateBot($botkey);

        // Validate job record exists
        $result2 = $this->job_model->validateJob($job_id);

        if ($output != '' AND $result AND $result2)
        {
            // Save output to Job
            $this->job_model->saveJobOutput($job_id, $output);

            // Log action
            $this->log_model->log_checkin($botkey,'444','Received job output from Bot');

        } else {
            // Something went wrong
            $this->log_model->log_checkin('0','445','ERROR: tried to save job output');
        }

    }

    function get()
    {
        /*
         * Description:
         * this is used by bots to get their job information. Typically
         * new jobs that are ready to be picked up will have a status
         * of '1'
         * 
         * Usage:
         * http://www.somedomain.com/pb/job/get/<BOT_KEY_HERE>
         * 
         */

        // Get botkey from the URI
        $b_key = xss_clean($this->uri->segment(3));

        // Validate key
        $result = $this->bot_model->validateBot($b_key);	

        // Count jobs ready for pickup
//        $num = $this->bot_model->countJobs('1',$b_key);
        $num = $this->job_model->countJobs('1',$b_key);

        if ($result AND $num > 0 OR $result AND $schedule_num > 0)
        {
                // Key match and jobs available
                $this->log_model->log_checkin($b_key,'300','JOB: Displayed '.$num.' job(s).');
                $data['jobs'] = $this->job_model->getAllNewJobs($b_key);
                $data['num'] = $num;
                // $data['scheduler_num'] = $scheduler_num;
                $this->load->view('job_get_view', $data);	
        }

        if ($result AND $num == 0)
        {
                // Key match but no jobs to show
                $data['status'] = '320'; // No jobs
                $this->log_model->log_checkin($b_key,'320','JOB: No jobs to display.');
                $this->load->view('job_get_nothing_view');
        }

        if (!$result)
        {
                // Key doesn't match or is missing
                $this->log_model->log_checkin($b_key,'350','JOB: Botkey missing or mismatch!');
                $this->load->view('default_view'); // Display blank page
        }
    }
	
    function upd()
    {
        /*
         * Description:
         * This is used by bots to update the job_status
         * to signify that it has been received
         * 
         * Usage:
         * http://www.somedomain.com/pb/job/upd/<JOB_RECORD_ID_HERE>/<BOT_KEY_HERE>
         * 
         */

        //Get job_id from the URI
        $rec_id = xss_clean($this->uri->segment(3));

        //Get botkey from the URI
        $b_key = xss_clean($this->uri->segment(4));

        //Get job status from the URI; expect '2' or '4' or '1'
        $status = xss_clean($this->uri->segment(5));

        // Validate key
        $result_bkey = $this->bot_model->validateBot($b_key);

        // Validate record exists; gets rowcount
        $result_id = $this->bot_model->validateID($rec_id);

        if ($result_bkey AND $result_id AND $status)
        {

            // Update status
            if ($status == 1)
            {
                // If output should be saved to the PlugBot itself
                $data = array(
                    'job_status' => '8' // 1 = output saved to PB
                );
                
                $update_status = '8';
            }

            // Update status
            if ($status == 2)
            {
                // If output should be saved to DB
                $data = array(
                    'job_status' => '2' // 2 = Job received
                );
                
                $update_status = '2';
            }

            if ($status == 4)
            {
                // If job is interactive, there is no output
                $data = array(
                    'job_status' => '9' // 9 = Interactive job, no ouput
                );
                
                $update_status = '9';                
            }
            
            if ($status == 99)
            {
                // If job is interactive, there is no output
                $data = array(
                    'job_status' => '11' // 9 = Interactive job, no ouput
                );
                
                $update_status = '11';                
            }            
            
            // Update record
            $this->job_model->updateJobReceived($rec_id, $b_key, $update_status);
            
            // Log the event
            $this->log_model->log_checkin($b_key,'2','BOT: Bot received job.');

            // Load the xml view
            $data['id'] = $rec_id;

            if ($status == 4)
            {
                $data['status'] = '9'; // Job received by bot
                $this->load->view('job_upd_view',$data);
            }

            if ($status == 2)
            {
                $data['status'] = '2'; // Job received by bot
                $this->load->view('job_upd_view',$data);
            }

            if ($status == 99)
            {
                $data['status'] = '11'; // Job received by bot
                $this->load->view('job_upd_view',$data);
            }            
        }

        if (!$result_bkey OR !$result_id)
        {
            // Uh oh, either the bot or the job record doesn't exist

            // Log the event
            $this->log_model->log_checkin($b_key,'5','BOT: Bot could not update job!');

            // Load the xml view
            $data['id'] = $rec_id;
            $data['status'] = '5'; // ERROR
            $this->load->view('job_upd_view',$data);
        }
    }
}

/* End of file job.php */
/* Location: ./application/controllers/job.php */