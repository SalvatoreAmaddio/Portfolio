<?php
abstract class TwoColumnController extends AbstractController
{
    protected string $headerTitle;   
    protected function searchVal() : string 
    {
        return $this->formName."search";
    }

    protected function runSearch() 
    {
        if (!isset($_SESSION[$this->searchVal()])) return;
        $search = $_SESSION[$this->searchVal()]; 
        $this->filterBy(
            function($record) use($search) : bool
            {
                $db = DB::cast($record);
                return Sys::contains($search,$db->Name,true);
            });
    }

    protected function switchSearchValue(AbstractTwoColumns $record) : bool
    {
        if (isset($_SESSION[$this->searchVal()]) && strlen($_SESSION[$this->searchVal()])>0) 
        {
            if (!Sys::contains($_SESSION[$this->searchVal()],$record->Name,true))
                return $_SESSION[$this->searchVal()] = $record->Name; 
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
            $record = AbstractTwoColumns::Cast($this->model);
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
                $record = AbstractTwoColumns::Cast($this->model);
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
            $record = AbstractTwoColumns::Cast($this->model);
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