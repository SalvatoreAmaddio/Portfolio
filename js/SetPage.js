const DefCSS = ["css/wrapper.css",
                "css/MainStructure.css",
                "MediaQuery/MQMainStructure.css",
                "css/navbar.css",
                "MediaQuery/MQNavBar.css"
                ];

SetAuthor();
SetIcon();
SetDefaultCSS();
SetSAR();

function SetSAR()
{
    var SARscript = document.createElement('script');
    SARscript.setAttribute('src','js/SAR.js');
    document.head.appendChild(SARscript);
}

function SetDefaultCSS(){
    for(let i=0; i < DefCSS.length; i++) 
    {
        link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = DefCSS[i];
        document.head.appendChild(link)    
    }
}

function SetIcon()
{
    link = document.createElement('link');
    link.rel = 'icon';
    link.href = 'img/logo.ico';
    document.head.appendChild(link);
}

function SetAuthor()
{
    meta = document.createElement('meta');
    meta.name = "author";
    meta.content = "Salvatore Amaddio R.";
    document.head.appendChild(meta);
}