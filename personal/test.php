<?php include 'load.php';?>
<?php 
    $controller = new DbController();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php 

            $record = $controller->filterByID(1);
            echo DB::Cast($record)->Name;
        ?>
    </body>
</html>