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
        if (isset($_POST["action"]) && $_POST["action"] = "editPassword") {
            if (isset($user) && isset($_POST["password"]) && isset($_POST["repassword"]) && $_POST["password"] != "" && $_POST["password"] == $_POST["repassword"]) {
                if (editPassword($user->getIdUtente() ,$_POST["password"])) {
                    //header('Location: index.php');
                } else {
                    echo "ERRORE modifica Password";
                }
            }
        }
        ?>
        <?php include("templates/header.php") ?>
        <?php include("templates/settingsForm.php") ?>
        <?php include("templates/footer.php") ?>
    </body>

</html>