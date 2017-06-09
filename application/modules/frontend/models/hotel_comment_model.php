<?php

class Hotel_comment_model extends Frontend_model
{

    protected $table = 'hotel_comment';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    

    public function __construct()
    {
        parent::__construct();
    }
}
