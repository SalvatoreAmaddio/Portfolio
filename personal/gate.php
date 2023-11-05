<?php include 'load.php';?>

    <?php
        $userName = $_POST["user"];
        $pwd = $_POST["pwd"];
        
        $accessController = new AccessController();

        $result = $accessController->checkCredentials($userName,$pwd);

        if ($result) 
            header("Location: /personal/home.php");
        else 
            header("Location: http://www.salvatoreamaddio.co.uk");
        exit();            
    ?>

