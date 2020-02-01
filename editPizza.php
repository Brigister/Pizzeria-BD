<?php include_once("queries.php") ?>
<?php include("session.php") ?>
<?php

print_r($_POST);
if (isset($_POST["action"]) && $_POST["action"] == "addIngredientePizza") {
    if (addIngredientePizza($_POST["idPizza"], $_POST["idIngrediente"], $_POST["qnt"])) {
        header("Location: pizza.php?idPizza={$_POST['idPizza']}");
    } else {
        echo "ERRORE nuovo ordine";
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "dropIngredientePizza") {
    if (deleteIngredientePizza($_POST["idPizza"], $_POST["idIngrediente"])) {
        header("Location: pizza.php?idPizza={$_POST['idPizza']}");
    } else {
        echo "ERRORE eliminazione Ingrediente";
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "createPizza") {
    createPizza($_POST["nome"]);
    header("Location:index.php");
}elseif (isset($_POST["action"]) && $_POST["action"] == "dropPizza") {
    if (deletePizza($_POST["idPizza"])) {
        header("Location: index.php");
    } else {
        echo "ERRORE eliminazione Pizza";
    }
}elseif (isset($_POST["action"]) && $_POST["action"] == "editPrezzo") {
    if (editPrezzo($_POST["idPizza"],$_POST['prezzo'])) {
        header("Location: pizza.php?idPizza={$_POST['idPizza']}");
    } else {
        echo "ERRORE eliminazione Pizza";
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "editPizza") {
    header("Location: pizza.php?idPizza={$_POST['idPizza']}");
}else {
    header('Location: index.php');
}

