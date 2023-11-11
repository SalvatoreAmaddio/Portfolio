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
        if (! $this->inSession($this->searchValKey())) return;
        $search = $_SESSION[$this->searchValKey()]; 
        $this->filterBy(
            function($record) use($search) : bool
            {
                $rec = Client::cast($record);
                return Sys::contains($search,$rec->fullName(), true);
            });
    }

    protected function switchSearchValue(Client $record) : bool
    {
        if ($this->inSession($this->searchValKey()) && strlen($_SESSION[$this->searchValKey()])>0) 
        {
            if (!Sys::contains($_SESSION[$this->searchValKey()],$record->fullName(),true))
                return $_SESSION[$this->searchValKey()] = $record->fullName(); 
        }
        return false;
    }

    public function onReceived() 
    {
        if ($this->onRequestedSearchVal()) 
        {
            $search = $_REQUEST[$this->searchValKey()];
            $_SESSION[$this->searchValKey()] = $search; 
            $this->runSearch();
            echo $this->drawTable();
            return;
        } 

        if ($this->onRequestedDeleteID()) 
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

        if ($this->onRequestedNewVal()) 
        {
            $record = Client::Cast($this->model);
            $arr = explode(" ", $this->requestedNewVal());
            $record->firstName = ucfirst(trim($arr[0]));
            $record->lastName = (count($arr)>1) ? ucfirst(trim($arr[1])) : "";
            $this->switchSearchValue($record);
            $record->clientID = $this->db->crud(0, $record->firstName, $record->lastName);
            $this->recordSource->addRecord($record);
            $this->runSearch();
            echo $this->drawTable();
            return;
        }

        if ($this->onRequestedUpdateID()) 
        {
            $this->model = $this->recordToUpdate();
            $record = Client::Cast($this->model);
            $this->storeObj($record);
            echo $record->fullName();
            return;
        }

        if ($this->onRequestedUpdateVal()) 
        {
            if ($this->isObjStored()) 
                {
                    $record = $this->getStoredObj();
                    $arr = explode(" ", $this->requestedUpdateVal());
                    $record->firstName = ucfirst($arr[0]);
                    $record->lastName = (count($arr)>1) ? ucfirst($arr[1]) : "";
                    $this->switchSearchValue($record);
                    $this->db->crud(2, $record->firstName,$record->lastName,$record->clientID);
                    $this->recordSource->updateRecord($record);
                    $this->destroyStoredObj();
                    $this->runSearch();
                    echo $this->drawTable();
                }
            return;
        }
    }

    public function style() 
    {
        $obj = Client::Cast($this->model);
        echo"<tr>
                <td class='selector'>➤</td>
                <td class='col1'>". $obj . "</td>
                <td class='command'><button type='button' class='editButton' value='" . $obj->clientID . "'><img src='/img/save_blue.png'></button></td>
                <td class='command'><button type='button' class='deleteButton' value='" . $obj->clientID . "'><img src='/img/delete.png'></button></td>
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