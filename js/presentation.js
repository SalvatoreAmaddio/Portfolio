class Project 
{
    #projectName;
    #isDesktop = true;
    #headerTitle;
    #logo;
    #description;
    #me;
    #record;   
    #projectInfos; 
    #projectFeatures;
    #data=
    [
        ["1","Betting","2023","Peter Randall","www.","C#","WPF","SQLite",true,false,false,"img/projects/desktop/betting.ico","lorem"],
        ["2","Meter","2022","Rudy Williams","www.","C#","WPF","SQLite",true,true,false,"img/projects/desktop/meter.png","lorem"],
        ["3","MyPlanogram","2022/2023","Carole Crockett","www.","C#","MAUI","MySQL",false,false,true,"img/projects/mobile/myplanogram.png","lorem"]
    ];
    #images=
    [
        ["1",""],
        ["1",""],
        ["1",""],
        ["1",""],
    ];

    constructor() 
    {
        this.#me=document.getElementById("project");
        this.#projectName=this.#me.getElementsByClassName("layerContentTitle")[0].children[0];
        this.#projectInfos=document.getElementById("projectInfos");
        let table=this.#projectInfos.children[0];
        this.#projectInfos = table.children[0].children;
        
        this.#headerTitle = document.getElementById("headerTitle").children[0];
        this.#projectFeatures=document.getElementById("projectFeatures");
        table=this.#projectFeatures.children[0];
        this.#projectFeatures = table.children[0].children;

        this.#logo = document.getElementById("projectImgContainer").children[0];
        this.#fetch();
        this.#fillUp();
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
        return this.#record[2];
    }

    get clientName()
    {
        return this.#record[3];
    }

    get gitHubLink()
    {
        return this.#record[4];
    }

    get lang()
    {
        return this.#record[5];
    }

    get tech()
    {
        return this.#record[6];
    }

    get db()
    {
        return this.#record[7];
    }

    get useOffice()
    {
        return this.#YesOrNo(this.#record[8]);
    }

    get usePDF()
    {
        return this.#YesOrNo(this.#record[9]);
    }

    get isMultiUser()
    {
        return this.#YesOrNo(this.#record[10]);
    }

    #fetch()
    {
        let item=sessionStorage.getItem("desktop");

        if (!item) 
        {
            this.#isDesktop = false;
            item = sessionStorage.getItem("mobile");
        }

        this.#record = this.#data[item-1];
    }

    #fillUp()
    {
        this.#projectName.innerHTML=this.#record[1];
        document.title=this.#record[1];
        this.#headerTitle.innerHTML=`${this.projectType} Project`;

        this.#projectInfos[1].children[1].innerHTML=this.projectType;
        this.#projectInfos[2].children[1].innerHTML=this.OS;
        this.#projectInfos[3].children[1].innerHTML=this.year;
        this.#projectInfos[4].children[1].innerHTML=this.clientName;
        this.#projectInfos[5].children[1].children[0].href = this.gitHubLink;

        this.#projectFeatures[1].children[1].innerHTML=this.lang;
        this.#projectFeatures[2].children[1].innerHTML=this.tech;
        this.#projectFeatures[3].children[1].innerHTML=this.db;

        if (!this.#isDesktop) 
        {
            this.#projectFeatures[4].style.display="none";
            this.#projectFeatures[5].style.display="none";
        }
        else 
        {
            this.#projectFeatures[4].children[1].innerHTML=this.useOffice;
            this.#projectFeatures[5].children[1].innerHTML=this.usePDF;
        }

        this.#projectFeatures[6].children[1].innerHTML=this.isMultiUser;    
        this.#logo.src=this.#record[11];
    }

    #YesOrNo(val)
    {
        return (val) ? "Yes" : "No";
    }
}

class PresentationPage extends DefaultPage
{
    constructor()
    {
        super("Salvatore Amaddio Rivolta", 651.5);
        this.addForm(new Form());
        new Project();
    }
}

new PresentationPage();
