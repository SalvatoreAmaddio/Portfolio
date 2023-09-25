let title=document.title;
let ProgrIMkParent;
let hamburgerDropDown;
let hamburger;
let footer;
let contactDetails;
let phoneNumber;
let email;

const Titles = {
	SAR: 0,
	Desktop: 1,
	Mobile: 2,
	Web: 3
}

SetVars();
UpdateCopirightYear();
UpdateDeveloperContactInfo();
SoftwareIMake();
SetHamburgerClick();

function SetVars() 
{
    hamburgerDropDown = document.getElementById("HamburgerDropDown");
    hamburger = document.getElementById("Hamburger");
    footer=document.getElementById("footer").children[0];
    contactDetails = document.getElementById("ContactDetails");
    try 
    {
        phoneNumber=contactDetails.children[0].children[1];
    }
    catch{}
    try 
    {
        email=contactDetails.children[1].children[1];   
    }
    catch {}
    try 
    {
        ProgrIMkParent = document.getElementById("ProgramsIMake").children;
    }
    catch
    {
    }

    window.addEventListener('click', (e)=>ClickOutsideBurgerDropdown(e));
    window.addEventListener('resize', OnResize);
}

function OnResize()
{
        if (window.innerWidth>499 && hamburgerDropDown) 
            hamburgerDropDown.style.display="block";     
        else         
            hamburgerDropDown.style.display="none";    
}

function ClickOutsideBurgerDropdown(e)
{
    switch(true) 
    {
        case IsNull(hamburgerDropDown):
        case IsNull(hamburger):
        case e.target.innerHTML=="Projects":
        return;
    }

    switch(false) 
    {
        case IsDisplayed(hamburgerDropDown):
        case IsDisplayed(hamburger):
        return;    
    }

    let ClickedOnHamburger=hamburger.contains(e.target);
    if (!ClickedOnHamburger)
        Hide(hamburgerDropDown);
}

function SetHamburgerClick()
{
    if (!hamburger) return;
    hamburger.addEventListener("click",HamburgerClicked);
}

function HamburgerClicked()
{
    if (hamburgerDropDown==null) return;
    var display=hamburgerDropDown.style.display;
    hamburgerDropDown.style.display = (display=="block") ? "none" : "block";
}

function UpdateCopirightYear() 
{
    if (footer==null) return;
    footer.textContent =`Copyright © ${new Date().getFullYear()} Salvatore Amaddio Rivolta. All rights reserved.`;
}


function UpdateDeveloperContactInfo() {    
    if (phoneNumber==null || email==null) return;
    phoneNumber.textContent ="+44 7561 049 295";
    email.textContent="salvatoreamaddio94@gmail.com";
}

function SoftwareIMake() {
    if (ProgrIMkParent==null) return;
    switch(true) 
    {
        case title=="SAR":
            UpdateSoftwareIMakeCaption(Titles.SAR);
        break;
        case title=="Desktop Development":
        case title=="Mobile Development":
        case title=="Web Development":
            UpdateSoftwareIMakeCaption(Titles.Desktop);
    }
}

function UpdateSoftwareIMakeCaption(title)
{
    let stringContent;
    switch(true) 
    {
        case title==Titles.SAR:
            stringContent="I make programs designed to run on";
        break;
        default:
            stringContent="I also make programs designed to run on";
    }

    ProgrIMkParent[0].innerHTML=stringContent;
}