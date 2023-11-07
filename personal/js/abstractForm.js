class FormList
{
    #dataContainer
    #editButtons;
    #onEditClicked;
    #searchBox;
    #formName;
    #tableForm;
    sender;

    constructor(formName="") 
    {
        this.#formName = formName;
        this.sender = new Sender();
        this.#dataContainer = document.getElementById("dataContainer");
        this.#tableForm = this.#dataContainer.getElementsByTagName("form")[0];
        this.#editButtons = this.#dataContainer.getElementsByClassName("editButton");
        this.#searchBox = document.getElementById("searchBox");
        this.#loadEvents();
        this.#searchBox.value =  sessionStorage.getItem("searchMe");
    }

    #loadEvents() 
    {
        this.#searchBox.addEventListener("keyup",
        (e)=>
        {
            this.sender.onDataReceived((e)=> this.#displayData(e));            
            this.sender.send("search=" + e.target.value);
            sessionStorage.setItem("searchMe",e.target.value);
        });

        for(let i = 0; i < this.#editButtons.length; i++) 
        this.#editButtons[i].addEventListener("click", (e)=>this.#onEditClicked(e.target.value));
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

    storeUpdateValue(str) 
    {
        if (!str) return;
        sessionStorage.setItem("updateValue",str);
        sessionStorage.setItem("searchMe",str);
    }

    canUpdate() 
    {
        if (sessionStorage.getItem("updateValue")) 
        {
            let temp_val = sessionStorage.getItem("updateValue");
            if (!temp_val) return
            this.sender.onDataReceived((e)=> this.#displayData(e));            
            sessionStorage.removeItem("updateValue");
            this.sender.send("updateValue=" + temp_val);            
        }
    }

}