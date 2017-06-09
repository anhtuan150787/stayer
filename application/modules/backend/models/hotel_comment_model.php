<?php

class Hotel_comment_model extends Backend_model
{

    protected $table = 'hotel_comment';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }
}
