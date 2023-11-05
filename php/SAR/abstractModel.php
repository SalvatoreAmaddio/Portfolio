<?php
abstract class AbstractModel {

  protected $row = array();
  protected string $tableName;
  
  public abstract function asRow() : array;
  public abstract function readAssoc(array &$row);

  public function selectAll() : string 
  {
    return "Select * FROM " . $this->tableName . ";";
  }

  public function print() : string 
  {
        return implode(", ", $this->row);
  }

  public abstract function IsEqual(AbstractModel $model) : bool;
}
?>