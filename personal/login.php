<?php include 'load.php';?>

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
                <form method="post" action="gate.php">
                    <label>User Name</label>
                        <input name="user" type="text" required/>
                    <label>Password</label>
                        <input name="pwd" type="password" required/>
                    <div id="rememberMeContainer">
                        <label for="rememberMe">Remember Me </label>
                        <input name="rmbrM" type="checkbox" id="rememberMe"/>
                    </div>
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
<?php LoadJS();?>
</body>
</html>
