<?php

class Log_model extends CI_Model {

    function log_checkin($bk, $type, $action)
    {
        /*
         * Add a log entry 
         */
        
        // Handle situations where the botkey isn't populated
        if (!$bk)
        {
            $bk = '0';
        }
        
        $log = array(
            'log_date'      => 	date("Y-m-d H:i:s"),
            'log_botkey'    =>	$bk, // ID of the bot
            'log_type'      =>	$type,	// Code
            'log_action'    => 	$action // Action that took place
        );

        $this->db->insert('tblLog', $log);
    }

    function getLast5()
    {
        $this->db->order_by("log_date", "desc");
        $this->db->limit(5);
        return $this->db->get('tblLog');
    }

    function countCheckIns()
    {
        // Count checkins
        $query =  $this->db->get_where('tblLog', array('log_type' => '200'));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function getAllStopBots()
    {
    	$this->db->order_by("log_date", "desc");
        $this->db->where('log_type', '99'); // Type 99 are requests to stop the bot
        return $this->db->get('tblLog');
    }

    function getNCILogs()
    {
        // Gets all Log entries, except for CHECK-INs
    	$this->db->order_by("log_date", "desc");
        $this->db->where('log_type !=', '200'); // Do NOT get CHECK-IN log entries
        return $this->db->get('tblLog');
    }

    function countNCILogs()
    {
        // Count all Log entries, except CHECK-INs
       $this->db->from('tblLog');
       $this->db->not_like('log_type', '200');
       return $this->db->count_all_results();

    }

    function delLogs()
    {
        // Truncates the Log table
        $this->db->truncate('tblLog');
    }
    
}

/* End of file log_model.php */
/* Location: ./system/application/models/log_model.php */