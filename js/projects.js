class ProjectPage extends DefaultPage
{
    #projectList;
    #data=
    [
        [ProjectType.Desktop,"1","Betting","img/projects/desktop/betting/betting.ico"],
        [ProjectType.Desktop,"2","Meter","img/projects/desktop/meter/meter.png"],
        [ProjectType.Desktop,"3","FilmFlix","img/projects/desktop/filmflix/filmflix.png"],
        [ProjectType.Mobile,"3","MyPlanogram","img/projects/mobile/myplanogram/myplanogram.png"],
        [ProjectType.Web,"1","Dave Smith","img/projects/web/ds.png","https://salvatoreamaddio.github.io/DaveSmith/"],
        [ProjectType.Web,"2","Dark Star Ink","img/projects/web/darkStarInk.ico","https://salvatoreamaddio.github.io/DarkStarInk/"],
        [ProjectType.Web,"3","Sape","img/projects/web/sape.png","https://salvatoreamaddio.github.io/SAPE/"],
        [ProjectType.Web,"4","JustIT Clone","img/projects/web/justitclone.png","https://salvatoreamaddio.github.io/JustITClone/"]
    ];

    constructor()
    {
        super("Salvatore Amaddio Rivolta");
        this.#projectList = document.getElementById("projectList");
        this.addForm(new Form());
        this.#buildUp();
    }

    get isDesktop()
    {
        return document.title.toLowerCase().includes("desktop");
    }

    get isMobile()
    {
        return document.title.toLowerCase().includes("mobile");
    }

    get isWeb()
    {
        return document.title.toLowerCase().includes("web");
    }

    get is() 
    {
        switch(true) 
        {
            case this.isDesktop:
                return ProjectType.Desktop;
            case this.isMobile:
                return ProjectType.Mobile;
            case this.isWeb:
                return ProjectType.Web;
            default: return ProjectType.Desktop
        }
    }

    #buildUp()
    {
        this.#data = this.#data.filter(item => item[0] == this.is);

        for(let i=0; i < this.#data.length; i++) 
        {
            this.#projectList.appendChild(this.#addListItem(i));
        }
    }

    #addListItem(index) 
    {
        let li = document.createElement("li");
        li.appendChild(this.#createOverlay(index));
        li.appendChild(this.#createProject(index));
        return li;
    }

    #createProject(index) 
    {
        let div = document.createElement("div");
        let img = document.createElement("img");
        let p = document.createElement("p");
        img.src = this.#data[index][3];
        let projectName = "";        
        switch(this.is) 
        {
            case ProjectType.Desktop:
                projectName = `${this.#data[index][2]} System`;
            break;
            case ProjectType.Mobile:
                projectName = `${this.#data[index][2]} App`;
            break;
            case ProjectType.Web:
                projectName = `${this.#data[index][2]}`;
            break;
        }

        p.innerHTML = projectName;
        div.className = "project";
        div.appendChild(img);
        div.appendChild(p);
        return div;
    }

    #createLink(index) 
    {
        if (!this.isWeb) 
        {
            let button = document.createElement("button");
            button.setAttribute("name",this.#data[index][0].stringa());
            button.setAttribute("value", this.#data[index][1]);
            button.innerHTML = "Find out more";
            return button;    
        }

        let a = document.createElement("a");
        a.innerHTML="Visit"
        a.target="_blank"
        a.href = this.#data[index][4];
        return a;
    }

    #createOverlay(index) 
    {
        let div = document.createElement("div");
        div.className = "overlayProject";
        div.appendChild(this.#createLink(index));
        return div;
    }
}

function getForm(node)
{
    let parent;

    while (true) 
    {
        parent = node.parentNode;
        if (parent.nodeName=="FORM") 
        {
            return parent;
        } 
        node=parent;
    }
}

new ProjectPage();