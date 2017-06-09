<?php

class Image_tmp_model extends Backend_model
{

    protected $table = 'image_tmp';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    public function __construct()
    {
        parent::__construct();
    }
}
