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

    public function matchPK(int $id): bool
    {
        return $this->ID == $id;
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
    
    public abstract function readAssoc(array &$row); 

    public abstract function asRow() : array; 

    public function __toString()
    {
        return $this->Name;
    }

    public abstract function IsEqual(AbstractModel $model) : bool;
}
?>