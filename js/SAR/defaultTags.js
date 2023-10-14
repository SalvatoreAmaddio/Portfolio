class DefaultTags {
    #author = "Salvatore Amaddio R.";
    #meta = document.createElement('meta');
    #iconLink = document.createElement('link');
    #scripts = ['SAR/SAR','SAR/carousel','SAR/defaultPage'];
    #initMeta = document.head.getElementsByTagName("meta")[1];
    #fonts = 
    [
        "https://fonts.googleapis.com/css2?family=Jost:wght@400;900&display=swap",
        "https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap"
    ];

    #defCSS = ["defaults/wrapper",
              "defaults/commonStructure",
              "defaults/navbar",
            ];

    constructor() //...additionalScripts
    {
//        for(let i=0; i < additionalScripts.length; i++)
//        {   
//            this.#scripts.push(additionalScripts[i]);
//        }
        
       // this.#setScripts();
        this.#setAuthor();
        this.#setIcon();
        this.#setDefaultCSS();
        this.#setDefaultFonts();
        this.#loadPreconnect();
    }


    #setScripts()
    {
        let script;
        for(let i=0; i < this.#scripts.length; i++) 
        {
            script = document.createElement('script');
            script.type = "application/javascript";
            script.src=`js/${this.#scripts[i]}.js`;
            if (i <= 2) 
            {
                document.head.appendChild(script);
            } else 
            {
                document.body.appendChild(script);
            }
        }
    }

    #setAuthor()
    {
        this.#meta.name = "author";
        this.#meta.content = this.#author;
        this.#initMeta.after(this.#meta);        
    }

    #setIcon()
    {
        this.#iconLink.rel = 'icon';
        this.#iconLink.href = 'img/logo.ico';
        this.#meta.after(this.#iconLink);
    }

    #loadPreconnect() 
    {
        let before=this.#iconLink;
     
        let link = document.createElement('link');
        link.rel = 'preconnect';
        link.href = "https://fonts.gstatic.com";
        link.crossOrigin="";
        before.after(link);    

        link = document.createElement('link');
        link.rel = 'preconnect';
        link.href = "https://fonts.googleapis.com";     
        before.after(link);    
    }

    #setDefaultCSS()
    {
        let link;
        let before=this.#iconLink;
        for(let i=0; i < this.#defCSS.length; i++) 
        {
            link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = `css/${this.#defCSS[i]}.css`;
            before.after(link);    
            before = link;
        }
    }

    #setDefaultFonts()
    {
        let link;
        let before=this.#iconLink;
        for(let i=0; i < this.#fonts.length; i++) 
        {
            link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = this.#fonts[i];
            before.after(link);    
            before = link;
        }
    }
}

new DefaultTags();
