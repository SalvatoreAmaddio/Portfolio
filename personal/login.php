<?php include 'php/SAR/loadSAR.php';?>
<?php include 'php/models/loadModels.php';?>
<?php include 'php/controllers/loadControllers.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>
<div id="wrapper">
    <header>
            <div id="headerTitle">
                <h1>Ciao Salvo</h1>
            </div>
    </header>

    <main>
        <section class="container">
            <div id="loginContainer" class="layer">
            <form method="post" action="welcome.php">
                <label>User Name</label>
                    <input type="text"/>
                <label>Password</label>
                    <input type="password"/>
                <input type="submit" value="GET IN"/> 
            </form>
            </div>
        </section>

        <section class="container">
            <p>You have one attempt only.</p>
            <p>Then I'll kick you out.</p>
        </section>
    </main>


    <footer>
        <?php
            echo "Copyright © " . date("Y") . " Salvatore Amaddio Rivolta All rights reserved.";
        ?>
    </footer>
</div>
<?php
    LoadJS();
?>
</body>
</html>
