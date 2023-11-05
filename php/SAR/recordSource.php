<?php
class RecordSource 
{
    private $source = array(); 

    public AbstractModel $model;
    
    public function get($index, AbstractModel &$model) : AbstractModel 
    {
        $model->readAssoc($this->source[$index]);
        return $model;
    }

    public function addRow(Array $row) 
    {
        array_push($this->source, $row);
    }

    public function addObject(AbstractModel $model) 
    {
        array_push($this->source, $model->asRow());
    }

    public function remove(AbstractModel $object) 
    {
        $index = $this->indexOf($object);
        array_splice($this->source, $index, 1);
    }

    public function indexOf(AbstractModel $object) : int
    {
        for($i=0; $i < $this->recordCount(); $i++) 
        {
            $this->model->readAssoc($this->source[$i]);
            if ($this->model->IsEqual($object)) 
            {
                return $i;
            }
        }

        return -1;
    }

    public function recordCount() : int 
    {
        return count($this->source);
    }

    public function print() 
    {
        for($i=0; $i < $this->recordCount(); $i++) 
        {
            echo implode(", ", $this->source[$i]);
            echo "<br>";
        }
    }
}
?>