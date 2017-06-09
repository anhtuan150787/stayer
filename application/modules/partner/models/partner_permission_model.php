<?php

class Partner_permission_model extends Partner_bk_model
{
    protected $table = 'partner_permission';

    protected $set_created = FALSE;

    public function __construct()
    {
        parent::__construct();
    }
}
