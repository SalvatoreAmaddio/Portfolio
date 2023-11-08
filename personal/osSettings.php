<?php 
    session_start();
    include 'load.php';
    $controller = new DbController();
    $controller->readPost();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/navBar.css"/>
        <link rel="stylesheet" href="css/homeSection.css"/>
        <title>DB</title>
    </head>

    <body>
        <div id="wrapper">
            <nav>
                <a id="hamburgerIcon">
                    <img src="/img/hamburgericon.png">
                </a>

                <div id="hamburgerDropDown">
                    <ul id="navBarList">
                        <div id="navBarLogo" class="responsiveImg" style="display: none;">
                            <a href="#">
                                <img src="/img/navBarLogo.png" width="250px">
                            </a>                
                        </div>

                        <div id="leftGroup">
                            <li id="home">
                                <a href="https://salvatoreamaddio.co.uk">HOME</a>
                                <span></span>
                            </li>
                        </div>

                        <div id="rightGroup">
                            <li>
                            <a href="https://sxb1plzcpnl503651.prod.sxb1.secureserver.net:2083/cpsess5552043358/frontend/paper_lantern/index.html?login=1&post_login=70012263913526" target="_blank">
                                <div class="responsiveImg">
                                    <img src="/img/cpanel_logo.png">
                                </div>
                            </a>
                            </li>
                        </div>

                        <div id="centerGroup">
                            <li>
                                <a href="desktop.html">PROJECTS</a>
                                <span></span>
                            </li>
                            
                            <li>
                                <a href="mobile.html">CLIENTS</a>
                                <span></span>
                            </li>

                            <li>
                                <a href="web.html">DATABASES</a>
                                <span></span>
                            </li>

                            <li>
                                <a href="database.html">OS</a>
                                <span></span>
                            </li>
                            <li>
                                <a href="database.html">PROJECT TYPES</a>
                                <span></span>
                            </li>
                        </div>
                    </ul>
                </div>
            </nav>
            <main>
                <section class="container">
                    <div class="layer" id="searchPanel">
                        <form>
                            <button id="addNewButton" type="button">
                                <img src="/img/plus.png">
                            </button>
                            <input type="text" name="s" id="searchBox" placeholder="Search..."/>
                        </form>
                    </div>
                </section>

                <section id="dataContainer" class="container">
                    <?php $controller->drawTable();?>
                </section>
            </main>
            <footer>
                <?php echo "Copyright © " . date("Y") . " Salvatore Amaddio Rivolta All rights reserved.";?>
            </footer>
        </div>
    <?php LoadJS();?>
    </body>
</html>