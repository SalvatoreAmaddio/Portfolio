<?php
class DB extends AbstractTwoColumns
{
    protected string $tableName = "db";
        
    public function create(array &$row) : DB
    {
        $newRecord = new DB();
        $newRecord->readAssoc($row);
        return $newRecord;
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

class OS extends AbstractTwoColumns
{
    protected string $tableName = "os";

    public function create(array &$row) : OS
    {
        $newRecord = new OS();
        $newRecord->readAssoc($row);
        return $newRecord;
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

class ProjectType extends AbstractTwoColumns
{
    protected string $tableName = "projecttype";

    public function create(array &$row) : ProjectType
    {
        $newRecord = new ProjectType();
        $newRecord->readAssoc($row);
        return $newRecord;
    }

    public function IsEqual(AbstractModel $model) : bool 
    {
        if ($model instanceof ProjectType) 
        {
            /** @var ProjectType $obj */
            $obj = $model;
            return $this->ID == $obj->ID;
        }
        return false;
    }

    public static function Cast(AbstractModel $model) : ProjectType
    {
            /** @var ProjectType $obj */
            $obj = $model;
            return $obj;
    }
}

class ProLang extends AbstractTwoColumns
{
    protected string $tableName = "prolang";

    public function create(array &$row) : ProLang
    {
        $newRecord = new ProLang();
        $newRecord->readAssoc($row);
        return $newRecord;
    }

    public function IsEqual(AbstractModel $model) : bool 
    {
        if ($model instanceof ProLang) 
        {
            /** @var ProLang $obj */
            $obj = $model;
            return $this->ID == $obj->ID;
        }
        return false;
    }

    public static function Cast(AbstractModel $model) : ProLang
    {
            /** @var ProLang $obj */
            $obj = $model;
            return $obj;
    }
}

class Tech extends AbstractTwoColumns
{
    protected string $tableName = "tech";

    public function create(array &$row) : Tech
    {
        $newRecord = new Tech();
        $newRecord->readAssoc($row);
        return $newRecord;
    }

    public function IsEqual(AbstractModel $model) : bool 
    {
        if ($model instanceof Tech) 
        {
            /** @var Tech $obj */
            $obj = $model;
            return $this->ID == $obj->ID;
        }
        return false;
    }

    public static function Cast(AbstractModel $model) : Tech
    {
            /** @var Tech $obj */
            $obj = $model;
            return $obj;
    }
}
?>