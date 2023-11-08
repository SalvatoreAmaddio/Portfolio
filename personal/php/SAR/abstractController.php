<?php
abstract class AbstractController 
{
    protected RecordSource $originalSource;
    public RecordSource $recordSource;
    public AbstractModel $model;
    public Database $db;
    protected $formName;

    public function __construct(AbstractModel $model) 
    {
        $this->model = $model;
        $this->db = new Database($this->model);
        $this->db->connect();
        if (! $this->db->isConnected) 
        {
            echo("Connection Error");
            return;
        }
        $this->db->select();
        $this->originalSource =  &$this->db->recordSource;
        $this->recordSource =  $this->db->recordSource;
    }

    public function storeObj($db)
    {
        $_SESSION[$this->formName."storedObj"] = serialize($db);
    }

    public function getStoredObj()
    {
        return unserialize($_SESSION[$this->formName.'storedObj']);
    }

    public function destroyStoredObj()
    {
        unset($_SESSION[$this->formName."storedObj"]);
    }
    
    public function isObjStored() : bool
    {
        return isset($_SESSION[$this->formName."storedObj"]);
    }

    //DELETE
    protected function isDeleteIDRequested() : bool
    {
        return isset($_REQUEST[$this->formName."deleteID"]);
    }
    protected function recordToDelete() : AbstractModel 
    {
        return $this->getByID((int)$_REQUEST[$this->formName.'deleteID']);
    }

    //INSERT 
    protected function requestedNewVal()  
    {
        return $_REQUEST[$this->formName ."newVal"];
    }

    protected function isNewValRequested() : bool 
    {
        return isset($_REQUEST[$this->formName . "newVal"]);
    }

    protected function isNewValNull() : bool 
    {
        return is_null($_REQUEST[$this->formName . "newVal"]);
    }

    //UPDATE
    protected function isUpdateIDRequested() : bool
    {
        return isset($_REQUEST[$this->formName."updateID"]);
    }

    protected function recordToUpdate() : AbstractModel 
    {
        return $this->getByID($_REQUEST[$this->formName.'updateID']);
    }

    protected function isUpdateValRequested() : bool 
    {
        return isset($_REQUEST[$this->formName . "updateVal"]);
    }

    protected function isUpdateValNull() : bool 
    {
        return is_null($_REQUEST[$this->formName . "updateVal"]);
    }

    protected function requestedUpdateVal() 
    {
        return $_REQUEST[$this->formName . "updateVal"];
    }
    /////
    public abstract function style();
    public abstract function drawHeader();

    public function recordCount() : int 
    {
        return $this->recordSource->recordCount();
    }

    public function printSource() 
    {
        $this->recordSource->printSource();
    }

    public function getByIndex(int $index) : AbstractModel
    {
        return $this->recordSource->getByIndex($index);
    }

    public function filterBy($callback) : bool
    {
        $this->recordSource->setArray($this->originalSource->filterBy($callback));
        return $this->recordCount() > 0;
    }

    public function getByID($id) : AbstractModel
    {
        if ($this->recordCount() > 0) 
                return $this->recordSource->getByID($id);
    }

    public function readPost() 
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") return;
        $this->onReceived();            
        exit();         
    }

    public function onReceived() 
    {
        if (isset($_REQUEST["s"])) 
        {
            $search = $_REQUEST['s'];
            echo $search;       
        }
        else 
            echo "did not work";
    }

    //DRAW DATA TABLE
    public function openTable() 
    {        
        echo "<table id='displayer'>";
    }

    public function closeTable() 
    {
        echo "</table>
        <div class='recordTracker'>
            <p>Totals: " . $this->recordCount() . "</p>
        </div>";   
    }

    public function onNoData() 
    {
        echo"<tr>
            <td colspan=3 class='noData'>NO DATA</td>
            </tr>";
    }

    public function drawTable() 
    {
        $this->openTable();
        $this->drawHeader();
        $this->drawData();
        $this->closeTable();
    }

    public function drawData() 
    {
        if ($this->recordCount() > 0) 
        {
            foreach($this->recordSource as $record) 
            {
                $this->model = $record;
                $this->style();
            }
        } 
        else $this->onNoData();
    }
}
?>