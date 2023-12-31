class ProjectFormPage extends DefaultPage {
    #projectID;
    #projectName = document.getElementById("projectName");
    #projectVersion = document.getElementById("projectVersion");
    #projectType = document.getElementById("projectType");
    #projectOS = document.getElementById("projectOS");
    #projectYear = document.getElementById("projectYear");
    #projectClient = document.getElementById("projectClient");
    #sourceCode = document.getElementById("sourceCode");
    #proLang = document.getElementById("proLang");
    #technology = document.getElementById("technology");
    #projectDatabase = document.getElementById("projectDatabase");
    #officePack = document.getElementById("officePack");
    #pdfReport = document.getElementById("pdfReport");
    #multiUser = document.getElementById("multiUser");
    #description = document.getElementById("description");
    #saveButton = document.getElementById("saveButton");
    sender = new Sender("project");

    constructor()
    {
        super("Salvatore Amaddio Rivolta");
        this.projectID = sessionStorage.getItem("projectID");
        this.year = new Date().getFullYear();
        this.Version = "1.0.0.0";
        if (this.projectID) 
        {
            this.sender.onDataReceived = (e) => this.fillData(e);
            this.sender.sendUpdateID(this.projectID);
        }

        this.#saveButton.addEventListener("click",(e)=>
            {
                this.sender.onDataReceived = (e) => 
                {
                    alert(`Record successfully ${(this.projectID) ? 'changed' : 'added'}`);
                    window.location.href ="projects.php";
                };
                if (this.projectID) 
                {
                    this.sender.sendUpdateValue(this.toArray());
                }
                else
                    this.sender.sendNewVal(this.toArray()); 
        });
    }

    toArray() 
    {
        return `${this.#projectID};${this.Name};${this.Version};${this.ProjectType};${this.OS};${this.year};${this.client};${this.sourceCode};${this.proLang};${this.tech};${this.db};${this.office};${this.pdf};${this.users};${this.description}`; 
    }

    fillData(e) 
    {
        let values = e.split(";");
        this.#projectID = values[0];
        this.Name = values[1];
        this.Version = values[2];
        this.ProjectType = values[3];
        this.OS = values[5];
        this.year = Number(values[7]);
        this.client = values[8];
        this.sourceCode = values[11];
        this.proLang = values[12];
        this.tech = values[14];
        this.db = values[16];
        this.office = values[18];
        this.pdf = values[19];
        this.users = values[20];
        this.description = values[22];
    }

    get projectID() 
    {
        return this.#projectID;
    }

    set projectID(id) 
    {
        this.#projectID = id;
    }

    get Name() 
    {
        return this.#projectName.value;
    }

    set Name(value) 
    {
        this.#projectName.value = value;
    }

    get Version() 
    {
        return this.#projectVersion.value;
    }

    set Version(value) 
    {
        this.#projectVersion.value=value;
    }

    get ProjectType() 
    {
        return this.#projectType.value;
    }

    set ProjectType(value) 
    {
        this.#projectType.value=value;
    }

    get OS() 
    {
        return this.#projectOS.value;
    }

    set OS(value) 
    {
        this.#projectOS.value=value;
    }

    get year() 
    {
        return this.#projectYear.value;
    }

    set year(value) 
    {
        this.#projectYear.value = Number(value);
    }

    get client() 
    {
        return this.#projectClient.value;
    }

    set client(value) 
    {
        this.#projectClient.value=value;
    }

    get sourceCode() 
    {
        return this.#sourceCode.value;
    }

    set sourceCode(value) 
    {
        this.#sourceCode.value=value;
    }

    get proLang() 
    {
        return this.#proLang.value;
    }

    set proLang(value) 
    {
        this.#proLang.value=value;
    }

    get tech() 
    {
        return this.#technology.value;
    }

    set tech(value) 
    {
        this.#technology.value=value;
    }

    get db() 
    {
        return this.#projectDatabase.value;
    }

    set db(value) 
    {
        this.#projectDatabase.value=value;
    }

    get office() 
    {
        return this.#officePack.checked;
    }

    set office(value) 
    {
        this.#officePack.checked=(value==0) ? false : true;
    }

    get pdf() 
    {
        return this.#pdfReport.checked;
    }

    set pdf(value) 
    {
        this.#pdfReport.checked=(value==0) ? false : true;
    }

    get users() 
    {
        return this.#multiUser.checked;
    }

    set users(value) 
    {
        this.#multiUser.checked=(value==0) ? false : true;
    }

    get description() 
    {
        return this.#description.value;
    }

    set description(value) 
    {
        this.#description.value=value;
    }
}