<?php

class Admin_model extends Backend_model
{

    protected $table = 'admin';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;

    protected $soft_deletes = TRUE;
    

    public function __construct()
    {
        parent::__construct();
    }

    public function get_admin($username, $password)
    {
        $query = $this->db->get_where($this->table, array(
            'username' => $username,
            'password' => $password,
            'status' => 1,
            'deleted' => 0,
        ));
      
        return $query->row();
    }

}
