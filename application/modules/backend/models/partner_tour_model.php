<?php

class Partner_tour_model extends Backend_model
{

    protected $table = 'partner_tour';

    protected $set_created = FALSE;

    protected $set_modified = FALSE;

    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }
}
