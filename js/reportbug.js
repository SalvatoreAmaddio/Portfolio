class ReportBugPage extends DefaultPage
{
    #url;
    #softwareName;
    #softwareVersion;
    #softwareYear;
    #sn;
    #sv;
    #sy;
    #reportBugContainer;
    #dataNotFoundContainer

    constructor()
    {
        super("Salvatore Amaddio Rivolta");
        this.addForm(new Form());
        this.#url = document.getElementById("navBarLogo").children[0].href;
        this.#reportBugContainer = document.getElementById("reportBugContainer");
        this.#dataNotFoundContainer = document.getElementById("dataNotFoundContainer");
        this.#softwareName = document.getElementById("softwareName");
        this.#softwareVersion = document.getElementById("softwareVersion");
        this.#softwareYear = document.getElementById("softwareYear");
        this.#sn = document.getElementById("sn");
        this.#sv = document.getElementById("sv");
        this.#sy = document.getElementById("sy");

        if (!this.readInput()) 
        {
            this.#reportBugContainer.style.display="none";
            this.#dataNotFoundContainer.style.display="block";
        }
    }

    readInput() 
    {
        let data = this.#url.split("?");
        if (data.length <= 1) return false;
        try 
        {
            this.#softwareName.innerHTML = data[1].split("=")[1].trim().replace("%20", " ");
            this.#softwareVersion.innerHTML = data[2].split("=")[1].trim().replace(":%20", " ").replace("%20", " "); 
            this.#softwareYear.innerHTML = data[3].split("=")[1].trim().replace("#","");  

            this.#sn.value = this.#softwareName.innerText;
            this.#sv.value = this.#softwareVersion.innerText; 
            this.#sy.value = this.#softwareYear.innerText;   
            return true;        
        }
        catch
        {
            return false;
        }
    }
}

new ReportBugPage();

