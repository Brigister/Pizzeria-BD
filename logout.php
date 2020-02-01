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
        <?php
        if (isset($_SESSION["user"])){
            unset($_SESSION["user"]);
            header('Location: index.php');
        }
        ?>
        <?php include("templates/footer.php") ?>
    </body>

</html>