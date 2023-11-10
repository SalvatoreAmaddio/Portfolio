<?php 
    session_start();
    include 'load.php';
    $controller = new ProjectController();
    $controller->readPost();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/projectForm.css"/>
        <title>Project</title>
    </head>

    <body>
    <header>
        <div id="headerTitle">
            <h3>Form</h3>
        </div>
    </header>
    <main>
        <section id="dataContainer" class="container">
            <div id="data">
                <div id=groups>
                    <div id="group1">
                        <table>
                            <tr>
                                <th colspan="2">Application's info</th>
                            </tr>
                            <tr>
                                <td><label for="projectName">Project Name</label></td>
                                <td><input type="text" id="projectName" name="pName" required/></td>
                            </tr>
                            <tr>
                                <td><label for="projectVersion">Version</label></td>
                                <td><input type="text" id="projectVersion" name="pVersion" required/></td>
                            </tr>
                            <tr>
                                <td><label for="projectType">Project Type</label></td>
                                <td>
                                    <select id="projectType" name="pType" required>
                                        <?php $controller->getProjectTypes();?>
                                    </select>
                                </td>
                            </tr>    
                            <tr>
                                <td><label for="projectOS">OS</label></td>
                                <td><select id="projectOS" name="pOS" required>
                                        <?php $controller->getOS();?>
                                    </select>
                                <td>
                            </tr>
                            <tr>
                                <td><label for="projectYear">Year</label></td>
                                <td><input type="number" id="projectYear" name="pYear" required/></td>
                            </tr>
                            <tr>
                                <td><label for="projectClient">Client</label></td>
                                <td>
                                    <select id="projectClient" name="pClient" required>
                                        <?php $controller->getClients();?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="sourceCode">Source Code</label></td>
                                <td><input type="text" id="sourceCode" name="pSourceCode" required/></td>
                            </tr>
                        </table>
                    </div>

                    <div id="group2">
                        <table>
                            <tr>
                                <th colspan="2">Application's Features</th>
                            </tr>
                            <tr>
                                <td><label for="proLang">Written In</label></td>
                                <td>
                                    <select id="proLang" name="pProLang" required>
                                        <?php $controller->getProLangs();?>
                                    </select>
                                </td>
                            </tr>    
                            <tr>                
                                <td><label for="technology">Technology</label></td>
                                <td><select id="technology" name="pTechnology" required>
                                        <?php $controller->getTechs();?>
                                    </select>
                                <td>
                            </tr>
                            <tr>
                                <td><label for="projectDatabase">Database</label></td>
                                <td>
                                    <select id="projectDatabase" name="pDatabase" required>
                                       <?php $controller->getDBS();?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="officePack">Office Pack</label></td>
                                <td><input type="checkbox" id="officePack" name="pOfficePack"/></td>
                            </tr>
                            <tr>
                                <td><label for="pdfReport">PDF Reports</label></td>
                                <td><input type="checkbox" id="pdfReport" name="pPdfReport"/></td>
                            </tr>
                            <tr>
                                <td><label for="multiUser">Multi-users</label></td>
                                <td><input type="checkbox" id="multiUser" name="pMultiUser"/></td>
                            </tr>
                            <tr>
                                <td><label for="exe">Exe</label></td>
                            </tr>
                        </table>
                    </div>

                    <div id=group3>
                        Drop
                    </div>
                </div>

                <div id="descriptionContainer">
                    <p>Description</p>

                    <textarea rows="7">

                    </textarea>
                </div>

                <div id="picturesContainer">
                    <p>Drop</p>
                </div>

                <div id="saveButton">
                    <button>SAVE</button>
                </div>
            </div>
        </section>        
    </main>
    <footer>
        <?php echo "Copyright © " . date("Y") . " Salvatore Amaddio Rivolta All rights reserved.";?>
    </footer>
    <?php LoadJS();?>
    <script>
       let id = localStorage.getItem("projectID");
       if (id) 
       {
            let sender = new Sender("",
            (e)=>
            {
                alert(e);
            });
            sender.send("projectID="+id);
            localStorage.removeItem("projetID");
       } 
    </script>
    </body>
</html>