<?php

class Coupon_group_model extends Frontend_model
{

    protected $table = 'coupon_group';

    protected $set_created = FALSE;

    protected $set_modified = FALSE;

    public function __construct()
    {
        parent::__construct();
    }
}
