class FormList
{
    #dataContainer
    #editButtons;
    #onEditClicked;
    #searchBox;
    #formName;
    sender;

    constructor(formName="db") 
    {
        this.#formName = formName;
        this.sender = new Sender();
        this.#dataContainer = document.getElementById("dataContainer");
        this.#editButtons = this.#dataContainer.getElementsByClassName("editButton");
        this.#searchBox = document.getElementById("searchBox");
        this.#loadEvents();
        this.#searchBox.value =  this.storedSearchKey;
    }

    get storedSearchKey() 
    {
        return sessionStorage.getItem(`${this.#formName}search`);
    }

    set storedSearchKey(str) 
    {
        sessionStorage.setItem(`${this.#formName}search`,str);
    }

    get storedUpdateVal() 
    {
        return sessionStorage.getItem(`${this.#formName}updateVal`);
    }

    set storedUpdateVal(str) 
    {
        sessionStorage.setItem(`${this.#formName}updateVal`,str);
    }

    deleteStoredUpdateVal() 
    {
        sessionStorage.removeItem(`${this.#formName}updateVal`);
    }

    requery() 
    {
        document.getElementById("formData").submit();
    }

    #loadEvents() 
    {
        this.#searchBox.addEventListener("keyup",
        (e)=>
        {
            this.sender.onDataReceived((e)=> this.#displayData(e));       
            this.storedSearchKey = e.target.value;      
            this.sender.send(`${this.#formName}search=${this.storedSearchKey}`);
        });

        for(let i = 0; i < this.#editButtons.length; i++) 
            this.#editButtons[i].addEventListener("click", (e)=>this.#onEditClicked(e.target.parentNode.value));
    }

    #displayData(e) 
    {
        this.#dataContainer.innerHTML = e;
        this.#loadEvents();
    }

    set onEditClicked(fn) 
    {
        this.#onEditClicked = fn;
    }

    canUpdate() 
    {
        if (this.storedUpdateVal) 
        {
            if (this.storedSearchKey && !this.storedUpdateVal.includes(this.storedSearchKey)) 
                this.storedSearchKey = this.storedUpdateVal;

            this.sender.onDataReceived((e)=> this.#displayData(e));    
            this.sender.send(`${this.#formName}updateVal=${this.storedUpdateVal}`);            
            this.deleteStoredUpdateVal();
        }
    }

}