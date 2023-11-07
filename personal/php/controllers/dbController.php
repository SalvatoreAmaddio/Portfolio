<?php
class DbController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
    }

    public function onReceived() 
    {
        if (isset($_REQUEST["search"])) 
        {
            $search = $_REQUEST['search'];
            $this->filterBy(
                            function($record) use($search) : bool
                            {
                                $db = DB::cast($record);
                                return Sys::contains($search,$db->Name,true);
                            });
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
            if (isset($_SESSION["dbRecord"])) 
            {
                $db = unserialize($_SESSION['dbRecord']);
                $this->db->update($db->dbName,$db->dbID);
                unset($_SESSION["dbRecord"]);
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
            <td class='command'><button class='editButton' onclick='onEditClicked(this)' value='" . $obj->ID . "'>EDIT</button></td>
            <td class='command'><button class='deleteButton' onclick='onDeleteClicked(this)' value='" . $obj->ID . "'>DELETE</button></td>
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