class IndexPage extends DefaultPage
{
    constructor()
    {
        super("Salvatore Amaddio Rivolta", 693);
        this.addForm(new Form());
    }


    submitForm() {  
//        this.#form.submit();
//        this.#form.reset(); 
        return false;
     }
}

new IndexPage();