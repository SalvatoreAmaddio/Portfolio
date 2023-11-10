<?php
class Project extends AbstractModel
{
    public $projectID;
    public string $projectName;
    public string $projectVersion;
    public ProjectType $projectType;
    public OS $OS;
    public int $year;
    public Client $client;
    public string $sourceCode;
    public ProLang $proLang;
    public Tech $tech;
    public DB $db;
    public bool $office;
    public bool $pdf;
    public bool $multiUser;
    public string $logoPath;
    public string $description;
    public string $downloadLink;

    function __construct() 
    {
        $this->tableName="project";
        $this->projectVersion="1.0.0.0";
        $this->projectType = new ProjectType();
        $this->OS = new OS();
        $this->client = new Client();
        $this->tech=new Tech();
        $this->db= new DB();
        $this->proLang = new ProLang();
        $this->office = false;
        $this->pdf = false;
        $this->multiUser = false;
    }
    
    public function create(array &$row) : Project
    {
        $os = new Project();
        $os->readAssoc($row);
        return $os;
    }

    public function readAssoc(array &$row) 
    {
        $this->row = &$row;
        $this->projectID = &$row["projectID"];
        $this->projectName = &$row["projectName"];
        $this->projectVersion = &$row["projectVersion"];
        $this->projectType->readAssoc($row);
        $this->projectType->Name = &$row["projecttypeName"];
        $this->OS->readAssoc($row);
        $this->year = &$row["year"];
        $this->client->readAssoc($row);
        $this->sourceCode = &$row["sourceCode"];
        $this->proLang->readAssoc($row);
        $this->tech->readAssoc($row);
        $this->db->readAssoc($row);
        $this->office = &$row["office"];
        $this->pdf = &$row["pdf"];
        $this->multiUser = &$row["multiUser"];
        $this->logoPath = &$row["logoPath"];
        $this->description = &$row["description"];
        $this->downloadLink = &$row["downloadLink"];
    }

    public function asRow() : array 
    {
        if ($this->row==null) 
            $this->row = array(
        "projectID" => &$this->projectID, 
        "projectName" => &$this->projectName,
        "lastVersion" => &$this->projectVersion
        );
        return $this->row;
    }

    public function bindTypeParams(int $query) : string 
    {
        switch ($query) {
            case 0:
                return "ss";
            case 2:
                return "ssi";
            case 3:
                return "i";
        }
    }

    public function selectAll(): string
    {
        return "SELECT * FROM allprojects";
    }
    
    public function updateSQL() : string
    {
        return "update " . $this->tableName . " SET firstName = ?, lastName = ? WHERE ".$this->tableName."ID=?;";
    }
    
    public function insertSQL() : string 
    {
        return "insert into " . $this->tableName . " (firstName, lastName) VALUES (?,?);";
    }

    public function __toString()
    {
        return $this->projectID;
    }

    public function matchPK(int $id): bool
    {
        return $this->projectID == $id;
    }
    
    public function IsEqual(AbstractModel $model) : bool 
    {
        if ($model instanceof Project) 
        {
            /** @var Project $obj */
            $obj = $model;
            return $this->projectID == $obj->projectID;
        }
        return false;
    }

    public static function Cast(AbstractModel $model) : Project 
    {
    /** @var Project $obj */
       $obj = $model;
       return $obj;
    }

}
?>