<?php
class OS extends AbstractTwoColumns
{
    protected string $tableName = "os";

    public function create(array &$row) : OS
    {
        $os = new OS();
        $os->readAssoc($row);
        return $os;
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

    public static function Cast(AbstractModel $model) : OS
    {
            /** @var OS $obj */
            $obj = $model;
            return $obj;
    }
}
?>