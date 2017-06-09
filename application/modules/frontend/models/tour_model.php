<?php

class Tour_model extends Frontend_model
{

    protected $table = 'tour';

    protected $set_created = FALSE;

    protected $set_modified = FALSE;



    public function __construct()
    {
        parent::__construct();
    }
}
