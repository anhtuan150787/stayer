<?php

class Ward_model extends Frontend_model
{

    protected $table = 'ward';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    

    public function __construct()
    {
        parent::__construct();
    }
}
