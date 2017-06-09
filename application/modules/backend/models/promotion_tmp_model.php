<?php

class Promotion_tmp_model extends Backend_model
{

    protected $table = 'promotion_tmp';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }
}
