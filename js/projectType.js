class ProjectType {

    static Desktop = new ProjectType(0);
    static Mobile = new ProjectType(1);
    static Web = new ProjectType(2);

    constructor(id) 
    {
        this.id=id;
    }

    isDesktop(isDesktop) 
    {

        return (this.id==0) == isDesktop;
    }

    isMobile(isMobile) 
    {

        return (this.id==1) == isMobile;
    }

    isWeb(isWeb) 
    {

        return (this.id==2) == isWeb;
    }

    stringa() 
    {
        return (this.id==0) ? "desktop" : "mobile"
    }

    toString()
    {
        return this.id;
    }
}