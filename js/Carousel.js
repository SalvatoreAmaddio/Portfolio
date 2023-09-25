class AbstractSomething 
{
    Index = 1;
    Collection;

    constructor(collection, index) 
    {
        this.Collection=collection;
        this.Index=index;
    }

    Count()
    {
        return this.Collection.length;
    }

    Current()
    {
        return this.Collection[this.Index-1];
    }

    ShowCurrent() { this.Current().style.display="block"; };

    HideAll()
    {
        for (let i = 0; i < this.Collection.length; i++) 
        {
          this.Collection[i].style.display = "none";
        }
    };
}

class Slides extends AbstractSomething
{

    constructor(collection, slideIndex)
    {    
      super(collection, slideIndex);
    }

    UpdateTracker() {
        this.Current().getElementsByClassName("carouselImgTracker")[0].innerHTML=`${this.Index} of ${this.Collection.length}`;
    };

    GetCurrentSlideImg() {
        return this.Current().querySelector(".carouselSlide img");
    };
}

class Dots extends AbstractSomething
{

    constructor(collection)
    {    
      super(collection,0);
    }

    DeactivateAllDots()
    {
        for (let i = 0; i < this.Collection.length; i++) 
        {
          this.Collection[i].className = this.Collection[i].className.replace(" active", "");
        }
      
    };

    ActivateCurrentDot()
    {
        this.Current().className += " active";
    }
}

class ModalView 
{
    Collection;

    constructor(collection)
    {
        this.Collection=collection;
        this.SetCloseButtonClickEvent();
    }

    Display() {      
        this.Collection.style.display="block";    
    }

    Hide()
    {
        this.Collection.style.display="none";
    }

    GetModalImg()
    {
        return this.Collection.querySelector(".carouselModalImg");
    }

    GetModalCaption()
    {
         return this.Collection.querySelector(".carouselModalCaption");
    }

    SetCloseButtonClickEvent()
    {
        this.Collection.querySelector(".carouselModalClose").addEventListener("click",()=>{this.Hide()});
    }
}

class Carousel
{
    Index=0;
    CarouselID="0";
    CarouselMainContainer;
    Slides;
    Dots;
    ModalView;
    CarouselTitle;

    constructor(carouselID,slideN)
    {
        this.CarouselID=carouselID;
        this.CarouselMainContainer=document.getElementById(this.CarouselID);
        this.ModalView = new ModalView(this.CarouselMainContainer.getElementsByClassName("carouselModal")[0]);
        this.Slides = new Slides(this.CarouselMainContainer.getElementsByClassName("carouselSlide"), slideN);
        this.Dots = new Dots(this.CarouselMainContainer.getElementsByClassName("carouselThumnbailOpacity"));
        this.CarouselTitle= this.CarouselMainContainer.getElementsByClassName("carouselFullScreenAndTitle")[0];
        this.GoToSlide(slideN);
        this.AddFullViewClickEvent();
        this.AddPrevNextClickEvent();
        this.AddThumnBailClickEvent();
    };

    AddThumnBailClickEvent()
    {
        let thumnbails = this.CarouselMainContainer
        .querySelector(".carouselThumnbail").children;        

        for(let i=0; i<thumnbails.length; i++) 
        {
            thumnbails[i].querySelector(".carouselColumns img").addEventListener("click",()=>{this.GoToSlide(i+1);});
        }
    }

    AddPrevNextClickEvent()
    {
        let Commands=this
        .CarouselMainContainer
        .querySelector(".carouselPrevNextCommands").children;        
        Commands[0].addEventListener("click",()=>{this.PreviousSlide()});
        Commands[1].addEventListener("click",()=>{this.NextSlide()});
    }

    AddFullViewClickEvent()
    {
        this.CarouselMainContainer.getElementsByClassName("carouselFullScreenAndTitle")[0].children[1].addEventListener("click",
        ()=>
        {
            this.ModalView.Display();
            this.ModalView.GetModalImg().src = this.Slides.GetCurrentSlideImg().src;
            this.ModalView.GetModalCaption().innerHTML = this.Slides.GetCurrentSlideImg().alt;
        });

    };

    //INDEX CORRECTOR
    CorrectIndex()
    {
        if (this.Index > this.Slides.Count()) {this.Index = 1}
        if (this.Index < 1) {this.Index = this.Slides.Count()}      
    };

    //Slide movement//
    NextSlide() 
    {
        this.Index++;
        this.showSlide();
    };

    PreviousSlide() 
    {
        this.Index--;
        this.showSlide();
    };
    
    GoToSlide(i) 
    {
        this.Index=i;
        this.showSlide();
    };

    showSlide() {
        this.CorrectIndex();        
        this.Slides.HideAll();
        this.Dots.DeactivateAllDots();        

        this.Slides.Index = this.Index;
        this.Slides.ShowCurrent();

        this.Dots.Index=this.Index;
        this.Dots.ActivateCurrentDot();
        
        this.Slides.UpdateTracker();
        this.CarouselTitle.children[0].innerHTML = this.Dots.Current().alt;
    };
      
    toString()  {
        return this.CarouselID;
    };    
}

