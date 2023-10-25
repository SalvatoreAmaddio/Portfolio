class ProjectType {

    static Desktop = new ProjectType(0);
    static Mobile = new ProjectType(1);

    constructor(id) 
    {
        this.id=id;
    }

    is(isDesktop) 
    {

        return (this.id==0) == isDesktop;
    }

    toString()
    {
        return this.id;
    }
}

class Project 
{
    #downloadDemo
    #projectID;
    #projectName;
    #responsiveProjectName;
    #isDesktop = true;
    #headerTitle;
    #logo;
    #readerContent;
    #downloadContainer;
    #me;
    #recordContainer;
    #dataNotFoundContainer;
    #record;   
    #projectInfos; 
    #projectFeatures;
    #data=
    [
        [ProjectType.Desktop,"1","Betting","2023","Peter Randall","https://github.com/SalvatoreAmaddio/BettingDemo","C#","WPF","SQLite",true,false,false,"img/projects/desktop/betting/betting.ico","lorem","#"],
        [ProjectType.Desktop,"2","Meter","2022","Rudy Williams","https://github.com/SalvatoreAmaddio/Meter","C#","WPF","SQLite",true,true,false,"img/projects/desktop/meter/meter.png","lorem","#"],
        [ProjectType.Desktop,"3","FilmFlix","2023","JustIT","https://github.com/SalvatoreAmaddio/FilmFlixPythonProject","Python","Console","SQLite",false,false,false,"img/projects/desktop/filmflix/filmflix.png",this.descr(),"downloads/FilmFlixPythonProject.zip"],
        [ProjectType.Mobile,"3","MyPlanogram","2022/2023","Carole Crockett","https://github.com/SalvatoreAmaddio/MyPlanogram","C#","MAUI","MySQL",false,false,true,"img/projects/mobile/myplanogram/myplanogram.png","lorem","#"]
    ];

    images=[];
    #startingPath = "img/projects/desktop/";
    
    descr()
    {
        return "<p>FilmFlix is a console app project that I developed during my Web Developer's Bootcamp at <a href='https://www.justit.co.uk/' target='_blank'>Just IT</a>. "
        + "It simply consists in a menu nagivation system where the user can view records and execute "
        + "CRUD operations upon such as:</p>"
        + "<ul style='margin:.5rem 0; list-style-position: inside;'>"
        + "<li>Add a new record</li>"
        + "<li>Amend a record</li>"
        + "<li>Delete a record</li>"
        +"</ul>"
        +"This file comes as an Executable. To test it you can press the download demo button. You will get a zip folder containing the FlimFixProject folder. Extract that folder onto your desktop, open it and click on the main.exe file to run the program."
    }

