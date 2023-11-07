<?php

class RecordSource implements Iterator
{
    private $pointer = 0;
    private $source = array(); 
    public AbstractModel $model;
    
    public function __construct(AbstractModel $model = null) 
    {
        $this->model = $model;
    }

    public function setArray(Array $array) : void 
    {
        $this->source = $array;
    }
    
    public function current() 
    {
        return $this->source[$this->pointer];
    }

    public function key() 
    {
        return $this->pointer;
    }

    public function next() : void
    {
        $this->pointer++;
    }

    public function rewind() : void
    {
        $this->pointer = 0;
    }
    
    public function valid() : bool
    {
        // count() indicates how many items are in the list
        return $this->pointer < count($this->source);
     }

    public function printSource() 
    {
        for($i=0; $i < $this->recordCount(); $i++) 
        {
            echo $this[$i];
            Sys::Enter();
        }
    }
    
    public function getByIndex($index) : AbstractModel 
    {
        return $this[$index];
    }

    public function readRow(Array $row) 
    {
        array_push($this->source, $this->model->create($row));
    }

    public function addRecord(AbstractModel $record) 
    {
        array_push($this->source, $record);
    }

    public function updateRecord(AbstractModel $record) 
    {
        $index = $this->indexOf($record);
        $this->source[$index] = $record;
    }

    public function deleteRecord(AbstractModel $record) 
    {
        $index = $this->indexOf($record);
        array_splice($this->source, $index, 1);
    }

    public function indexOf(AbstractModel $object) : int
    {
        $index = -1;
        foreach($this as $record) 
        {
            $index++;
            $this->model = $record;
            if ($this->model->IsEqual($object)) 
                return $index;
        }
        return -1;
    }

    public function recordCount() : int 
    {
        return count($this->source);
    }

    public function getByID($id) : AbstractModel
    {
        $temp_array = array_values(array_filter($this->source, 
        function($record) use($id) : bool 
        {  
            /** @var AbstractModel $obj */
            $obj = $record;
            return $obj->matchPK($id);
        }));
        
        return $temp_array[0];
    }

    public function filterBy($callback) : Array
    {
        return array_values(array_filter($this->source, 
        function($record) use($callback) : bool 
        {   
            return $callback($record);
        }));
    }
}
?>