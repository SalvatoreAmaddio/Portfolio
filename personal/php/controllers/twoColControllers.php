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

class ProLangController extends TwoColumnController 
{
    public function __construct() 
    {
        parent::__construct(new ProLang());
        $this->headerTitle = "Programming Languages";
        $this->formName="prolang";
    }
}

class TechController extends TwoColumnController 
{
    public function __construct() 
    {
        parent::__construct(new Tech());
        $this->headerTitle = "Technologies";
        $this->formName="tech";
    }
}
?>