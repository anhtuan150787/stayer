<?php

class Hotel_order_room_model extends Partner_bk_model
{

    protected $table = 'hotel_order_room';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }
}
