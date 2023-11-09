<?php 
    session_start();
    include 'load.php';
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
                <div id="group1">
                    <table>
                        <tr>
                            <th colspan="2">Application's info</th>
                        </tr>
                        <tr>
                            <td><label for="projectName">Project Name</label></td>
                            <td><input type="text" id="projectName" name="pName" Value="Betting" required/></td>
                        </tr>
                        <tr>
                            <td><label for="projectVersion">Version</label></td>
                            <td><input type="text" id="projectVersion" name="pVersion" Value="1.0.0.0" required/></td>
                        </tr>
                        <tr>
                        <tr>
                            <td><label for="projectType">Project Type</label></td>
                            <td>
                                <select id="projectType" name="pType" required>
                                    <option value="0"></option>
                                    <option value="1">Desktop</option>
                                    <option value="2">Mobile</option>
                                    <option value="3">Web</option>
                                </select>
                            </td>
                        </tr>    
                        <tr>                
                            <td><label for="projectOS">OS</label></td>
                            <td><select id="projectOS" name="pOS" required>
                                    <option value="0"></option>
                                    <option value="1">Windows</option>
                                    <option value="2">Android/IOS</option>
                                </select>
                            <td>
                        </tr>
                        <tr>
                            <td><label for="projectYear">Year</label></td>
                            <td><input type="number" id="projectYear" name="pYear" Value="2023" required/></td>
                        </tr>
                        <tr>
                            <td><label for="projectClient">Client</label></td>
                            <td>
                                <select id="projectClient" name="pClient" required>
                                    <option value="0"></option>
                                    <option value="1">c1</option>
                                    <option value="2">c2</option>
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
                                    <option value="0"></option>
                                    <option value="1">C#</option>
                                    <option value="2">PHP</option>
                                    <option value="3">Java</option>
                                </select>
                            </td>
                        </tr>    
                        <tr>                
                            <td><label for="technology">Technology</label></td>
                            <td><select id="technology" name="pTechnology" required>
                                    <option value="0"></option>
                                    <option value="1">WPF</option>
                                    <option value="2">MAUI</option>
                                </select>
                            <td>
                        </tr>
                        <tr>
                            <td><label for="projectDatabase">Database</label></td>
                            <td>
                                <select id="projectDatabase" name="pDatabase" required>
                                    <option value="0"></option>
                                    <option value="1">SQLite</option>
                                    <option value="2">MySQL</option>
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

                <div id="descriptionContainer">
                    <p>Description</p>
                    <textarea>

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
    </body>
</html>