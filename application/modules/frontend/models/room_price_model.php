<?php

class Room_price_model extends Frontend_model
{

    protected $table = 'room_price';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    

    public function __construct()
    {
        parent::__construct();
    }
}
