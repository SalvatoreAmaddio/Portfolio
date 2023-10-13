class Project 
{
    #projectName;
    #isDesktop = true;
    #year;
    #client;
    #sourceCodeLink;
    #lang;
    #tech;
    #db;
    #useOffice=false;
    #usePDF=false;
    #isMultiUser=false;
    #logo;
    #description;
    #me;
    #record;   
    #projectInfos; 
    #projectFeatures;
    #data=
    [
        ["1","Betting","2023","Peter Randall","www.","C#","WPF","SQLite",true,false,false,"img/projects/desktop/betting.ico","lorem"],
        ["2","Meter","2022","Rudy Williams","www.","C#","WPF","SQLite",true,true,false,"...","lorem"],
        ["3","MyPlanogram","2022/2023","Carole Crockett","www.","C#","MAUI","MySQL",false,false,true,"...","lorem"]
    ];

    constructor() 
    {
        this.#me=document.getElementById("project");
        this.#projectName=this.#me.getElementsByClassName("layerContentTitle")[0].children[0];
        this.#projectInfos=document.getElementById("projectInfos");
        let table=this.#projectInfos.children[0];
        this.#projectInfos = table.children[0].children;

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
        
        this.#projectInfos[1].children[1].innerHTML=this.projectType;
        this.#projectInfos[2].children[1].innerHTML=this.OS;
        this.#projectInfos[3].children[1].innerHTML=this.#record[2];
        this.#projectInfos[4].children[1].innerHTML=this.#record[3];
        this.#projectInfos[5].children[1].children[0].href =this.#record[4];

        this.#projectFeatures[1].children[1].innerHTML=this.#record[5];
        this.#projectFeatures[2].children[1].innerHTML=this.#record[6];
        this.#projectFeatures[3].children[1].innerHTML=this.#record[7];
        this.#projectFeatures[4].children[1].innerHTML=this.#record[8];
        this.#projectFeatures[5].children[1].innerHTML=this.#record[9];
        this.#projectFeatures[6].children[1].innerHTML=this.#record[10];

        this.#logo.src=this.#record[11];
    }
}

new Project();
