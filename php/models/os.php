<?php
class OS extends AbstractTwoColumns
{
    protected string $tableName = "os";

    public function readAssoc(array &$row) 
    {
        $this->row = &$row;
        $this->ID = &$row["osID"];
        $this->Name = &$row["osName"];
    }

    public function asRow() : array 
    {
        if ($this->row==null) 
            $this->row = array("osID" => &$this->ID, "osName" => &$this->Name);
        return $this->row;
    }

    public function IsEqual(AbstractModel $model) : bool 
    {
        if ($model instanceof OS) 
        {
            /** @var OS $obj */
            $obj = $model;
            return $this->ID == $obj->ID;
        }
        return false;
    }

}
?>