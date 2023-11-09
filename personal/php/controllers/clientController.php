<?php
class ClientController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new Client());
        $this->formName="client";
    }

    protected function runSearch() 
    {
        if (!isset($_SESSION[$this->searchVal()])) return;
        $search = $_SESSION[$this->searchVal()]; 
        $this->filterBy(
            function($record) use($search) : bool
            {
                $rec = Client::cast($record);
                return Sys::contains($search,$rec->fullName(), true);
            });
    }

    protected function switchSearchValue(Client $record) : bool
    {
        if (isset($_SESSION[$this->searchVal()]) && strlen($_SESSION[$this->searchVal()])>0) 
        {
            if (!Sys::contains($_SESSION[$this->searchVal()],$record->fullName(),true))
                return $_SESSION[$this->searchVal()] = $record->fullName(); 
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

        if ($this->isDeleteIDRequested()) 
        {
            $this->model = $this->recordToDelete();
            $record = Client::Cast($this->model);
            $this->switchSearchValue($record);
            $this->db->crud(3, $record->clientID);
            $this->recordSource->deleteRecord($record);
            $this->runSearch();
            echo $this->drawTable();
            return;
        }

        if ($this->isNewValRequested()) 
        {
            if (!$this->isNewValNull()) 
            {
                $record = Client::Cast($this->model);
                $record->firstName = ucfirst($this->requestedNewVal());
                $this->switchSearchValue($record);
                $record->clientID = $this->db->crud(0, $record->firstName,$record->lastName);
                $this->recordSource->addRecord($record);
                $this->runSearch();
                echo $this->drawTable();
            }
            return;
        }

        if ($this->isUpdateIDRequested()) 
        {
            $this->model = $this->recordToUpdate();
            $record = Client::Cast($this->model);
            $this->storeObj($record);
            echo $record->fullName();
            return;
        }

        if ($this->isUpdateValRequested()) 
        {
            if (!$this->isUpdateValNull()) 
            {
                if ($this->isObjStored()) 
                {
                    $record = $this->getStoredObj();
                    $record->firstName = ucfirst($this->requestedUpdateVal());
                    $this->switchSearchValue($record);
                    $this->db->crud(2, $record->firstName,$record->lastName,$record->ID);
                    $this->recordSource->updateRecord($record);
                    $this->destroyStoredObj();
                    $this->runSearch();
                    echo $this->drawTable();
                }
            }
            return;
        }
    }

    public function style() 
    {
        $obj = AbstractTwoColumns::Cast($this->model);
        echo"<tr>
                <td class='selector'>➤</td>
                <td class='col1'>". $obj . "</td>
                <td class='command'><button type='button' class='editButton' value='" . $obj->ID . "'><img src='/img/save_blue.png'></button></td>
                <td class='command'><button type='button' class='deleteButton' value='" . $obj->ID . "'><img src='/img/delete.png'></button></td>
            </tr>";
    }

    public function drawHeader()
    {
        echo "<tr>
              <th></th>
              <th>Clients</th>
              <th colspan='2'>COMMANDS</th>
             </tr>";
    }
}
?>