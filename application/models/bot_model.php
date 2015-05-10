<?php

class Bot_model extends CI_Model {
    
    function validateBot($botkey)
    {
        $this->db->where('bot_key', $botkey);
        $query = $this->db->get('tblBot');

        if($query->num_rows > 0)
        {
                return true;
        } else {
                return false;
        }
    }

    function getBotID($botkey)
    {
        $query = $this->db->query('SELECT bot_id FROM tblBot WHERE bot_key='.$botkey.';');
        
        if ($query->num_rows== 1)
        {
            $row = $query->row(); //takes only one result
            $bot_id = $row->bot_id;   
            return $bot_id; 
        } else {
            return false;
        }    
    }
    
    function getPrivateKey($botkey)
    {
        $query = $this->db->query('SELECT bot_privatekey FROM tblBot WHERE bot_key='.$botkey.';');
        
        if ($query->num_rows== 1)
        {
            $row = $query->row(); //takes only one result
            $bot_privatekey = $row->bot_privatekey;   
            return $bot_privatekey;
        } else {
            return false;
        }    
    }
    
    function getBotKey($id)
    {
        $query = $this->db->query('SELECT bot_key FROM tblBot WHERE bot_id='.$id.';');
        
        if ($query->num_rows== 1)
        {
            $row = $query->row(); //takes only one result
            $item = $row->bot_key;   
            return $item;
        } else {
            return false;
        }    
    }    
    
    function countJobs($status, $botkey)
    {
        // Count jobs based on status
        $query =  $this->db->get_where('tblJob', array('job_status' => $status, 'job_botkey' => $botkey));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function validateID($id)
    {
        // Count jobs based on status
        $query =  $this->db->get_where('tblJob', array('job_id' => $id));
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function updateIP($botkey, $ip)
    {
        // Format data as an IP address
        $underscore = '_';
        $dot   = '.';
        $ip = str_replace($underscore, $dot, $ip);

        // Update ip
        $data = array(
                'bot_ip' => $ip
            );

        $this->db->where('bot_key', $botkey);
        $this->db->update('tblBot', $data);
    }

    function getBotName($botkey)
    {
        // Get the name of the bot
        if ($botkey == '001')
        {
            $bot_name = 'C&C Web Interface'; // Not a BOT
            return $bot_name;
        } else {
            $query = $this->db->query('SELECT bot_name FROM tblBot WHERE bot_key='.$botkey.';');

            if ($query->num_rows > 0)
            {
                $row = $query->row(); //takes only one result row
                $bot_name = $row->bot_name;   
                return $bot_name;
            } else {
                return "[[[ UNIDENTIFIED BOTKEY ]]]";
            } 
        }
    }
    
    function getName($id)
    {
        $this->db->where('bot_id', $id);
        $query = $this->db->get('tblBot');
        
        if ($query->num_rows > 0)
        {
            $row = $query->row(); //takes only one result row
            $bot_name = $row->bot_name;   
            return $bot_name;
        } else {
            return "???";
        }         
    }
    
    function countBots()
    {
        // Count number of bots
        $query = $this->db->get('tblBot');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function getBotData()
    {
        $this->db->order_by("bot_name", "asc");
        return $this->db->get('tblBot');
    }

    function getAllBots()
    {
        $this->db->order_by('bot_name', 'asc');
        return $this->db->get('tblBot');
    }

    function delBot($id)
    {
        // Delete Bot
        $this->db->where('bot_id', $id);
        $this->db->empty_table('tblBot');
    }

    function addBot($botname, $bot_privatekey, $botkey)
    {
        $bot = array(
            'bot_key'           =>	$botkey,
            'bot_privatekey'    =>      $bot_privatekey,
            'bot_name'          => 	$botname
        );

        $this->db->insert('tblBot', $bot);
    }
    
}
