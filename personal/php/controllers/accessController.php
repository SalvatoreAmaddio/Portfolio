<?php
class AccessController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new Access());
    }

    public function checkCredentials($user, $pwd) : bool 
    {   
        return $this->filterBy(
        function($record) use($user, $pwd) : bool
        {
            $access = Access::Cast($record);
            return (strcmp($access->userName, $user) == 0) 
            && (strcmp($access->password, $pwd) == 0);
        });
    }

    public function Style() 
    {

    }

    public function drawHeader() 
    {

    }
}
?>