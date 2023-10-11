class ResizerHelper 
{
    #column1;
    #column2;
    #_breakPointHit = false;
    
    constructor()
    {
        this.#column1 = document.getElementById("column1");
        this.#column2 = document.getElementById("column2");
        window.addEventListener('load', ()=>this.#adjustColumn2Height());
        window.addEventListener('resize', ()=>this.#adjustColumn2Height());
    }

    #adjustColumn2Height() 
    {   
        if (this.#breakPoint) return;
        this.#column2Height = this.#column1.getBoundingClientRect().height;
    }

    get #hasBreakPointBeenHit() 
    {
        return this.#_breakPointHit;
    }

    set #hasBreakPointBeenHit(val) 
    {
        if (val) this.#column2Height="";        
        this.#_breakPointHit=val;
        return val;
    }

    get #breakPoint()
    {
        this.#hasBreakPointBeenHit = (window.innerWidth<=499.5);
        return this.#hasBreakPointBeenHit;
    }

    set #column2Height(height) 
    {
        let h = (height) ? `${height}px` : "";
        this.#column2.style.height = h;
        this.#column2.style.maxHeight = h;
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