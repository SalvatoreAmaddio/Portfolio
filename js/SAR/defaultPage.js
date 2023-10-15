class NavBar 
{
    #me;
    #hamburgerDropDown;
    #hamburgerIcon;
    #navLogo;
    #links;

    constructor()
    {
        this.#me = document.getElementsByTagName("nav")[0];
        this.#hamburgerDropDown = document.getElementById("hamburgerDropDown");
        this.#hamburgerIcon = document.getElementById("hamburgerIcon");
        this.#navLogo = document.getElementById("navBarLogo");
        this.#links = this.#me.getElementsByTagName("a");
        this.#setMouseOverAnimation();
        window.addEventListener('click', (e)=>this.#clickOutsideBurgerDropdown(e));
        window.addEventListener('resize', ()=>this.#hideHamburgerDropDown());
        window.addEventListener('resize', () => this.#showNavLogo());
        window.addEventListener('scroll', () => this.#showNavLogo());
        this.#hamburgerIcon.addEventListener("click",()=>this.#toggleHamburgerDropDown());
    }

    get #navBarAtTop() 
    {
        return this.#me.getBoundingClientRect().top==0;
    }

    #showNavLogo()
    {
        this.#navLogo.style.display = "none";
        if (this.#navBarAtTop && (!this.isResponsive)) this.#navLogo.style.display = "block";
    }

    get isResponsive()
    {
        return (window.getComputedStyle(this.#hamburgerIcon, null).getPropertyValue("display")=="none") ? false : true;
    }

    #toggleHamburgerDropDown()
    {
        this.#hamburgerDropDown.style.display 
        = 
        (this.#hamburgerDropDown.style.display=="block") ? "none" : "block";
    }

    #hideHamburgerDropDown()
    {
        this.#hamburgerDropDown.style.display= this.isResponsive ? "none" : "block"
    }

    #clickOutsideBurgerDropdown(e)
    {
        switch(true) 
        {
            case IsNull(this.#hamburgerDropDown):
            case IsNull(this.#hamburgerIcon):
            case e.target.innerHTML.trim()=="MY WORK":
            return;
        }

        switch(false) 
        {
            case IsDisplayed(this.#hamburgerDropDown):
            case IsDisplayed(this.#hamburgerIcon):
            return;    
        }

        let clickedOnHamburger=this.#hamburgerIcon.contains(e.target);
        if (!clickedOnHamburger)
            Hide(this.#hamburgerDropDown);
    }

    #setMouseOverAnimation()
    {
        for(let i=1; i < this.#links.length; i++) 
        {

            this.#links[i].addEventListener("mouseover",()=>this.#loadAnimation(this.#links[i]));            
            this.#links[i].addEventListener("mouseout",()=>this.#unloadAnimation(this.#links[i]));            
        }
    }

    #loadAnimation(link)
    {
        try 
        {
            let span=link.parentNode.getElementsByTagName("span")[0];
            if (!span) return;
            span.className="animateSpan";       
        }
        catch {}
    }

    #unloadAnimation(link)
    {
        try 
        {
            let span=link.parentNode.getElementsByTagName("span")[0];
            if (!span) return;
            span.className="";
        }
        catch{}
    }
}

class Form 
{
    #me;
    #gmailLogo;
    #submitButton;

    constructor()
    {
        this.#me = document.getElementById("formContainer").children[1];
        this.#gmailLogo =  document.getElementById("gmailContainer");
        window.addEventListener('scroll', () => this.#animateGmail());
        this.#submitButton = document.getElementById("btnsubmit");
        this.#submitButton.addEventListener('click', () => this.#submitForm());
    }    

    #submitForm() 
    {
        this.#me.submit();
        this.#me.reset();
    }

    get #getInTouchAtTop()
    {
        return document.getElementById("getInTouch").getBoundingClientRect().top<=100;
    }  

    #animateGmail() 
    {
       this.#gmailLogo.style.animationName=(this.#getInTouchAtTop) ? "hello" : "initial";
    }
}

class DefaultPage 
{
    #pageTitle=document.title;
    #footer = document.getElementsByTagName("footer")[0];
    #websiteName;
    #navBar; 
    #carousels = [];
    #forms = [];

    constructor(websiteName)
    {
        this.#websiteName = websiteName;
        this.#navBar = new NavBar();
        this.#updateCopirightYear();
    }

    get navBar()
    {
        return this.#navBar;
    }

    addForm(form)
    {
        this.#forms.push(form);
    }

    addCarousel(carousel)
    {
        this.#carousels.push(carousel);
    }

    #updateCopirightYear() 
    {
        this.#footer.textContent =`Copyright © ${new Date().getFullYear()} ${this.#websiteName} All rights reserved.`;
    }
}
