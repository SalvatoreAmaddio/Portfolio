<?php 
    session_start();
    include 'load.php';
    $current_url = $_SERVER['REQUEST_URI'];
    $url_components = parse_url($current_url);
    parse_str($url_components['query'], $params);
    $path = $params['path'];
    $controller;
    switch($path) 
    {
        case 0:
            $controller = new ClientController();
        break;
        case 1:
            $controller = new DBController();
        break;
        case 2:
            $controller = new OSController();
        break;
        case 3:
            $controller = new ProjectTypeController();
        break;
        default:
            exit();
    }
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
                        <div id="navBarLogo" class="responsiveImg">
                            <a href="https://salvatoreamaddio.co.uk">
                                <img src="/img/navBarLogo.png" width="250px">
                            </a>                
                        </div>

                        <div id="leftGroup">
                            <li id="home">
                                <a href="home.php">HOME</a>
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
                            <span></span>
                            </li>
                            <li>
                            <a href="https://sxb1plzcpnl503651.prod.sxb1.secureserver.net:2083/cpsess5552043358/frontend/paper_lantern/index.html?login=1&post_login=70012263913526" target="_blank">
                                <div class="responsiveImg">
                                    <img src="/img/logout.png">
                                </div>
                            </a>
                            <span></span>
                            </li>
                        </div>

                        <div id="centerGroup">
                            <li>
                                <a href="#">PROJECTS</a>
                                <span></span>
                            </li>
                            
                            <li>
                                <a href="settings.php?path=0">CLIENTS</a>
                                <span></span>
                            </li>

                            <li>
                                <a href="settings.php?path=1">DATABASES</a>
                                <span></span>
                            </li>

                            <li>
                                <a href="settings.php?path=2">OS</a>
                                <span></span>
                            </li>
                            <li>
                                <a href="settings.php?path=3">PROJECT TYPES</a>
                                <span></span>
                            </li>
                        </div>
                    </ul>
                </div>
            </nav>

            <main>
                <section class="container">
                    <div class="layer" id="searchPanel">
                            <button id="addNewButton" type="button">
                                <img src="/img/plus.png">
                            </button>
                            <input type="text" name="s" id="searchBox" placeholder="Search..."/>
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
        <script>
            class SettingPage extends DefaultPage
            {
                constructor()
                {
                    super("Salvatore Amaddio Rivolta");
                    this.navBar.isNavLogoEnabled=false;
                }
            }
            new SettingPage();
            new FormListTwoColumn();
        </script>        
    </body>
</html>