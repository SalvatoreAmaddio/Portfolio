class SettingFormList extends FormList 
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

class SettingPage extends DefaultPage
{
    constructor()
    {
        super("Salvatore Amaddio Rivolta");
        this.navBar.isNavLogoEnabled=false;
        new SettingFormList();
    }
}