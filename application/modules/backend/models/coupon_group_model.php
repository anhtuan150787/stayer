<?php

class Coupon_group_model extends Backend_model
{

    protected $table = 'coupon_group';

    protected $set_created = FALSE;

    protected $set_modified = FALSE;

    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }
}
