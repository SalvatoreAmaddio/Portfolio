<?php 
    session_start();
    include 'load.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/navBar.css"/>
        <link rel="stylesheet" href="css/projects.css"/>
        <title>Projects</title>
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
                            <input type="text" name="s" id="searchBox" placeholder="Search..."/>
                    </div>
        </section>

        <section id="dataContainer" class="container">
            <table>
                <tr>
                    <th></th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Ver.</th>
                    <th>OS</th>
                    <th class="proLang">Year</th>
                    <th>Client</th>
                    <th class="proLang">Lang</th>
                    <th class="proLang">Tech</th>
                    <th class="proLang">DB</th>
                    <th class="bool">Office Pack</th>
                    <th class="bool">PDF</th>
                    <th class="bool">Multi-Users</th> 
                    <th colspan="2">COMMANDS</th>
                </tr>
                <tr>
                    <td class="selector">➤</td>
                    <td>Desktop</td>
                    <td>Betting</td>
                    <td>1.0.0.0</td>
                    <td>Windows</td>
                    <td>2023</td>
                    <td>Peter Randall</td>
                    <td>C#</td>
                    <td>WPF</td>
                    <td>SQLite</td>
                    <td>Yes</td>
                    <td>Yes</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td class="selector">➤</td>
                    <td class="responsiveRow">Type:</td>
                    <td>Mobile</td>
                    <td class="responsiveRow">Name:</td>
                    <td>MyPlanogram</td>
                    <td class="responsiveRow">Version:</td>
                    <td>1.0.0.0</td>
                    <td class="responsiveRow">OS:</td>
                    <td>Android / IOS</td>
                    <td class="responsiveRow">Year:</td>
                    <td>2023</td>
                    <td class="responsiveRow">Client:</td>
                    <td>Carole Crockett</td>
                    <td class="responsiveRow">Lang:</td>
                    <td>C#</td>
                    <td class="responsiveRow">Tech:</td>
                    <td>MAUI</td>
                    <td class="responsiveRow">DB:</td>
                    <td>MySQL</td>
                    <td class="responsiveRow"><img src="/img/office.jpg"></td>
                    <td>Yes</td>
                    <td class="responsiveRow"><img src="/img/pdf.png"></td>
                    <td>Yes</td>
                    <td class="responsiveRow">Multi User:</td>
                    <td>Yes</td>
                    <td class="command"><button type="button" class="editButton" value="3"><img src="/img/save_blue.png"></button></td>
                    <td class="command"><button type="button" class="deleteButton" value="3"><img src="/img/delete.png"></button></td>
                </tr>
                <tr>
                    <td class="selector">➤</td>
                    <td>Web</td>
                    <td>Dark Star Ink</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>2023</td>
                    <td>Martin Olah</td>
                    <td>JS</td>
                    <td>HTML CSS</td>
                    <td>N/A</td>
                    <td>No</td>
                    <td>No</td>
                    <td>No</td>
                </tr>
            </table>
        </section>
        </main>
        </div>
        <?php LoadJS();?>
    </body>
</html>