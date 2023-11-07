class FormList
{
    #dataContainer
    #onEditClicked;

    constructor() 
    {
        this.#dataContainer = document.getElementById("dataContainer");
        let editButtons = this.#dataContainer.getElementsByClassName("editButton");

        for(let i=0; i < editButtons.length; i++) 
        {
            editButtons[i].addEventListener("click",(e)=>
            {
                this.#onEditClicked(e.target);
            });
        }
    }

    onEditClicked(fn) 
    {
        this.#onEditClicked = fn;
    }

}