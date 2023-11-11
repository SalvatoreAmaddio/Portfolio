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

class FormListTwoColumn extends FormList 
{
    constructor() 
    {
        super();
        let id = Number(window.location.href.split("path=")[1]);
        switch(id) 
        {
            case 0:
                this.sender.formName="client";
                document.title="Clients";
            break;
            case 1:
                this.sender.formName="db";
                document.title="DB";
            break;
            case 2:
                this.sender.formName="os";
                document.title="OS";
            break;
            case 3:
                this.sender.formName="projecttype";
                document.title="Project Type";
            break;
            default:return;
        }

        this.onEditClicked = (e) =>
        {
            this.sender.onDataReceived((e)=>
            {
                let newValue = prompt("Change Value", e.trim());
                if (!newValue) return false;                
                this.sender.storedUpdateVal = newValue;
                this.canUpdate();
            });
            this.sender.sendUpdateID(e);
        };

        this.onInsertClicked = (e) =>
        {
            let newValue = prompt("Add New Record");
            if (!newValue) return false;
            this.redispaly();
            this.sender.sendNewVal(newValue);
        };
    }

}


