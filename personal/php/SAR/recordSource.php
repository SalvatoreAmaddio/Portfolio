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
    
    ////
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
    ///
    public function printSource() 
    {
        for($i=0; $i < $this->recordCount(); $i++) 
        {
            echo $this[$i];
            Sys::Enter();
        }
    }
    
    public function get($index) : AbstractModel 
    {
        return $this[$index];
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

    public function getByID($id) : Array
    {
        return array_values(array_filter($this->source, 
        function($record) use($id) : bool 
        {  
            /** @var AbstractModel $obj */
            $obj = $record;
            return $obj->matchPK($id);
        }));
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