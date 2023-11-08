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
    #formName;
    sender;

    constructor() 
    {
        const id = Number(window.location.href.split("path=")[1]);
        switch(id) 
        {
            case 1:
                this.#formName="db";
            break;
            case 2:
                this.#formName="os";
            break;
            case 3:
                this.#formName="projectType";
            break;
            default:return;
        }

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
            this.sendDeleteID(e);
        };

        if ((this.storedSearchKey) && (this.storedUpdateVal) && !this.storedUpdateVal.toLocaleLowerCase().includes(this.storedSearchKey.toLocaleLowerCase())) 
            this.storedSearchKey = this.storedUpdateVal;

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

    sendUpdateID(id) 
    {
        this.sender.send(`${this.#formName}updateID=${id}`)
    }

    sendNewVal(newValue) 
    {
        this.sender.send(`${this.#formName}newVal=${newValue}`);
    }
    
    sendDeleteID(id) 
    {
        this.sender.send(`${this.#formName}deleteID=${id}`);
    }

    deleteStoredUpdateVal() 
    {
        sessionStorage.removeItem(`${this.#formName}updateVal`);
    }

    requery() 
    {
        document.getElementById("formData").submit();
    }

    redispaly() 
    {
        this.sender.onDataReceived((e)=>
        {
            this.displayData(e);
            this.requery();
        });
    }

    #loadEvents() 
    {
        this.#searchBox.addEventListener("keyup",
        (e)=>
        {
            this.sender.onDataReceived((e)=> this.displayData(e));       
            this.storedSearchKey = e.target.value;      
            this.sender.send(`${this.#formName}search=${this.storedSearchKey}`);
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
        if (this.storedUpdateVal) 
        {
            this.sender.onDataReceived((e)=> this.displayData(e));    
            this.sender.send(`${this.#formName}updateVal=${this.storedUpdateVal}`);            
            this.deleteStoredUpdateVal();
        }
    }

}

class FormListTwoColumn extends FormList 
{
    constructor() 
    {
        super();
        this.onEditClicked = (e) =>
        {
            this.sender.onDataReceived((e)=>
            {
                let newValue = prompt("Change Value", e.trim());
                if (!newValue) return false;                
                this.storedUpdateVal = newValue;
                this.requery();
            });
            this.sendUpdateID(e);
        };

        this.onInsertClicked = (e) =>
        {
            let newValue = prompt("Add New Record");
            if (!newValue) 
            {
                return false;
            }       

            this.redispaly();
            this.sendNewVal(newValue);
        };

        this.canUpdate();
    }
}


