<?php
class DbController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
    }

    private function runSearch() 
    {
        if (!isset($_SESSION["search"])) return;
        $search = $_SESSION["search"]; 
        $this->filterBy(
            function($record) use($search) : bool
            {
                $db = DB::cast($record);
                return Sys::contains($search,$db->Name,true);
            });
    }

    public function onReceived() 
    {
        if (isset($_REQUEST["search"])) 
        {
            $search = $_REQUEST['search'];
            $_SESSION["search"] = $search; 
            $this->runSearch();
            echo $this->drawTable();
            return;
        } 
        
        if (isset($_REQUEST["dbID"])) 
        {
            $this->model = $this->getByID($_REQUEST['dbID']);
            $obj = DB::Cast($this->model);
            $_SESSION["dbRecord"] = serialize($obj);
            echo $obj->Name;
            return;
        }

        if (isset($_REQUEST["updateValue"])) 
        {
            if (is_null($_REQUEST["updateValue"])==false) 
            {
                if (isset($_SESSION["dbRecord"])) 
                {
                    $db = unserialize($_SESSION['dbRecord']);
                    $db->Name = $_REQUEST["updateValue"];
                    $_SESSION["search"] = $db->Name; 
                    $this->db->update($db->Name,$db->ID);
                    $this->recordSource->updateRecord($db);
                    unset($_SESSION["dbRecord"]);
                    $this->runSearch();
                    echo $this->drawTable();
                }
            }
            return;
        }
    }

    public function drawHeader()
    {
        echo "<tr>
              <th></th>
              <th>Databases</th>
              <th colspan='2'>COMMANDS</th>
             </tr>";
    }

    public function style() 
    {
        $obj = DB::Cast($this->model);
        echo"<tr>
                <td class='selector'>➤</td>
                <td class='col1'>". $obj . "</td>
                <td class='command'><button class='editButton' value='" . $obj->ID . "'>EDIT</button></td>
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

    public function drawHeader()
    {

    }

    public function Style() 
    {

    }
}
?>