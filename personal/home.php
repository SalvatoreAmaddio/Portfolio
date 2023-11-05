<?php include 'load.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>
</head>

<body>
    <div id="wrapper">
        <header>
                <div id="headerTitle">
                    <h1>Home</h1>
                </div>
        </header>
        <main>
            <section id="main">
                <div id=title>
                    <h2>Choose an area</h2>
                </div>
                <div id="mainGroup">
                    <div class="group" id="project">
                        <p>Projects</p>
                        <p>Manage</p>
                    </div>
                    <div class="group" id="client">
                        <p>Clients</p>
                        <p>Manage</p>
                    </div>
                    <div class="group" id="db">
                        <p>Databases</p>
                        <p>Manage</p>
                    </div>
                    <div class="group" id="os">
                        <p>OS</p>
                        <p>Manage</p>
                    </div>
                    <div class="group" id="projectType">
                        <p>Project Types</p>
                        <p>Manage</p>
                    </div>
                    <div class="group" id="cpanel">
                        <p>CPanel</p>
                        <p>Manage</p>
                    </div>
                </div>
            </section>
        </main>
        <footer>
        <?php echo "Copyright © " . date("Y") . " Salvatore Amaddio Rivolta All rights reserved.";?>
        </footer>
    </div>

<?php LoadJS();?>
</body>
</html>