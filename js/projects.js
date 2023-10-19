class ProjectPage extends DefaultPage
{
    constructor()
    {
        super("Salvatore Amaddio Rivolta");
        this.addForm(new Form());
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