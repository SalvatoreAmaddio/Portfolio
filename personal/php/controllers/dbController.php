<?php
class DbController extends TwoColumnController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
        $this->formName="db";
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

        if ($this->isDeleteIDRequested()) 
        {
            $this->model = $this->recordToDelete();
            $record = DB::Cast($this->model);
            $this->switchSearchValue($record);
            $this->db->crud(3, $record->ID);
            $this->recordSource->deleteRecord($record);
            $this->runSearch();
            echo $this->drawTable();
            return;
        }

        if ($this->isNewValRequested()) 
        {
            if (!$this->isNewValNull()) 
            {
                $record = new DB();
                $record->Name = ucfirst($this->requestedNewVal());
                $this->switchSearchValue($record);
                $this->db->crud(0, $record->Name);
                $this->recordSource->addRecord($record);
                $this->runSearch();
                echo $this->drawTable();
            }
            return;
        }

        if ($this->isUpdateIDRequested()) 
        {
            $this->model = $this->recordToUpdate();
            $record = DB::Cast($this->model);
            $this->storeObj($record);
            echo $record->Name;
            return;
        }

        if ($this->isUpdateValRequested()) 
        {
            if (!$this->isUpdateValNull()) 
            {
                if ($this->isObjStored()) 
                {
                    $record = $this->getStoredObj();
                    $record->Name = ucfirst($this->requestedUpdateVal());
                    $this->switchSearchValue($record);
                    $this->db->crud(2, $record->Name,$record->ID);
                    $this->recordSource->updateRecord($record);
                    $this->destroyStoredObj();
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
                <td class='command'><button type='button' class='deleteButton' value='" . $obj->ID . "'><img src='/img/delete.png'></button></td>
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