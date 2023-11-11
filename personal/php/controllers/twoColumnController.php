<?php
abstract class TwoColumnController extends AbstractController
{
    protected string $headerTitle;   

    protected function runSearch() 
    {

        if (!$this->inSession($this->searchValKey())) return;
        $search = $_SESSION[$this->searchValKey()]; 
        $this->filterBy(
            function($record) use($search) : bool
            {
                $rec = AbstractTwoColumns::cast($record);
                return Sys::contains($search,$rec->Name,true);
            });
    }

    protected function switchSearchValue(AbstractTwoColumns $record) : bool
    {
        if ($this->inSession($this->searchValKey()) && strlen($_SESSION[$this->searchValKey()])>0) 
        {
            if (!Sys::contains($_SESSION[$this->searchValKey()],$record->Name,true))
                return $_SESSION[$this->searchValKey()] = $record->Name; 
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
            $record = AbstractTwoColumns::Cast($this->model);
            $this->switchSearchValue($record);
            $this->db->crud(3, $record->ID);
            $this->recordSource->deleteRecord($record);
            $this->runSearch();
            echo $this->drawTable();
            return;
        }

        if ($this->onRequestedNewVal()) 
        {
            $record = AbstractTwoColumns::Cast($this->model);
            $record->Name = ucfirst($this->requestedNewVal());
            $this->switchSearchValue($record);
            $record->ID = $this->db->crud(0, $record->Name);
            $this->recordSource->addRecord($record);
            $this->runSearch();
            echo $this->drawTable();
            return;
        }

        if ($this->onRequestedUpdateID()) 
        {
            $this->model = $this->recordToUpdate();
            $record = AbstractTwoColumns::Cast($this->model);
            $this->storeObj($record);
            echo $record->Name;
            return;
        }

        if ($this->onRequestedUpdateVal()) 
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
              <th>" . $this->headerTitle ."</th>
              <th colspan='2'>COMMANDS</th>
             </tr>";
    }
}

?>