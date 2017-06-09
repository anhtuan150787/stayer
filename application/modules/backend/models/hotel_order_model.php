<?php

class Hotel_order_model extends Backend_model
{

    protected $table = 'hotel_order';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }
}
