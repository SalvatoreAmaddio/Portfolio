class FormList
{
    #dataContainer
    #editButtons;
    #deleteButtons;
    #onEditClicked;
    #onDeleteClicked;
    #searchBox;
    #formName;
    sender;

    constructor(formName="db") 
    {
        this.#formName = formName;
        this.sender = new Sender();
        this.#dataContainer = document.getElementById("dataContainer");
        this.#editButtons = this.#dataContainer.getElementsByClassName("editButton");
        this.#deleteButtons = this.#dataContainer.getElementsByClassName("deleteButton");
        this.#searchBox = document.getElementById("searchBox");
        this.#loadEvents();
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

    get storedNewVal() 
    {
        return sessionStorage.getItem(`${this.#formName}newVal`);
    }

    set storedNewVal(str) 
    {
        sessionStorage.setItem(`${this.#formName}newVal`,str);
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
            this.sender.onDataReceived((e)=> this.displayData(e));       
            this.storedSearchKey = e.target.value;      
            this.sender.send(`${this.#formName}search=${this.storedSearchKey}`);
        });

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

const formList = new FormList();
formList.onEditClicked = (e) =>
{
    formList.sender.onDataReceived((e)=>
    {
        let newValue = prompt("Change Value", e.trim());
        if (!newValue) return false;                
        formList.storedUpdateVal = newValue;
        formList.requery();
    });
    formList.sender.send("updateID=" + e)
};

formList.onDeleteClicked = (e) => 
{
    let conf = confirm("Are you sure you want to delete this record?");
    if (!conf) return false;
    formList.sender.onDataReceived((e)=>
    {
        formList.displayData(e);
        formList.requery();
    });
    formList.sender.send("deleteID=" + e)
};

formList.canUpdate();
