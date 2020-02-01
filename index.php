<!DOCTYPE html>
<html>
    <head>
        <title>Pizzeria</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <?php
        $isCatalogo = true;
        $isHome = true;
        ?>
        <?php include_once("queries.php") ?>
        <?php include("session.php") ?>
        <?php include("templates/header.php") ?>
        <?php include("templates/catalogo.php") ?>
        <?php include("templates/footer.php") ?>
    </body>

</html>