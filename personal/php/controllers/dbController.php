<?php
class DbController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
        $this->formName="db";
    }

    protected function searchVal() : string 
    {
        return $this->formName."search";
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

    private function switchSearchValue(AbstractTwoColumns $db) : bool
    {
        if (isset($_SESSION[$this->searchVal()]) && strlen($_SESSION[$this->searchVal()])>0) 
        {
            if (!Sys::contains($_SESSION[$this->searchVal()],$db->Name,true))
                return $_SESSION[$this->searchVal()] = $db->Name; 
        }
        return false;
    }

    public function onReceived() 
    {
        if (isset($_REQUEST[$this->searchVal()])) 
        {
            $search = $_REQUEST[$this->searchVal()];
            $_SESSION[$this->searchVal()] = $search; 
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

        if (isset($_REQUEST[$this->updateVal()])) 
        {
            if (!is_null($_REQUEST[$this->updateVal()])) 
            {
                if (isset($_SESSION["dbRecord"])) 
                {
                    $db = unserialize($_SESSION['dbRecord']);
                    $db->Name = $_REQUEST[$this->updateVal()];
                    $this->switchSearchValue($db);
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
                <td class='command'><button type='button' class='editButton' value='" . $obj->ID . "'><img src='/img/save_blue.png'></button></td>
                <td class='command'><button class='deleteButton' value='" . $obj->ID . "'><img src='/img/delete.png'></button></td>
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