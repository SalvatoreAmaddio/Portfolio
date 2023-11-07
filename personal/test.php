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
            $search = "acc";

            $controller->filterBy(
                function($record) use($search) : bool
                {
                    $db = DB::cast($record);
                    $name = Sys::toLower($db->Name); 
                    $search = Sys::toLower($search); 
                    return str_contains($name,$search);
                });

            echo $controller->getByIndex(0);
        ?>
    </body>
</html>