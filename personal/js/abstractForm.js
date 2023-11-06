class FormList
{

    #dataContainer
    #footer;

    constructor() 
    {
        this.#dataContainer = document.getElementById("dataContainer");
        this.#footer = document.getElementsByTagName("footer")[0];
    }

    get isScrolling() 
    {
        return document.documentElement.scrollHeight > this.footerBottom;
    }

    get footerHeight() 
    {
        return this.#footer.getBoundingClientRect().height;
    }
}


new FormList();