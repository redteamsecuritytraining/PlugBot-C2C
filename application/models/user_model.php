<?php

class User_model Extends CI_Model {

    function validateCreds($username, $password)
    {
        /*
         * Validates the users creds on login 
         */
        
        $this->db->where('user_username', $username);
        $this->db->where('user_password', do_hash($password.$this->_salt())); // SHA1 password + salt
        $query = $this->db->get('tblUser');

        if($query->num_rows == 1)
        {
            return true;
        }
    }

    function doChangePwd($password)
    {
        /*
         * Processes the change password request
         */
        
        $data = array(
                'user_password' => do_hash($password.$this->_salt()) // SHA1 password + salt
            );

        $this->db->where('user_id', '1'); // Only one record
        $this->db->update('tblUser', $data);
    }
    
    private function _salt()
    {
        /*
         * Adds a salt to the password
         */
        
        $salt = 'L48(3h@$&^owg494~`3=-==4y938h'; // This needs to be changed 
        return $salt;
    }

}