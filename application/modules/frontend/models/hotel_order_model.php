<?php

class Hotel_order_model extends Frontend_model
{

    protected $table = 'hotel_order';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    

    public function __construct()
    {
        parent::__construct();
    }
}
