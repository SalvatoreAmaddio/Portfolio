class ResizerHelper 
{
    #column1;
    #column2;
    constructor()
    {
        this.#column1 = document.getElementById("column1");
        this.#column2 = document.getElementById("column2");
        window.addEventListener('load', ()=>this.#adjustColumn2Height());
        window.addEventListener('resize', ()=>this.#adjustColumn2Height());
    }

    #adjustColumn2Height() 
    {
        this.#column2Height = this.#column1.getBoundingClientRect().height;
    }

    set #column2Height(height) 
    {
        this.#column2.style.height=`${height}px`;
        this.#column2.style.maxHeight=`${height}px`;
    }
}

class AboutPage extends DefaultPage
{

    #resizerHelper = new ResizerHelper();    
    constructor()
    {
        super("Salvatore Amaddio Rivolta", 693);
        this.addForm(new Form());
    }

    submitForm() {  
//        this.#form.submit();
//        this.#form.reset(); 
        return false;
     }
}

new AboutPage();