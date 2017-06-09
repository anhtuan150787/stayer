<?php

class Hotel_info_model extends Frontend_model
{

    protected $table = 'hotel_info';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    

    public function __construct()
    {
        parent::__construct();
    }

    public function object($obj_hotel = array())
    {

    }
}
