<?php

class Hotel_order_contact_model extends Backend_model
{

    protected $table = 'hotel_order_contact';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    protected $soft_deletes = FALSE;

    public function __construct()
    {
        parent::__construct();
    }
}
