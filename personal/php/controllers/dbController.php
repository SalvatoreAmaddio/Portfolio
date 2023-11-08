<?php
class DbController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
        $this->formName="db";
    }

    private function runSearch() 
    {
        if (!isset($_SESSION[$this->formName . "search"])) return;
        $search = $_SESSION[$this->formName . "search"]; 
        $this->filterBy(
            function($record) use($search) : bool
            {
                $db = DB::cast($record);
                return Sys::contains($search,$db->Name,true);
            });
    }

    public function onReceived() 
    {
        if (isset($_REQUEST[$this->formName . "search"])) 
        {
            $search = $_REQUEST[$this->formName . 'search'];
            $_SESSION[$this->formName . "search"] = $search; 
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

        if (isset($_REQUEST[$this->formName . "updateVal"])) 
        {
            if (is_null($_REQUEST[$this->formName . "updateVal"])==false) 
            {
                if (isset($_SESSION["dbRecord"])) 
                {
                    $db = unserialize($_SESSION['dbRecord']);
                    $db->Name = $_REQUEST[$this->formName . "updateVal"];
                    if (isset($_SESSION[$this->formName . "search"]) && strlen($_SESSION[$this->formName . "search"])>0) 
                    {
                        if (!Sys::contains($_SESSION[$this->formName . "search"],$db->Name,true))
                            $_SESSION[$this->formName . "search"] = $db->Name; 
                    }
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
                <td class='command'><button type='button' class='editButton' value='" . $obj->ID . "'>EDIT</button></td>
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