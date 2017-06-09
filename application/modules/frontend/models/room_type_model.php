<?php

class Room_type_model extends Frontend_model
{

    protected $table = 'room_type';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    

    public function __construct()
    {
        parent::__construct();
    }
}
