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

    stringa() 
    {
        return (this.id==0) ? "desktop" : "mobile"
    }

    toString()
    {
        return this.id;
    }
}

class ProjectPage extends DefaultPage
{
    #projectList;
    #headerTitle;
    #data=
    [
        [ProjectType.Desktop,"1","Betting","img/projects/desktop/betting/betting.ico"],
        [ProjectType.Desktop,"2","Meter","img/projects/desktop/meter/meter.png"],
        [ProjectType.Desktop,"3","FilmFlix","img/projects/desktop/filmflix/filmflix.png"],
        [ProjectType.Mobile,"3","MyPlanogram","img/projects/mobile/myplanogram/myplanogram.png"]
    ];

    constructor()
    {
        super("Salvatore Amaddio Rivolta");
        this.#projectList = document.getElementById("projectList");
        this.#headerTitle = document.getElementById("headerTitle").children[0];
        this.addForm(new Form());
        this.#buildUp();
    }

    get isDesktop()
    {
        return this.#headerTitle.innerHTML.toLowerCase().includes("desktop");
    }

    #buildUp()
    {
        this.#data=
        this.#data.filter(item => (this.isDesktop) ? item[0] == ProjectType.Desktop
        : item[0] == ProjectType.Mobile);

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
        p.innerHTML = `${this.#data[index][2]} System`;
        div.className = "project";
        div.appendChild(img);
        div.appendChild(p);
        return div;
    }

    #createOverlay(index) 
    {
        let div = document.createElement("div");
        let button = document.createElement("button");
        div.className = "overlayProject";
        button.setAttribute("name",this.#data[index][0].stringa());
        button.setAttribute("value", this.#data[index][1]);
        button.innerHTML = "Find out more";
        div.appendChild(button);
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