<?php
class DB extends AbstractTwoColumns
{
    protected string $tableName = "db";
        
    public function create(array &$row) : DB
    {
        $os = new DB();
        $os->readAssoc($row);
        return $os;
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

    public static function Cast(AbstractModel $model) : DB
    {
        /** @var DB $obj */
        $obj = $model;
        return $obj;
    }
}
?>