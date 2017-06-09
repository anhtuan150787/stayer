<?php

class Hotel_image_model extends Backend_model
{

    protected $table = 'hotel_image';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    

    public function __construct()
    {
        parent::__construct();
    }
}
