class FormList
{
    #dataContainer
    #editButtons;
    #deleteButtons;
    #onEditClicked;
    #onDeleteClicked;
    #onInsertClicked;
    #addNewButton;
    #searchBox;
    sender;

    constructor() 
    {
        this.sender = new Sender();
        this.#dataContainer = document.getElementById("dataContainer");
        this.#editButtons = this.#dataContainer.getElementsByClassName("editButton");
        this.#deleteButtons = this.#dataContainer.getElementsByClassName("deleteButton");
        this.#addNewButton = document.getElementById("addNewButton");
        this.#searchBox = document.getElementById("searchBox");
        this.#loadEvents();
        this.onDeleteClicked = (e) => 
        {
            let conf = confirm("Are you sure you want to delete this record?");
            if (!conf) return false;
            this.redispaly();
            this.sender.sendDeleteID(e);
        };

        if ((this.sender.storedSearchKey) && (this.sender.storedUpdateVal) && !this.sender.storedUpdateVal.toLocaleLowerCase().includes(this.sender.storedSearchKey.toLocaleLowerCase())) 
            this.sender.storedSearchKey = this.sender.storedUpdateVal;

        this.#searchBox.value =  this.sender.storedSearchKey;
    }

    redispaly() 
    {
        this.sender.onDataReceived((e)=>this.displayData(e));
    }

    #loadEvents() 
    {
        this.#searchBox.addEventListener("keyup",
        (e)=>
        {
            this.sender.onDataReceived((e)=> this.displayData(e));       
            this.sender.storedSearchKey = e.target.value;     
            this.sender.sendSearchKey(); 
        });

        this.#addNewButton.addEventListener("click", (e)=> this.#onInsertClicked(e.target.parentNode.value));

        for(let i = 0; i < this.#editButtons.length; i++) 
        {
            this.#editButtons[i].addEventListener("click", (e)=>this.#onEditClicked(e.target.parentNode.value));
            this.#deleteButtons[i].addEventListener("click", (e)=>this.#onDeleteClicked(e.target.parentNode.value));            
        }
    }

    displayData(e) 
    {
        this.#dataContainer.innerHTML = e;
        this.#loadEvents();
    }

    set onEditClicked(fn) 
    {
        this.#onEditClicked = fn;
    }

    set onDeleteClicked(fn) 
    {
        this.#onDeleteClicked = fn;
    }

    set onInsertClicked(fn) 
    {
        this.#onInsertClicked = fn;
    }

    canUpdate() 
    {
        if (this.sender.storedUpdateVal) 
        {
            this.sender.onDataReceived((e)=> this.displayData(e));    
            this.sender.sendUpdateValue(); 
            this.sender.deleteStoredUpdateVal();
        }
    }
}


