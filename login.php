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
        if (isset($_POST["action"]) && $_POST["action"] = "login") {
            if (isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] != "" && $_POST["password"] != "") {
                $user = Utente::withRow(getUserByEmail($_POST["email"]));
                if (isset($user) &&  $user->getPassword() == $_POST["password"]) {
                    $_SESSION["user"] = $user;
                    header('Location: index.php');
                }else{
					header('Location: login.php');
				}
            }
        }
        ?>
        <?php include("templates/header.php") ?>
        <?php include("templates/loginForm.php") ?>
        <?php include("templates/footer.php") ?>
    </body>

</html>