    constructor() 
    {
        this.#me=document.getElementById("project");
        this.#recordContainer = document.getElementById("recordContainer");
        this.#dataNotFoundContainer = document.getElementById("dataNotFoundContainer");
        this.#projectName=this.#me.getElementsByClassName("layerContentTitle")[0].children[0];
        this.#responsiveProjectName = document.getElementById("responsiveTitle").children[0];
        this.#projectInfos=document.getElementById("projectInfos");
        this.#downloadContainer=document.getElementById("downloadContainer");
        let table=this.#projectInfos.children[0];
        this.#projectInfos = table.children[0].children;
        this.#readerContent = document.getElementById("readerContent");
        this.#headerTitle = document.getElementById("headerTitle").children[0];
        this.#projectFeatures=document.getElementById("projectFeatures");
        table=this.#projectFeatures.children[0];
        this.#projectFeatures = table.children[0].children;
        
        this.#downloadDemo = document.getElementById("downloadDemo");

        this.#logo = document.getElementById("projectImgContainer").children[0];
        if (this.#fetch()) 
        {
            this.#fillUp();
            return;
        } 

        this.#recordContainer.style.display="none";
        this.#me.style.paddingLeft=0;
        this.#me.style.paddingRight=0;
        this.#dataNotFoundContainer.style.display="flow-root";
    }

    get dataFound() 
    {
        return (this.#data) && this.#data.some(item => item[1] == this.#projectID);
    }

    get projectType() 
    {
        return (this.#isDesktop) ? "Desktop" : "Mobile";
    }
    
    get OS() 
    {
        return (this.#isDesktop) ? "Windows" : "Android/IOS";
    }

    get year()
    {
        return this.#record[3];
    }

    get clientName()
    {
        return this.#record[4];
    }

    get gitHubLink()
    {
        return this.#record[5];
    }

    get lang()
    {
        return this.#record[6];
    }

    get tech()
    {
        return this.#record[7];
    }

    get db()
    {
        return this.#record[8];
    }

    get useOffice()
    {
        return this.#YesOrNo(this.#record[9]);
    }

    get usePDF()
    {
        return this.#YesOrNo(this.#record[10]);
    }

    get isMultiUser()
    {
        return this.#YesOrNo(this.#record[11]);
    }

    get description()
    {
        return this.#record[13];
    }

    get downloadLink()
    {
        return this.#record[14];
    }

    addImages(...imgs)
    {
        for(let i=0; i < imgs.length; i++) 
        {
            this.images.push(`${this.#startingPath}${this.#record[2].toLowerCase()}/${imgs[i]}`);
        }
    }

    #getInputs()
    {
        let str=this.#projectInfos[5].children[1].children[0].href;
        let index = str.indexOf("?")+1;
        let result = str.substring(index).slice(0, -1);
        let values = result.split("=");
        this.#isDesktop = values[0]=="desktop";
        return values[1];
    }

    #fetch()
    {
        this.#projectID=this.#getInputs();

        this.#data=
        this.#data.filter(item => (this.#isDesktop) ? item[0] == ProjectType.Desktop
        : item[0] == ProjectType.Mobile);

        if (!this.#isDesktop) 
        {
            this.#startingPath.replace("desktop/","mobile/");
            this.#isDesktop = false;
            this.#downloadContainer.style.display="none";
        }

        if (!this.dataFound) 
        {
            document.title="Wrong Input";
            return false;
        }

        this.#record = this.#data.find(item => item[1] == this.#projectID);
        
        return true;
    }

    #fillUp()
    {
        this.#projectName.innerHTML=this.#record[2];
        this.#responsiveProjectName.innerHTML=this.#record[2];
        document.title=this.#record[2];
        this.#headerTitle.innerHTML=`${this.projectType} Project`;

        this.#projectInfos[1].children[1].innerHTML=this.projectType;
        this.#projectInfos[2].children[1].innerHTML=this.OS;
        this.#projectInfos[3].children[1].innerHTML=this.year;
        this.#projectInfos[4].children[1].innerHTML=this.clientName;
        this.#projectInfos[5].children[1].children[0].href = this.gitHubLink;

        this.#projectFeatures[1].children[1].innerHTML=this.lang;
        this.#projectFeatures[2].children[1].innerHTML=this.tech;
        this.#projectFeatures[3].children[1].innerHTML=this.db;
        
        this.#readerContent.innerHTML = this.description;
        if (!this.#isDesktop) 
        {
            this.#projectFeatures[4].style.display="none";
            this.#projectFeatures[5].style.display="none";
        }
        else 
        {
            this.#downloadDemo.href=this.downloadLink;
            this.#projectFeatures[4].children[1].innerHTML=this.useOffice;
            this.#projectFeatures[5].children[1].innerHTML=this.usePDF;
        }

        this.#projectFeatures[6].children[1].innerHTML=this.isMultiUser;    
        this.#logo.src=this.#record[12];
    }

    #YesOrNo(val)
    {
        return (val) ? "Yes" : "No";
    }
}

class PresentationPage extends DefaultPage
{
    #project;
    constructor()
    {
        super("Salvatore Amaddio Rivolta");
        this.addForm(new Form());
        this.#project = new Project();
        
        if (!this.#project.dataFound) return;
        this.#project.addImages
        (
            "img1.jpg","img2.jpg","img3.jpg"
        );
        
        this.addCarousel(new Carousel("carousel1", this.#project.images));
    }
}

new PresentationPage();
