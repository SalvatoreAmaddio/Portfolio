<?php
class RecordSource 
{
    public $source = array(); 

    public AbstractModel $model;
    
    public function __construct(AbstractModel $model = null) 
    {
        $this->model = $model;
    }

    public function printSource() 
    {
        for($i=0; $i < $this->recordCount(); $i++) 
        {
            echo $this->source[$i];
            Sys::Enter();
        }
    }
    
    public function get($index) : AbstractModel 
    {
        return $this->source[$index];
    }

    public function readRow(Array $row) 
    {
        array_push($this->source, $this->model->create($row));
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

}
?>