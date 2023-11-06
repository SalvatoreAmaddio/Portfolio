class Sender 
{
    #http = new XMLHttpRequest();
    #pageUrl;
    #thisPage = document.createElement("a");
    #responseFn;

    constructor(pageUrl="", fn="") 
    {
        this.#responseFn = fn;
        this.#thisPage.href = "#";
        this.#pageUrl = (pageUrl) ? pageUrl : this.currentPath;
        this.#http.onreadystatechange = () => {
            if (this.IsSuccesfull) 
            {
                this.#responseFn(this.#http.responseText);
            }
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