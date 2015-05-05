<?php

class App_model Extends CI_Model {

    function getApp($appid, $botkey)
    {
        $this->db->where('app_id', $appid);
        $this->db->where('app_botid', $botkey);
        return $this->db->get('tblApp');
    }

    function countApps($status, $botkey)
    {
    	// Count jobs based on status
        $query =  $this->db->get_where('tblApp', array('app_status' => $status, 'app_botid' => $botkey));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function countAllApps($status)
    {
    	// Count all jobs based on status
        $query =  $this->db->get_where('tblApp', array('app_status' => $status));
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    
    function getAllNewApps($botkey)
    {
    	$this->db->order_by('app_id', 'desc');
        $this->db->where('app_status', 1); // Status of '1'; waiting to be picked up by bot
        $this->db->where('app_botid', $botkey);
        return $this->db->get('tblApp');
    }

    function getAllApps($botkey)
    {
        $this->db->where('app_status', '2'); // Status of 2; installed
        $this->db->where('app_botid', $botkey);
        return $this->db->get('tblApp');
    }

    function getAllAppsNoKey()
    {
        $this->db->order_by('app_status', 'asc');
        $this->db->order_by('app_name', 'asc');
        return $this->db->get('tblApp');
    }

    function validateID($id)
    {
        $query =  $this->db->get_where('tblApp', array('app_id' => $id));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function getAppName($app_random)
    {
        // Get the name of the bot
        $query = $this->db->query('SELECT app_name FROM tblApp WHERE app_random='.$app_random.';');
        $row = $query->row(); //takes only one result row
        $app_name = $row->app_name;
        return $app_name;
    }

    function delApp($id)
    {
        // Delete job
        $this->db->where('app_id', $id);
        $this->db->delete('tblApp');
    }

    function addApp($app_botkey, $app_name, $app_description, $app_download, $app_file, $app_interactive, $app_exec, $app_random, $app_status)
    {
        $app = array(
            'app_botid'         => 	$app_botkey,
            'app_name'          => 	$app_name,
            'app_desc'          => 	$app_description,
            'app_download'      => 	$app_download,
            'app_file'          => 	$app_file,
            'app_interactive'   =>      $app_interactive,
            'app_exec'          => 	$app_exec,
            'app_random'        => 	$app_random,
            'app_status'        => 	$app_status,
        );

        $this->db->insert('tblApp', $app);
    }

    function getAppCmd($app_random)
    {
        $this->db->where('app_random', $app_random);
        return $this->db->get('tblApp');
    }

    function getAppInteractive($app_random)
    {
        $this->db->where('app_random', $app_random);
        return $this->db->get('tblApp');
    }

    function addPreinstallApps($bot_key)
    {
        /*
         * This adds pre-installed apps to the
         * apps table
         */

        // PHP Reverse Shell
        $phpreverseshell = array(
            'app_botid'         => 	$bot_key,
            'app_name'          => 	'PHP Reverse Shell',
            'app_desc'          => 	'Pre-installed PHP Reverse Shell',
            'app_download'      => 	'N/A',
            'app_file'          => 	'N/A',
            'app_interactive'   =>      '2', // Yes, this is interactive
            'app_exec'          => 	'start.sh [IP] [PORT]',
            'app_random'        => 	'1000',
            'app_status'        => 	'2',
        );
        $this->db->insert('tblApp', $phpreverseshell);

        // nmap
        $nmap = array(
            'app_botid'         => 	$bot_key,
            'app_name'          => 	'nmap',
            'app_desc'          => 	'Pre-installed nmap',
            'app_download'      => 	'N/A',
            'app_file'          => 	'N/A',
            'app_interactive'   =>      '0', // Non interactive
            'app_exec'          => 	'start.pl [NMAP ARGUMENTS]',
            'app_random'        => 	'1001',
            'app_status'        => 	'2',
        );
        $this->db->insert('tblApp', $nmap);

        // sqlmap
        $sqlmap = array(
            'app_botid'         => 	$bot_key,
            'app_name'          => 	'sqlmap',
            'app_desc'          => 	'Pre-installed sqlmap',
            'app_download'      => 	'N/A',
            'app_file'          => 	'N/A',
            'app_interactive'   =>      '0', // Non interactive
            'app_exec'          => 	'start.pl [SQLMAP ARGUMENTS]',
            'app_random'        => 	'1002',
            'app_status'        => 	'2',
        );
        $this->db->insert('tblApp', $sqlmap);

        // nbtscan
        $nbtscan = array(
            'app_botid'         => 	$bot_key,
            'app_name'          => 	'nbtscan',
            'app_desc'          => 	'Pre-installed nbtscan',
            'app_download'      => 	'N/A',
            'app_file'          => 	'N/A',
            'app_interactive'   =>      '0', // Non interactive
            'app_exec'          => 	'nbtscan [NBT ARGUMENTS]',
            'app_random'        => 	'1003',
            'app_status'        => 	'2',
        );
        $this->db->insert('tblApp', $nbtscan);
    }

    function getStatus($id)
    {
        $this->db->where('app_id', $id);
        $query = $this->db->get('tblApp');

        if ($query->num_rows > 0)
            {
                $row = $query->row(); //takes only one result row
                $status = $row->app_status;
                return $status;
        } else {
                return 'Processing...';
        }
    }
}