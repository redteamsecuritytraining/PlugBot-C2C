<?php

class Job_model extends CI_Model {

    function validateJob($job_id)
    {
        $this->db->where('job_id', $job_id);
        $query = $this->db->get('tblJob');

        if($query->num_rows > 0)
        {
            return true;
        } else {
            return false;
        }
    }

    function getStatus($id)
    {
        $this->db->where('job_id', $id);
        $query = $this->db->get('tblJob');

        if ($query->num_rows > 0)
            {
                $row = $query->row(); //takes only one result row
                $status = $row->job_status;
                return $status;
        } else {
                return 'Processing...';
        }
    }
    
    function getAllNewJobs($botkey)
    {
    	$this->db->order_by('job_id', 'desc');
        $this->db->where('job_status', '1');
        $this->db->where('job_botkey', $botkey);
        return $this->db->get('tblJob');
    }

    function getJob($status, $botkey, $id)
    {
        $this->db->where('job_status', $status);
        $this->db->where('job_botkey', $botkey);
        $this->db->where('job_id', $id);
        return $this->db->get('tblJob');    
    }

    function getJobOutput($id)
    {
        $this->db->where('job_status', 10);
        $this->db->where('job_id', $id);
        return $this->db->get('tblJob'); 
    }

    function countJobs($status, $botkey)
    {
        // Count jobs based on status
        $query =  $this->db->get_where('tblJob', array('job_status' => $status, 'job_botkey' => $botkey));
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    
    function getNewJobCount($botkey)
    {
        // Returns count of pending jobs
        $query =  $this->db->get_where('tblJob', array('job_status' => '1', 'job_botkey' => $botkey));
        $rowcount = $query->num_rows();
        return $rowcount;
    }


    function countAllInteractiveJobs()
    {
        $query =  $this->db->get_where('tblJob', array('job_status' => '9'));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function countAllJobsOnBot()
    {
        $query =  $this->db->get_where('tblJob', array('job_status' => '8'));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function countAllJobSavedToCC()
    {
        $query =  $this->db->get_where('tblJob', array('job_status' => '10'));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function countAllCompletedJobs($botkey)
    {

        $num = $this->db->query("SELECT job_id FROM tblJob WHERE job_botkey = '$botkey' AND job_status = 10 OR job_botkey = '$botkey' AND job_status = 9 OR job_botkey = '$botkey' AND job_status = 8 ");
        $count = $num->num_rows();
        return $count;

    }

    function addJob($job_name, $job_botkey, $job_app_random, $job_random, $job_status, $job_command, $job_output)
    {
        $job = array(
            'job_date'          =>      date("Y-m-d H:i:s"),
            'job_name'          => 	$job_name,
            'job_botkey'	=> 	$job_botkey,
            'job_app_random'	=>	$job_app_random,
            'job_random'	=>	$job_random,
            'job_output'	=>	$job_output,
            'job_status'	=> 	$job_status,
            'job_command'	=> 	$job_command
        );

        $this->db->insert('tblJob', $job);
    }

    function updateJob($id, $job_name, $job_botkey, $job_app_random, $job_random, $job_status, $job_command, $job_output)
    {
        // Locate the job to be updated
        $this->db->where('job_id', $id);

        $job = array(
            'job_name'          => 	$job_name,
            'job_botkey'	=> 	$job_botkey,
            'job_app_random'	=>	$job_app_random,
            'job_random'	=>	$job_random,
            'job_output'	=>	$job_output,
            'job_status'	=> 	$job_status,
            'job_command'	=> 	$job_command
        );

        $this->db->update('tblJob', $job);
    }
    
    function updateJobReceived($id, $botkey, $job_status)
    {
        // Locate the job to be updated
        $this->db->where('job_id', $id);
        $this->db->where('job_botkey', $botkey);

        $job = array(
            'job_status'  => 	$job_status,
        );

        $this->db->update('tblJob', $job);
    }    

    function getAllJobs()
    {
    	$this->db->order_by('job_status', '1');
        $this->db->order_by('job_id', 'desc');
        return $this->db->get('tblJob');
    }

    function getAllPendingJobs()
    {
    	$this->db->order_by('job_status', '2');
        return $this->db->get('tblJob');
    }

    function delJob($id)
    {
        // Delete job
        $this->db->where('job_id', $id);
        $this->db->delete('tblJob');
    }
    
    function delAllJobs()
    {
        // Deletes all jobs
        $this->db->truncate('tblJob');
    }    

    function getJobEdit($id)
    {
        $this->db->where('job_id', $id);
        return $this->db->get('tblJob');
    }


    function saveJobOutput($job_id, $output)
    {

        /*
         * Saves output POST from the bot
         */

        // Locate the job to be updated
        $this->db->where('job_id', $job_id);

        $job = array(
            'job_output'    => 	$output,
            'job_status'    => 	'10' // Status 10 means that job output has been uploaded
        );

        $this->db->update('tblJob', $job);
    }

}
