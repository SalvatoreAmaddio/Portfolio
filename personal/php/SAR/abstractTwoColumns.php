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

    public abstract function readAssoc(array &$row); 

    public abstract function asRow() : array; 

    public function __toString()
    {
        return $this->Name;
    }

    public abstract function IsEqual(AbstractModel $model) : bool;
}
?>