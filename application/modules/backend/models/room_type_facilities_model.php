<?php

class Room_type_facilities_model extends Backend_model
{

    protected $table = 'room_type_facilities';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }
}
