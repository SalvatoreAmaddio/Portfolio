<?php
class DbController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
    }

    public function Style() 
    {

    }
}

class OsController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new OS());
    }

    public function Style() 
    {

    }
}
?>