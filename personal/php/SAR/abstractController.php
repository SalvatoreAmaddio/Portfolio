<?php
abstract class AbstractController 
{
    protected RecordSource $originalSource;
    public RecordSource $recordSource;
    public AbstractModel $model;
    public Database $db;

    public function __construct(AbstractModel $model) 
    {
        $this->model = $model;
        $this->originalSource = new RecordSource();
        $this->originalSource->model = $model;
        $this->recordSource = new RecordSource();
        $this->recordSource->model = $model;
        $this->db = new Database($this->model);
        $this->db->connect();
        if (! $this->db->isConnected) 
        {
            echo("Connection Error");
            return;
        }
        $this->db->select();
        $this->originalSource =  $this->db->recordSource;
        $this->recordSource =  $this->db->recordSource;
    }

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


    public function get(int $index,AbstractModel &$model) : AbstractModel
    {
        return $this->recordSource->get($index,$model);
    }

    public function recordCount() : int 
    {
        return $this->recordSource->recordCount();
    }

    public abstract function style();

    public function beforeLoop() 
    {        
        echo "<form> <table id='displayer'>";
    }

    protected function filterBy($row) : bool 
    {
        return true;
    }

    protected function runFilter() 
    {
        $this->recordSource->source = array_filter($this->originalSource->source,
        function($row) : bool
        {
            return $this->filterBy($row);
        });
    }

    public function afterLoop() 
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
        $this->beforeLoop();
        $this->runFilter();
        if ($this->recordCount() > 0) 
        {
            foreach($this->recordSource->source as &$row) 
            {
                $this->model->readAssoc($row);
                $this->style();
            }
        } 
        else $this->onNoData();
        $this->afterLoop();
    }
}
?>