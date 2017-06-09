<?php

class Tour_image_model extends Backend_model
{

    protected $table = 'tour_image';

    protected $set_created = FALSE;

    protected $set_modified = FALSE;



    public function __construct()
    {
        parent::__construct();
    }
}
