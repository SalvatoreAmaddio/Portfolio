<?php
class AccessController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new Access());
    }

    public function checkCredentials($user, $pwd) : bool 
    {
        for($i=0; $i < $this->recordCount(); $i++) 
        {
            $this->get($i,$this->model);
            /** @var Access $obj */
             $obj = $this->model;
             if ($obj->IsThis($user)) 
                return $obj->checkPassword($pwd);
        }
        return false;
    }

    public function Style() 
    {

    }
}
?>