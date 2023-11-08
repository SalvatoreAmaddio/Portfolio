<?php

abstract class AbstractModel {

  protected $row = array();
  protected string $tableName;

  public abstract static function Cast(AbstractModel $model) : AbstractModel;

  public abstract function create(array &$row) : AbstractModel;

  public abstract function asRow() : array;
  public abstract function readAssoc(array &$row);

  public function selectAll() : string 
  {
     return "Select * FROM " . $this->tableName . ";";
  }

//  case Insert 0;
//  case Select 1;
//  case Update 2;
//  case Delete 3;
  public abstract function bindTypeParams(int $query) : string;
  public abstract function updateSQL() : string;
  public abstract function deleteSQL() : string;
  public abstract function insertSQL() : string;
  
  public function printRow() : string 
  {
        return implode(", ", $this->row);
  }

  public abstract function matchPK(int $id) : bool;
  public abstract function IsEqual(AbstractModel $model) : bool;
}
?>