<?php
class Access extends AbstractModel
{
    protected int $userID;
    public string $userName;
    public string $password;
    protected string $tableName = "credentials";

    public static function Cast(AbstractModel $model): Access
    {
       /** @var Access $obj */
       $obj = $model;
       return $obj;
    }

    public function matchPK(int $id): bool
    {
        return $this->userID == $id;
    }
    
    public function create(array &$row) : Access
    {
        $os = new Access();
        $os->readAssoc($row);
        return $os;
    }

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