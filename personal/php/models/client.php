<?php
class Client extends AbstractModel 
{
    public int $clientID;
    public string $firstName;
    public string $lastName;

    public function __construct() 
    {
        $this->tableName="client";
    }

    public function fullName() : string 
    {
        return $this->firstName . " " . $this->lastName;    
    }
    
    public function create(array &$row) : Client
    {
        $os = new Client();
        $os->readAssoc($row);
        return $os;
    }

    public function readAssoc(array &$row) 
    {
        $this->row = &$row;
        $this->clientID = &$row["clientID"];
        $this->firstName = &$row["firstName"];
        $this->lastName = &$row["lastName"];
    }

    public function asRow() : array 
    {
        if ($this->row==null) 
            $this->row = array("clientID" => &$this->clientID, "firstName" => &$this->firstName,"lastName" => &$this->lastName);
        return $this->row;
    }

    public function bindTypeParams(int $query) : string 
    {
        switch ($query) {
            case 0:
                return "ss";
            case 2:
                return "ssi";
            case 3:
                return "i";
        }
    }

    public function updateSQL() : string
    {
        return "update " . $this->tableName . " SET ".$this->tableName."firstName =?, ".$this->tableName."lastName = ? WHERE ".$this->tableName."ID=?;";
    }
    
    public function deleteSQL() : string 
    {
        return "delete from " . $this->tableName . " WHERE ".$this->tableName."ID = ?;";
    }

    public function insertSQL() : string 
    {
        return "insert into " . $this->tableName . " (".$this->tableName."firstName, ".$this->tableName."lastName) VALUES (?,?);";
    }
    
    public function __toString()
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function matchPK(int $id): bool
    {
        return $this->clientID == $id;
    }
    
    public function IsEqual(AbstractModel $model) : bool 
    {
        if ($model instanceof Client) 
        {
            /** @var Client $obj */
            $obj = $model;
            return $this->clientID == $obj->clientID;
        }
        return false;
    }

    public static function Cast(AbstractModel $model) : Client 
    {
    /** @var Client $obj */
       $obj = $model;
       return $obj;
    }

}

?>