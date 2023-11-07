<?php
class DB extends AbstractTwoColumns
{
    protected string $tableName = "dbs";
    
    public static function Cast(AbstractModel $model) : DB
    {
        /** @var DB $obj */
        $obj = $model;
        return $obj;
    }
    
    public function create(array &$row) : DB
    {
        $os = new DB();
        $os->readAssoc($row);
        return $os;
    }

    public function readAssoc(array &$row) 
    {
        $this->row = $row;
        $this->ID = $row["dbID"];
        $this->Name = $row["dbName"];
    }

    public function asRow() : array 
    {
        if ($this->row==null) 
            $this->row = array("dbID" => &$this->ID, "dbName" => &$this->Name);
        return $this->row;
    }

    public function IsEqual(AbstractModel $model) : bool 
    {
        if ($model instanceof DB) 
        {
            /** @var DB $obj */
            $obj = $model;
            return $this->ID == $obj->ID;
        }
        return false;
    }
}
?>