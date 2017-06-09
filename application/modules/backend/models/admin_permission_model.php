<?php

class Admin_permission_model extends Backend_model
{
    protected $table = 'admin_permission';
    
    protected $set_created = FALSE;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function delete_by_group_admin_id($group_id)
    {
        $this->db->where('group_admin_id', $group_id);
        
        return $this->db->delete($this->table);
    }
}
