<?php

class Tour_topic_model extends Frontend_model
{

    protected $table = 'tour_topic';

    protected $set_created = FALSE;

    protected $set_modified = FALSE;

    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }
}
