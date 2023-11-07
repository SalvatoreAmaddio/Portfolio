class Sender 
{
    #http = new XMLHttpRequest();
    #pageUrl;
    #thisPage = document.createElement("a");
    #dataContainer;
    #responseFn;

    constructor(pageUrl="", fn="") 
    {
        this.#responseFn = fn;
        this.#dataContainer = document.getElementById("dataContainer");
        if (!this.#responseFn) 
        {
            this.#responseFn = (e)=>
            {
                this.#dataContainer.innerHTML = '';
                this.#dataContainer.innerHTML = e;
            }
        }

        this.#thisPage.href = "#";
        this.#pageUrl = (pageUrl) ? pageUrl : this.currentPath;
        this.#http.onreadystatechange = () => {
            if (this.IsSuccesfull) 
                this.#responseFn(this.#http.responseText);  
        };
    }

    onDataReceived(fn) 
    {
        this.#responseFn = fn;
    }

    get currentPath() 
    {
        return this.#thisPage.href.replace('#','');
    }

    get pagePath() 
    {
        return this.#pageUrl;
    }

    get IsSuccesfull()
    {
        return this.#http.readyState === XMLHttpRequest.DONE && this.#http.status === 200;
    }

    send(data) 
    {
        this.#http.open("POST",this.pagePath);
        this.#http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        this.#http.send(data);    
    }
}