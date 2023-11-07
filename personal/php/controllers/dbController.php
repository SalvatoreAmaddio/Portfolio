<?php
class DbController extends AbstractController 
{
    private $search;
    public function __construct() 
    {
        parent::__construct(new DB());
        $this->recordIDFieldName = "dbID";
    }

    public function onSend() 
    {
        if (isset($_REQUEST["search"])) 
        {
            $this->search = $_REQUEST['search'];
            echo $this->run();
        } 
        
        if (isset($_REQUEST["dbID"])) 
        {
            $this->recordID = $_REQUEST['dbID'];
            $this->filterByID();
             /** @var DB $obj */
            $obj = $this->model;
            echo $obj->Name;
        } 
        else echo "did not work";
    }

    public function beforeLoop()
    {
        parent::beforeLoop();
        echo "<tr>
                <th></th>
                <th>Operating System</th>
                <th colspan='2'>COMMANDS</th>
            </tr>";
    }

    protected function filterBy($row) : bool 
    {
        $dbName = strtolower($row["dbName"]);
        $criteria = strtolower($this->search);
        return (str_contains($dbName, $criteria) == true);
    }

    public function style() 
    {
        /** @var DB $obj */
        $obj = $this->model;
        echo"<tr>
            <td class='selector'>➤</td>
            <td class='col1'>". $obj . "</td>
            <td class='command'><button class='editButton' onclick='onEditClicked(this)' value='" . $obj->ID . "'>EDIT</button></td>
            <td class='command'><button class='deleteButton' value='" . $obj->ID . "'>DELETE</button></td>
        </tr>";
    }
}

class OsController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new OS());
    }

    public function Style() 
    {

    }
}
?>