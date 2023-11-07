<?php
abstract class AbstractController 
{
    protected RecordSource $originalSource;
    public RecordSource $recordSource;
    public AbstractModel $model;
    public Database $db;
    public $recordID;
    public $recordIDFieldName;
    
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

    public function recordCount() : int 
    {
        return $this->recordSource->recordCount();
    }

    public function printSource() 
    {
        $this->recordSource->printSource();
    }

    public function get(int $index,AbstractModel &$model) : AbstractModel
    {
        return $this->recordSource->get($index,$model);
    }

    public function filterByID($id) : AbstractModel
    {
        $this->recordSource->source = array_values(array_filter($this->originalSource->source, 
        function($record) use($id) : bool 
        {   
            /** @var AbstractModel $obj */
            $obj = $record;
            return $obj->matchPK($id);
        }));

        if ($this->recordCount() > 0) 
                return $this->recordSource->get(0);
    }

    ////////
    public function ReadPost() 
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") return;
        $this->onSend();            
        exit();         
    }

    public function onSend() 
    {
        if (isset($_REQUEST["s"])) 
        {
            $search = $_REQUEST['s'];
            echo $search;       
        }
        else 
            echo "did not work";
    }


    public abstract function style();

    public function openTable() 
    {        
        echo "<form> <table id='displayer'>";
    }

    public function closeTable() 
    {
        echo "</table></form>
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

    public function run() 
    {
        $this->openTable();
        $this->drawData();
        $this->closeTable();
    }

    public function drawData() 
    {
        if ($this->recordCount() > 0) 
        {
            foreach($this->recordSource->source as &$record) 
            {
                $this->model = $record;
                $this->style();
            }
        } 
        else $this->onNoData();
    }
}
?>