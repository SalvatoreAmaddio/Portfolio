<?php

class ProjectController extends AbstractController 
{
    public DBController $dbController;
    public TechController $techController;
    public ProLangController $proLangController;
    public ProjectTypeController $projectTypeController;
    public OSController $osController;
    public ClientController $clientController;
    public Project $currentProject;

    public function __construct() 
    {
        parent::__construct(new Project());
        $this->dbController = new DBController();
        $this->techController = new TechController();
        $this->proLangController = new ProLangController();
        $this->projectTypeController = new ProjectTypeController();
        $this->osController = new OSController();
        $this->clientController = new ClientController();
        $this->currentProject = new Project();
        $this->formName="project";
    }

    public function onReceived() 
    {
        if ($this->onRequestedUpdateID()) 
        {
            $projectID = $this->requestedUpdateID();
            $this->currentProject = Project::Cast($this->getByID($projectID));
            echo implode(";",$this->currentProject->asRow());
        }

        if ($this->onRequestedUpdateVal()) 
        {
            $Project = new Project();
            $this->fillRecord($Project,2);
            $this->db->crud(2,
                $Project->projectName,$Project->projectVersion,
                $Project->projectType->ID,$Project->OS->ID,
                $Project->year,$Project->client->clientID,
                $Project->sourceCode, $Project->proLang->ID,
                $Project->tech->ID, $Project->db->ID,
                $Project->office,$Project->pdf,$Project->multiUser,
                $Project->logoPath, $Project->description, $Project->downloadLink,           
                $Project->projectID
            );
            return;
        }

        if ($this->onRequestedNewVal()) 
        {
            $Project = new Project();
            $this->fillRecord($Project,0);
            $this->db->crud(0,
                $Project->projectName,$Project->projectVersion,
                $Project->projectType->ID,$Project->OS->ID,
                $Project->year,$Project->client->clientID,
                $Project->sourceCode, $Project->proLang->ID,
                $Project->tech->ID, $Project->db->ID,
                $Project->office,$Project->pdf,$Project->multiUser,
                $Project->logoPath, $Project->description, $Project->downloadLink          
            );
            return;
        }
    }

    public function fillRecord(&$Project, $crud) 
    {
        $data = explode(";",($crud==2) ? $this->requestedUpdateVal() : $this->requestedNewVal());
        $Project->projectID = $data[0];
        $Project->projectName = $data[1];
        $Project->projectVersion = $data[2];
        $Project->projectType->ID = $data[3];
        $Project->OS->ID = $data[4];
        $Project->year = $data[5];
        $Project->client->clientID = $data[6];
        $Project->sourceCode = $data[7];
        $Project->proLang->ID = $data[8];
        $Project->tech->ID = $data[9];
        $Project->db->ID = $data[10];
        $Project->office = Sys::trueFalse($data[11]);
        $Project->pdf =Sys::trueFalse($data[12]);
        $Project->multiUser = Sys::trueFalse($data[13]);
        $Project->logoPath = "logoPath";
        $Project->description = $data[14];
        $Project->downloadLink = "downLoadLink";
    }

    public function getClients() 
    {
        echo "<option value='0'></option>";
        foreach($this->clientController->recordSource as $record) 
            echo "<option value='".$record->clientID."'>".$record."</option>";
    }

    public function getOS() 
    {
        echo "<option value='0'></option>";
        foreach($this->osController->recordSource as $record) 
            echo "<option value='".$record->ID."'>".$record."</option>";
    }

    public function getProjectTypes() 
    {
        echo "<option value='0'></option>";
        foreach($this->projectTypeController->recordSource as $record) 
            echo "<option value='".$record->ID."'>".$record."</option>";
    }

    public function getProLangs() 
    {
        echo "<option value='0'></option>";
        foreach($this->proLangController->recordSource as $record) 
            echo "<option value='".$record->ID."'>".$record."</option>";
    }

    public function getDBS() 
    {
        echo "<option value='0'></option>";
        foreach($this->dbController->recordSource as $record) 
            echo "<option value='".$record->ID."'>".$record."</option>";
    }

    public function getTechs() 
    {
        echo "<option value='0'></option>";
        foreach($this->techController->recordSource as $record) 
            echo "<option value='".$record->ID."'>".$record."</option>";
    }

    public function style() 
    {
        $obj = Project::Cast($this->model);
        echo"<tr>
                <td class='selector'>➤</td>
                <td class='responsiveRow'>Type</td>
                <td>".$obj->projectType->Name."</td>
                <td class='responsiveRow'>Name</td>
                <td>".$obj->projectName."</td>
                <td class='responsiveRow'>Ver</td>
                <td>".$obj->projectVersion."</td>
                <td class='responsiveRow'>OS</td>
                <td>".$obj->OS->Name."</td>
                <td class='responsiveRow'>Year</td>
                <td>".$obj->year."</td>
                <td class='responsiveRow'>Client</td>
                <td>".$obj->client."</td>
                <td class='responsiveRow'><img class='headerIcon' src='/img/coding.png'></td>
                <td>".$obj->proLang."</td>
                <td class='responsiveRow'>Tech</td>
                <td>".$obj->tech."</td>
                <td class='responsiveRow'><img class='headerIcon' src='/img/db.png'></td>
                <td>".$obj->db."</td>
                <td class='responsiveRow'><img class='headerIcon' src='/img/officeIcon.png'></td>
                <td>".Sys::yesNo($obj->office)."</td>
                <td class='responsiveRow'><img class='headerIcon' src='/img/pdfIcon.png'></td>
                <td>".Sys::yesNo($obj->pdf)."</td>
                <td class='responsiveRow'><img class='headerIcon' src='/img/users.png'></td>
                <td>".Sys::yesNo($obj->multiUser)."</td>
                <td class='command'><button type='button' class='editButton' value='" . $obj->projectID . "'><img src='/img/save_blue.png'></button></td>
                <td class='command'><button type='button' class='deleteButton' value='" . $obj->projectID . "'><img src='/img/delete.png'></button></td>
            </tr>";
    }

    public function drawHeader()
    {
        echo                         
        "<tr>
            <th></th>
            <th>Type</th>
            <th>Name</th>
            <th>Ver.</th>
            <th>OS</th>
            <th class='proLang'>Year</th>
            <th>Client</th>
            <th class='proLang'><img class='headerIcon' src='/img/coding.png'></th>
            <th class='proLang'>Tech</th>
            <th class='proLang'><img class='headerIcon' src='/img/db.png'></th>
            <th class='bool'><img class='headerIcon' src='/img/officeIcon.png'></th>
            <th class='bool'><img class='headerIcon' src='/img/pdfIcon.png'></th>
            <th class='bool'><img class='headerIcon' src='/img/users.png'></th> 
            <th colspan='2'>COMMANDS</th>
        </tr>";
    }
}

?>