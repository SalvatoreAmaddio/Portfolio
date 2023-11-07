<?php
namespace SAR;
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

  public function printRow() : string 
  {
        return implode(", ", $this->row);
  }

  public abstract function matchPK(int $id) : bool;
  public abstract function IsEqual(AbstractModel $model) : bool;
}
?>