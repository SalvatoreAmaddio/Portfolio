class NavBar 
{
    #me;
    #hamburgerDropDown;
    #hamburger;
    #showNavBarAt = 0;
    #navLogo;
    #links;

    constructor(showNavBarAt=0)
    {
        this.#me = document.getElementsByTagName("nav")[0];
        this.#hamburgerDropDown = document.getElementById("hamburgerDropDown");
        this.#hamburger = document.getElementById("hamburger");
        this.#navLogo = document.getElementById("navBarLogo");
        this.#showNavBarAt=showNavBarAt;
        this.#links = this.#me.getElementsByTagName("a");
        this.#setMouseOverAnimation();
        window.addEventListener('click', (e)=>this.#clickOutsideBurgerDropdown(e));
        window.addEventListener('resize', ()=>this.#hideHamburgerDropDown());
        window.addEventListener('resize', () => this.#showNavLogo());
        window.addEventListener('scroll', () => this.#showNavLogo());
        this.#hamburger.addEventListener("click",()=>this.#toggleHamburgerDropDown());
    }

    get #navBarAtTop() 
    {
        return this.#me.getBoundingClientRect().top==0;
    }

    get #navBarIsVisible() 
    {
        return window.innerWidth >= this.#showNavBarAt;
    }

    #showNavLogo()
    {
        this.#navLogo.style.display = "none";
        if (this.#navBarAtTop && this.#navBarIsVisible) this.#navLogo.style.display = "block";
    }

    #toggleHamburgerDropDown()
    {
        this.#hamburgerDropDown.style.display 
        = 
        (this.#hamburgerDropDown.style.display=="block") ? "none" : "block";
    }

    #hideHamburgerDropDown()
    {
        this.#hamburgerDropDown.style.display= (window.innerWidth > this.#showNavBarAt) ? "block" : "none"
    }

    #clickOutsideBurgerDropdown(e)
    {
        switch(true) 
        {
            case IsNull(this.#hamburgerDropDown):
            case IsNull(this.#hamburger):
            case e.target.innerHTML.trim()=="MY WORK":
            return;
        }

        switch(false) 
        {
            case IsDisplayed(this.#hamburgerDropDown):
            case IsDisplayed(this.#hamburger):
            return;    
        }

        let clickedOnHamburger=this.#hamburger.contains(e.target);
        if (!clickedOnHamburger)
            Hide(this.#hamburgerDropDown);
    }

    #setMouseOverAnimation()
    {
        for(let i=0; i < this.#links.length; i++) 
        {
            this.#links[i].addEventListener("mouseover",()=>this.#loadAnimation(this.#links[i]));            
            this.#links[i].addEventListener("mouseout",()=>this.#unloadAnimation(this.#links[i]));            
        }
    }

    #loadAnimation(link)
    {
        try 
        {
            let span=link.parentNode.lastElementChild;
            let isSpan=span.tagName.toLowerCase() == 'span';
            if (!isSpan) return;
            span.className="animateSpan";       
        }
        catch {}
    }

    #unloadAnimation(link)
    {
        try 
        {
            let span=link.parentNode.lastElementChild;
            let isSpan=span.tagName.toLowerCase() == 'span';
            if (!isSpan) return;
            span.className="";
        }
        catch{}
    }
}

class Form 
{
    #form = document.getElementById("bookingForm");
    #gmailLogo =  document.getElementById("gmailContainer");

    constructor()
    {
        window.addEventListener('scroll', () => this.#animateGmail());
    }    

    get #getInTouchAtTop()
    {
        return document.getElementById("getInTouch").getBoundingClientRect().top<=65;
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

    constructor(websiteName, showNavBarAt)
    {
        this.#websiteName = websiteName;
        this.#navBar = new NavBar(showNavBarAt);
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
