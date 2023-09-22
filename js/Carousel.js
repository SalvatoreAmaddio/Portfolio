const CurrentSlide = 
{
    Index : 1, 
    GetSlide : function() {
        try 
        {
            return document.getElementsByClassName("carouselSlide")[this.Index-1];
        }
        catch
        {
            return null;
        }
    },

    Show : function() {
        this.GetSlide().style.display="block";
    },

    UpdateTracker : function(total) {
        this.GetSlide().getElementsByClassName("carouselImgTracker")[0].innerHTML=`${this.Index} of ${total}`;
    },

    GetImg : function() {
        return this.GetSlide().querySelector(".carouselSlide img");
    },
}

const CurrentDot = 
{
    Index:1,
    GetDot()
    {
        try 
        {
            return document.getElementsByClassName("carouselThumnbailOpacity")[this.Index-1];
        }
        catch 
        {
            return null;
        }
    }

}

const Carousel =
{
    Index:0,
    CarouselID:"",
    CurrentSlide,
    CurrentDot,
    Dots : document.getElementsByClassName("carouselThumnbailOpacity"),
    Slides : document.getElementsByClassName("carouselSlide"),
    CarouselTitle : document.getElementsByClassName("carouselTitle")[0],

    GetCarouselContainer : function()
    {
        try 
        {
            return this.CarouselContainer=document.getElementById(this.CarouselID);
        }
        catch
        {
            return null;
        }
    },

    // MODAL //
    GetModalView : function()
    {
        try 
        {
            return this.GetCarouselContainer().getElementsByClassName("carouselModal")[0];
        }
        catch
        {
            return null;
        }
    },

    GetModalImg : function()
    {
        try 
        {
            return this.GetModalView().querySelector(".carouselModal .carouselModalImg");
        }
        catch 
        {
            return null;
        }
    },

    GetModalCaption : function()
    {
        try 
        {
            return this.GetModalView().querySelector(".carouselModal .carouselModalCaption");
        }
        catch 
        {
            return null;
        }
    },

    FullView : function()
    {
        this.GetModalView().style.display="block";
        let selectedImg = this.CurrentSlide.GetImg();
        this.GetModalImg().src=selectedImg.src;  
        this.GetModalCaption().innerHTML=selectedImg.alt;
    },

    CloseModal : function()
    {
        this.GetModalView().style.display="none";
    },

    CorrectIndex : function()
    {
        if (this.Index > this.Slides.length) {this.Index = 1}
        if (this.Index < 1) {this.Index = this.Slides.length}      
    },

    NextSlide : function() 
    {
        this.Index++;
        this.showSlide();
    },

    PreviousSlide : function() 
    {
        this.Index--;
        this.showSlide();
    },
    
    GoToSlide : function(i) 
    {
        this.Index=i;
        this.showSlide();
    },

    showSlide : function() {
        this.CorrectIndex();        
        this.HideAllSlides();
        this.DeactivateAllDots();
        
        this.CurrentSlide.Index = this.Index;
        this.CurrentSlide.Show();

        this.CurrentDot.Index=this.Index;
        let dot=this.CurrentDot.GetDot();
        dot.className += " active";
        
        this.CurrentSlide.UpdateTracker(this.Slides.length);
        this.CarouselTitle.innerHTML = dot.alt;
    },

    HideAllSlides : function()
    {
        for (i = 0; i < this.Slides.length; i++) 
        {
          this.Slides[i].style.display = "none";
        }
    },

    DeactivateAllDots : function()
    {
        for (i = 0; i < this.Dots.length; i++) 
        {
          this.Dots[i].className = this.Dots[i].className.replace(" active", "");
        }
      
    },
}