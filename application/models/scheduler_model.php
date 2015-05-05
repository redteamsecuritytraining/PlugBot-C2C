<?php

class Scheduler_model Extends CI_Model {

    function countSchedulers($botkey)
    {
    	/*
         * This performs a count of records in the tblScheduler
         * table. If there are any records in the table, that means
         * that there is a pending request to change the crontable
         * on the plugbot. If it's empty, there aren't any request
         * for change
         */

        $this->db->where('scheduler_botkey', $botkey);
        $this->db->where('scheduler_type', '1'); // Type 1 = waiting to be picked up
        $this->db->or_where('scheduler_type', '99'); // Type 99 = pickup and STOP the scheduler
        $query = $this->db->get('tblScheduler');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function getAllNewScheduler($botkey)
    {
        /*
         * Gets all pending requests for change
         * in Scheduling
         */

        $this->db->where('scheduler_type', '1'); // Type 1 = request to be picked up
        $this->db->or_where('scheduler_type', '99'); // Type 99 = pickup and STOP the scheduler
        $this->db->where('scheduler_botkey', $botkey);
        return $this->db->get('tblScheduler');
    }

    function getSchedule($status, $botkey, $id)
    {
        $this->db->where('scheduler_type', $status);
        $this->db->where('scheduler_botkey', $botkey);
        $this->db->where('scheduler_id', $id);
        return $this->db->get('tblScheduler');
    }

    function validateID($id)
    {
        // Validate that the scheduler_id exists
        $query =  $this->db->get_where('tblScheduler', array('scheduler_id' => $id));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function stopBot($botkey)
    {
        $schedule = array(
            'scheduler_type'    => 	'99', // Signifies a request to stop the scheduler
            'scheduler_botkey'  => 	$botkey,
            'scheduler_minute'  =>      '*',
            'scheduler_hour'    => 	'*',
            'scheduler_dom'     => 	'*',
            'scheduler_month'   => 	'*',
            'scheduler_dow'    => 	'*',
            'scheduler_command'    => 	'STOP SCHEDULER' // Command to stop cron for www-data user
        );

        $this->db->insert('tblScheduler', $schedule);
    }

}