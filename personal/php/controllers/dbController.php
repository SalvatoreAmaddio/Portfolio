<?php
class DbController extends TwoColumnController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
        $this->headerTitle = "Databases";
        $this->formName="db";
    }
}

class OsController extends TwoColumnController 
{
    public function __construct() 
    {
        parent::__construct(new OS());
        $this->headerTitle = "Operating Systems";
        $this->formName="os";
    }
}
?>