<?php
abstract class AbstractTwoColumns extends AbstractModel
{
    public int $ID;
    public string $Name;
    protected string $tableName = "";

    function __construct(int $id=0, string $name="") 
    {
        $this->ID = $id;
        $this->Name = $name;
        $this->asRow();
    }
    
    public function readAssoc(array &$row) 
    {
        $this->row = $row;
        $this->ID = $row[$this->tableName."ID"];
        $this->Name = $row[$this->tableName."Name"];
    }

    public function asRow() : array 
    {
        if ($this->row==null) 
            $this->row = array($this->tableName."ID" => &$this->ID, $this->tableName."Name" => &$this->Name);
        return $this->row;
    }

    public function bindTypeParams(int $query) : string 
    {
        switch ($query) {
            case 0:
                return "s";
            case 2:
                return "si";
            case 3:
                return "i";
        }
    }

    public function updateSQL() : string
    {
        return "update " . $this->tableName . " SET ".$this->tableName."Name = ? WHERE ".$this->tableName."ID=?;";
    }
    
    public function insertSQL() : string 
    {
        return "insert into " . $this->tableName . " (".$this->tableName."Name) VALUES (?);";
    }
    
    public function __toString()
    {
        return $this->Name;
    }

    public function matchPK(int $id): bool
    {
        return $this->ID == $id;
    }

    public abstract function IsEqual(AbstractModel $model) : bool;

    public static function Cast(AbstractModel $model) : AbstractTwoColumns
    {
            /** @var OS $obj */
            $obj = $model;
            return $obj;
    }
}
?>