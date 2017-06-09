<?php

class Email_customer_model extends Frontend_model
{

    protected $table = 'email_customer';
    
    protected $set_created = FALSE;
    
    protected $set_modified = FALSE;
    
    

    public function __construct()
    {
        parent::__construct();
    }
}
