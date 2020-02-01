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
        if (isset($_POST["action"]) && $_POST["action"] = "singup") {
            if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["repassword"])&& $_POST["email"] != "" && $_POST["password"] != "" && $_POST["password"] == $_POST["repassword"]) {
                if (createUtente($_POST["email"],$_POST["password"],$_POST["indirizzo"],$_POST["nome"],$_POST["cognome"],$_POST["telefono"])) {
                    header('Location: login.php');
                } else {
                    echo "ERRORE creazione Utente";
                }
            }
        }
        ?>
        <?php include("templates/header.php") ?>
        <?php include("templates/singupForm.php") ?>
        <?php include("templates/footer.php") ?>
    </body>

</html>