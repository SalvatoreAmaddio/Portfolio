<?php
class DbController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new DB());
    }

    public function onSend() 
    {
        if (isset($_REQUEST["search"])) 
        {
            $search = $_REQUEST['search'];
            $this->filterBy(
                function($record) use($search) : bool
                {
                    $db = DB::cast($record);
                    $name = Sys::toLower($db->Name); 
                    $search = Sys::toLower($search); 
                    return str_contains($name,$search);
                });
            echo $this->drawTable();
        } 
        
        if (isset($_REQUEST["dbID"])) 
        {
             /** @var DB $obj */
             $obj = $this->getByID($_REQUEST['dbID']);
            echo $obj->Name;
        } 
        else echo "did not work";
    }

    public function drawHeader()
    {
        echo "<tr>
              <th></th>
              <th>Operating System</th>
              <th colspan='2'>COMMANDS</th>
             </tr>";
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

    public function drawHeader()
    {

    }

    public function Style() 
    {

    }
}
?>