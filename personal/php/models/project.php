<?php
class Project 
{
    private $projectID;
    public $year;
    public $sourceCode;
    public $lang;
    public $tech;
    public $office = false;
    public $pdf = false;
    public $multiUser = false;
    public $logoPath;
    public $description;
    public $downloadLink;


    function __construct() 
    {

    }
    
    public function __toString()
    {
        return $this->projectID;
    }
}
?>