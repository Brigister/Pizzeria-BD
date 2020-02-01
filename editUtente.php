<?php include_once("queries.php") ?>
<?php include("session.php") ?>
<?php
print_r($_POST);
if (isset($_POST["action"]) && $_POST["action"] == "dropUtente"){
    if (deleteUtente($_POST["idUtente"])) {
        header('Location: index.php');
    } else {
        echo "ERRORE eliminazione Utente";
    }
}else{
    header('Location: index.php');
}
