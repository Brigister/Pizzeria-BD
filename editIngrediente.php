<?php include_once("queries.php") ?>
<?php include("session.php") ?>
<?php
print_r($_POST);
if (isset($_POST["action"]) && $_POST["action"] == "refill") {
    if (refill($_POST["idIngrediente"], $_POST["qnt"])) {
        header('Location: magazzino.php');
    } else {
        echo "ERRORE nuovo ordine";
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "dropIngrediente"){
    if (deleteIngrediente($_POST["idIngrediente"])) {
        header('Location: magazzino.php');
    } else {
        echo "ERRORE eliminazione Ingrediente";
    }
}elseif (isset($_POST["action"]) && $_POST["action"] == "createIngrediente"){
    if (createIngrediente($_POST["nome"])) {
        header('Location: magazzino.php');
    } else {
        echo "ERRORE creazione Ingrediente";
    }
}else{
    header('Location: index.php');
}
