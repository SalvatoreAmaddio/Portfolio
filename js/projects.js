class ProjectPage extends DefaultPage
{
    constructor()
    {
        super("Salvatore Amaddio Rivolta", 651.5);
        this.addForm(new Form());
    }
}


function send(evt) 
{
    sessionStorage.clear();
    let form = getForm(evt);
    sessionStorage.setItem(evt.name, evt.value);
    form.submit();
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
        } else 
        {
            node=parent;
        }
    }
}

new ProjectPage();