<?php include 'php/SAR/loadSAR.php';?>
<?php include 'php/models/loadModels.php';?>
<?php include 'php/controllers/loadControllers.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays</title>
</head>
<body>
    <?php     
        $dbController = new DbController();
        $dbController->recordSource->print();
        echo "<br>";
    ;?>

</body>
</html>
