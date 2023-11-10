<?php

class ProjectController extends AbstractController 
{
    public function __construct() 
    {
        parent::__construct(new Project());
        $this->formName="project";
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