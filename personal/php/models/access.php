<?php
class Access extends AbstractModel
{
    protected int $userID;
    protected string $userName;
    protected string $password;
    protected string $tableName = "credentials";

    public function readAssoc(array &$row) 
    {
        $this->row = &$row;
        $this->userID = &$row["userID"];
        $this->userName = &$row["userName"];
        $this->password = &$row["password"];
    }

    public function asRow() : array 
    {
        if ($this->row==null) 
            $this->row = array("userID" => &$this->userID, "userName" => &$this->userName,"password" => &$this->password);
        return $this->row;
    }

    public function IsThis(string $user) : bool
    {
        if (strcmp($this->userName, $user) == 0) 
            return true;        
        return false;
    }

    public function checkPassword($pwd) : bool 
    {
        return strcmp($this->password, $pwd) == 0;
    }

    public function IsEqual(AbstractModel $model) : bool 
    {
        if ($model instanceof OS) 
        {
            /** @var Access $obj */
            $obj = $model;
            return $this->userID == $obj->userID;
        }
        return false;
    }

}
?>