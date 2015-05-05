<?php

class Plugbot_model Extends CI_Model {

    function setHelp()
    {
        $this->db->where('plugbot_id', 1);
        $query = $this->db->get('tblPlugbot');

        if ($query->num_rows > 0)
        {
            $row = $query->row();
            $help = $row->plugbot_help;
            return $help;
        } else {
            $help = 1;
            return $help;
        }
    }

    function changeHelp($val)
    {
        // Update help
        $data = array(
                'plugbot_help' => $val,
            );

        $this->db->where('plugbot_id', '1'); // Only one record
        $this->db->update('tblPlugbot', $data);
    }        

}