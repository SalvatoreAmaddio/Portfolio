<?php
class AccessController extends AbstractController 
{
    private $userName;
    private $pwd;

    public function __construct() 
    {
        parent::__construct(new Access());
    }

    public function checkCredentials($user, $pwd) : bool 
    {   
        $this->userName = $user;
        $this->pwd = $pwd;
        $row = array_filter($this->recordSource->source, 
        function($row) : bool
        {
            return $this->check($row);
        });
        $this->userName = "";
        $this->pwd = "";
        return count($row) > 0;
    }

    private function check($row) : bool 
    {
        return (strcmp($row["userName"], $this->userName) == 0) 
        && (strcmp($row["password"], $this->pwd) == 0);
    }

    public function Style() 
    {

    }
}
?>