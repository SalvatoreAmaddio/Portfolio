class ImgResizer 
{
    #parentContainer;
    #img = new Image();
    #canvas;
    #context;

    constructor(src, canvas, container)
    {
        this.#parentContainer=container;
        this.#canvas=canvas;
        this.#context = this.#canvas.getContext("2d");
        this.#img.onload=()=>{this.#resize();};
        this.#img.src=src;
        this.#onEvents();
    }

    set src(val)
    {
        this.#img.src=val;
    }

    #onEvents()
    {
        window.onresize=()=>{this.#resize();};
        window.onload=()=>{this.#resize();};
    }

    #resize()
    {
        this.#context.clearRect(0,0,this.#canvas.width, this.#canvas.height);
        this.#canvas.width = window.getComputedStyle(this.#parentContainer, null).getPropertyValue('width').replace('px', '').trim();
        this.#canvas.height = window.getComputedStyle(this.#parentContainer, null).getPropertyValue('height').replace('px', '').trim();
        this.#context.drawImage(this.#img, 0,0,this.#canvas.width, this.#canvas.height);
    }
}

const GoTo = {
    Next: 0,
    Previous: 1,
    Index: 3
}

class CarouselModalView 
{
    #modalView;
    #carousel;
    #modalImg;
    #closeModal;
    #navBar;

    constructor(carousel) 
    {
        this.#carousel = carousel;
        this.#navBar = document.getElementsByTagName("nav")[0];
        this.#modalView = this.#carousel.me.getElementsByClassName("carouselModalView")[0];
        this.#modalImg = this.#modalView.getElementsByClassName("carouselModalImg")[0];
        this.#closeModal = this.#modalView.getElementsByClassName("closeCarouselModalView")[0];
        this.#closeModal.addEventListener("click",()=>
        {
            this.#modalImg.src = "";
            this.#modalView.style.display = "none";       
            this.#navBar.style.zIndex = 100;
            document.body.style.overflow="initial";
        });
    }

    show() 
    {
        this.#modalImg.src = this.#carousel.src;
        this.#navBar.style.zIndex = 0;
        document.body.style.overflow="hidden";
        this.#modalView.style.display = "block"; 
    }
}

class Carousel 
{
    #me;
    carouselID;
    #carouselContent;
    #img;
    #position=0;
    #intervalID = null;
    #timeoutID = null;
    #currentIndex = 0;
    #images=[];
    #thumbnailContainer;
    #prevButton;
    #nextButton;
    onHold = 3000;
    #carouselModalView;

    constructor(carouselID, imgs) 
    {
        this.carouselID = carouselID;
        this.#me = document.getElementById(this.carouselID);
        this.#carouselContent = this.#me.getElementsByClassName("carouselContent")[0];
        this.#img = this.#me.getElementsByClassName("carouselImg")[0];;
        this.#thumbnailContainer = this.#me.getElementsByClassName("thumbnailContainer")[0];
        this.#nextButton = this.#me.getElementsByClassName("next")[0];
        this.#prevButton = this.#me.getElementsByClassName("prev")[0];
        this.#images = imgs;
        this.#img.src = this.#images[0];
        this.#createThumbnail();
        this.currentThumbnail.className+=" active";
        this.#carouselModalView = new CarouselModalView(this);

        this.#img.addEventListener("click",()=>
        {
            this.stop();
            this.#carouselModalView.show();
        });

        this.#prevButton.addEventListener("click",
        () =>
        {
            this.move(GoTo.Previous);
        }); 

        this.#nextButton.addEventListener("click",
        () =>
        {
            this.move(GoTo.Next);
        }); 

        this.start();
    }

    get me() 
    {
        return this.#me;
    }

    get src() 
    {
        return this.#img.src;
    }

    get currentThumbnail() 
    {
        return this.#thumbnailContainer.children[this.#currentIndex];
    }

    get imagesCount() 
    {
        return this.#images.length;
    }

    get breakPoint() 
    {
        return -Math.abs(window.innerWidth);
    }

    get BOF() 
    {
        return this.#currentIndex == 0;
    }

    get EOF() 
    {
        return this.#currentIndex == (this.imagesCount-1);
    }

    get #breakPointHit() 
    {
        return this.#position <= (-100 + this.#imgWidthPercentage(this.#img));
    }

    #createThumbnail() 
    {
        let span; 
        for(let i=0; i < this.imagesCount; i++) 
        {
            span = document.createElement("span");
            span.className = "dot";   
            span.addEventListener("click",()=>{this.move(GoTo.Index,i)});
            this.#thumbnailContainer.appendChild(span); 
        }
    }

    start() 
    {
        clearTimeout(this.#timeoutID);
        this.#intervalID = setInterval(()=>{this.slide()}, 0);
    }

    stop() 
    {
        clearInterval(this.#intervalID);
    }

    #imgWidthPercentage(img) 
    {
        let imgWidth =Math.abs(window.getComputedStyle(img).width.replace("px",""));
        return -Math.abs((imgWidth / window.innerWidth) * 100);
    }

    move(goto, index=-1) 
    {
        this.currentThumbnail.classList.remove("active");
        this.#currentIndex = (goto===3) ? index : (goto===0) ? ++this.#currentIndex : --this.#currentIndex;
        this.#correctIndex();
        this.#img.src = this.#images[this.#currentIndex];
        this.currentThumbnail.className+=" active";
    }
    
    #correctIndex() 
    {
        if (this.#currentIndex < 0) 
            this.#currentIndex = this.imagesCount-1;        

        if (this.#currentIndex >= this.imagesCount) 
            this.#currentIndex = 0;        
    }
    
    slide() 
    {
        if (this.#breakPointHit) 
        {
            this.#position = Math.abs(this.#position);
            this.move(GoTo.Next);
        }

        if (this.#position == 0) 
        {
            this.stop();
            this.#timeoutID = setTimeout(()=>
            {this.start();},this.onHold);
        }

        this.#position--;
        this.#img.style.left=`${this.#position}%`;   
    }
}