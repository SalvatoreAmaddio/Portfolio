<?php
class DBController extends TwoColumnController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
        $this->headerTitle = "Databases";
        $this->formName="db";
    }
}

class OSController extends TwoColumnController 
{
    public function __construct() 
    {
        parent::__construct(new OS());
        $this->headerTitle = "Operating Systems";
        $this->formName="os";
    }
}

class ProjectTypeController extends TwoColumnController 
{
    public function __construct() 
    {
        parent::__construct(new ProjectType());
        $this->headerTitle = "Project Types";
        $this->formName="projecttype";
    }
}
?>