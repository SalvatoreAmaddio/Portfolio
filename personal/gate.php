<?php 
        include 'load.php';
        $userName = $_POST["user"];
        $pwd = $_POST["pwd"];
        
        $accessController = new AccessController();

        $result = $accessController->checkCredentials($userName,$pwd);

        if ($result) 
        {
            $_SESSION["logged"] = true;
            header("Location: /personal/home.php");
        } 
        else header("Location: http://www.salvatoreamaddio.co.uk");
        exit();            
    ?>

