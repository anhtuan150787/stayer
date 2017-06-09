<?php

class Tour_order_model extends Frontend_model
{

    protected $table = 'tour_order';

    protected $set_created = FALSE;

    protected $set_modified = FALSE;



    public function __construct()
    {
        parent::__construct();
    }
}
