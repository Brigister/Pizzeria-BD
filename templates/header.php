<!DOCTYPE html>
<html>
<head>
<title>Pizzeria</title>
<link href="css/main.css" rel="stylesheet" type="text/css"/>
<link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
<link href="css/fa-brands.min.css" rel="stylesheet" type="text/css"/>
<link href="css/fa-regular.min.css" rel="stylesheet" type="text/css"/>
<link href="css/fa-solid.min.css" rel="stylesheet" type="text/css"/>
<link href="css/fontawesome.min.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="header">
    <ul class="menu">
        <a href="index.php"><li>Home</li></a>
        <?php
        if ($isLogged) {
            if ($isAdmin) {
                ?>
                <a href="utenti.php"><li>Lista Utenti</li></a>
                <a href="magazzino.php"><li>Magazzino</li></a>
            <?php }
            ?>
            <a href="carrello.php"><li>Carrello</li></a>
            <a href="ordini.php"><li>Lista Ordini</li></a>
            <a href="settings.php"><li>Impostazioni</li></a>
            <a href="logout.php"><li>Logout</li></a>
            <?php
        } else {
            ?>
            <a href="login.php"><li>Login</li></a>
            <?php
        }
        ?>
    </ul>
    <?php
    if ((isset($isCatalogo) || isset($isCatalogo)) && ($isCatalogo || $isHome)) {
        ?>
        <div class="pizzaSearch">
            <?php
            include("pizzaSearchForm.php");
            ?>
        </div>
        <?php
    }
    ?>
</div>
<div class="container">

