class Sender 
{
    #http = new XMLHttpRequest();
    #pageUrl;
    #dataContainer;
    #responseFn;
    formName;

    constructor(formName = "") 
    {
        this.formName = formName;
        this.#dataContainer = document.getElementById("dataContainer");
        if (!this.#responseFn) 
        {
            this.#responseFn = (e)=>
            {
                this.#dataContainer.innerHTML = '';
                this.#dataContainer.innerHTML = e;
            }
        }

        this.#http.onreadystatechange = () => {
            if (this.IsSuccesfull) 
                this.#responseFn(this.#http.responseText);  
        };
    }

    set onDataReceived(fn) 
    {
        this.#responseFn = fn;
    }

    get currentPath() 
    {
        return window.location.href;
    }

    set pagePath(pageUrl) 
    {
        this.#pageUrl = pageUrl;
    }

    get pagePath() 
    {
        return (this.#pageUrl) ? this.#pageUrl : this.currentPath;
    }

    get IsSuccesfull()
    {
        return this.#http.readyState === XMLHttpRequest.DONE && this.#http.status === 200;
    }

    send(data) 
    {
        this.#http.open("POST",this.pagePath,true);
        this.#http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        this.#http.send(data);
    }

    get storedSearchKey() 
    {
        return sessionStorage.getItem(`${this.formName}search`);
    }

    set storedSearchKey(str) 
    {
        sessionStorage.setItem(`${this.formName}search`,str);
    }

    get storedUpdateVal() 
    {
        return sessionStorage.getItem(`${this.formName}updateVal`);
    }

    set storedUpdateVal(str) 
    {
        sessionStorage.setItem(`${this.formName}updateVal`,str);
    }

    sendUpdateID(id) 
    {
        this.send(`${this.formName}updateID=${id}`)
    }

    sendUpdateValue() 
    {
        this.send(`${this.formName}updateVal=${this.storedUpdateVal}`);            
    }

    sendNewVal(newValue) 
    {
        this.send(`${this.formName}newVal=${newValue}`);
    }
    
    sendDeleteID(id) 
    {
        this.send(`${this.formName}deleteID=${id}`);
    }

    sendSearchKey() 
    {
        this.send(`${this.formName}search=${this.storedSearchKey}`);
    }

    deleteStoredUpdateVal() 
    {
        sessionStorage.removeItem(`${this.formName}updateVal`);
    }
}