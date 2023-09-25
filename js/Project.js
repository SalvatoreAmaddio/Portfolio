const ProjectType = {
	Desktop: 0,
	App: 1,
	Web: 2,
}

class Project 
{
    SoftwareName="";
    ProjectType=0;
    ClientName="Salvo";
    Year="2024";
    Logo;
    LogoPath="DesktopProjects/Meter.png";
    Carousel;
    Specification;
    FeaturesArray=["Excel", "MultiUser", "PDF"];
    Features;
    DescriptionText="";
    Description;
    Pictures;
    SlideContainer;
    ThumnbailContainer;

    constructor(softwareName,clientName,year,logoPath,featuresArray,descriptionText,pictures,projectType)
    {
        this.SoftwareName=softwareName;
        this.ClientName=clientName;
        this.Year=year;
        this.LogoPath=logoPath;
        this.FeaturesArray=featuresArray;
        this.DescriptionText=descriptionText;
        this.Pictures=pictures;
        this.ProjectType=projectType;
    }

    ConnectToDOM(presentationContainer)
    {
        this.Specification=presentationContainer.querySelector(".Specification").children;
        this.Logo=presentationContainer.querySelector(".Logo").children[0];
        this.Features=presentationContainer.querySelector(".Features").children[1];
        this.Description=presentationContainer.querySelector(".Description");
        this.SlideContainer = presentationContainer.querySelector(".carouselSlideContainer");       
        this.ThumnbailContainer = presentationContainer.querySelector(".carouselThumnbail");       
        this.FillSpecification();
        this.SetLogoSrc();
        this.AddFeatures();
        this.AddDescription();
        this.AddSlides();
    }

    AddSlides()
    {
        let img;
        let node;

        for(let i=0; i < this.Pictures.length; i++) 
        {
            node = Project.SlideTemplate.cloneNode(true);
            img = node.querySelector("img");
            img.src=this.Pictures[i].Path;
            img.alt=this.Pictures[i].Alt;
            this.SlideContainer.appendChild(node);

            node = Project.ColumnTemplate.cloneNode(true);
            img = node.querySelector("img");
            img.src=this.Pictures[i].Path;
            img.alt=this.Pictures[i].Alt;
            this.ThumnbailContainer.appendChild(node);
        }
    }

    AddDescription()
    {
        this.Description.appendChild
        (
        document.createRange().createContextualFragment(                            
        `<p>${this.DescriptionText}</p>`)
        );
    
    }

    AddFeatures()
    {
        for(let i=0; i<this.FeaturesArray.length; i++) 
        {
            this.CreateFeatureNode(this.FeaturesArray[i]);
        }
    }

    CreateFeatureNode(Text)
    {
        this.Features
        .appendChild(
                     document.createRange().createContextualFragment(                            
                     `<li><img src='img/checked.png'/><span>${Text}</span></li>`));
    }

    SetLogoSrc()
    {
        this.Logo.src=this.LogoPath;
    }

    FillSpecification()
    {
        this.Specification[1].innerHTML=this.SoftwareName;
        this.Specification[4].innerHTML=this.ClientName;
        this.Specification[6].innerHTML=`<strong>YEAR:</strong> ${this.Year}`;
    }

    static ClearChildren(node)
    {
        var child = node.lastElementChild; 
        while (child) {
            node.removeChild(child);
            child = node.lastElementChild;
        }
    }

    static main = document.querySelector("main");
    static template = Project.main.querySelector(".Layer");
    static SlideTemplate= Project.template.querySelector(".carouselSlide");
    static ColumnTemplate = Project.template.querySelector(".carouselColumns");  
    static ProjectBeltTemplate= document.querySelector("#ProjectBelt");

    static DuplicateProject(projects)
    {
        let newProject;
        let toRemove;
                
        for(let i=0; i < projects.length; i++) 
        {
            newProject = Project.template.cloneNode(true);
            newProject.querySelector(".ImgGallery").querySelector("div").id= `Carousel${i+1}`;
            Project.template.insertAdjacentElement("afterend",newProject);   

            toRemove=newProject.querySelector(".carouselSlideContainer").firstElementChild;
            newProject.querySelector(".carouselSlideContainer").removeChild(toRemove);

            toRemove=newProject.querySelector(".carouselThumnbail").firstElementChild;
            newProject.querySelector(".carouselThumnbail").removeChild(toRemove);

            projects[i].ConnectToDOM(newProject.querySelector(".PresentationContainer"));            
            newProject.id=`${projects[i].SoftwareName}Project`;
            projects[i].Carousel=new Carousel(`Carousel${i+1}`,1);
        }
        
        Project.main.removeChild(Project.template);
        Project.UpdateProjectBelt(Projects);
    }

    static UpdateProjectBelt(projects)
    {
        for (let i=0; i<projects.length; i++) 
        {
            let a = document.createElement("a");
            a.href=`#${projects[i].SoftwareName}Project`;    
            a.target="_self";

            let div1=document.createElement("div");
            let div2=document.createElement("div");
            let img = document.createElement("img");
            let p = document.createElement("p");

            let softName="";

            switch(projects[i].ProjectType) 
            {
                case 0:
                    softName=`${projects[i].SoftwareName} System`;
                break;
                case 1:
                    softName=`${projects[i].SoftwareName} App`;
                break;
                case 2:
                    softName=`${projects[i].SoftwareName}`;
                break;
            }

            p.innerHTML=softName;

            img.src=projects[i].LogoPath;
            img.id=`${projects[i].SoftwareName}ProjectLogo`;
            div2.appendChild(img);
            div1.appendChild(div2);
            div1.appendChild(p);
            a.appendChild(div1);
            Project.ProjectBeltTemplate.appendChild(a);
        }
    }
}

class SlideImage 
{
    constructor(path, alt)
    {
        this.Path=path;
        this.Alt=alt;
    }
}