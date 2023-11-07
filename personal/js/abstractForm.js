class FormList
{
    #dataContainer
    #onEditClicked;
    sender;

    constructor() 
    {
        this.sender = new Sender();
        this.#dataContainer = document.getElementById("dataContainer");
    }

    onEditClicked(fn) 
    {
        this.#onEditClicked = fn;
    }

    storeUpdateValue(str) 
    {
        sessionStorage.setItem("updateValue",str);
    }

    canUpdate() 
    {
        if (sessionStorage.getItem("updateValue")) 
        {
            this.sender.onDataReceived((e)=> alert(e));            
            let temp_val = sessionStorage.getItem("updateValue");
            sessionStorage.removeItem("updateValue");
            this.sender.send("updateValue=" + temp_val);            
        }
    }

}