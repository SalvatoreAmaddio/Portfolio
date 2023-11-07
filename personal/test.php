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
            $search = "ite";

            $controller->filterBy(
                function($record) use($search) : bool
                {
                    $db = DB::cast($record);
                    return Sys::contains($search,$db->Name,true);
                });

            echo $controller->getByIndex(0);
        ?>
    </body>
</html>