<?php

class Tour_comment_model extends Frontend_model
{

    protected $table = 'tour_comment';

    protected $set_created = FALSE;

    protected $set_modified = FALSE;



    public function __construct()
    {
        parent::__construct();
    }
}
