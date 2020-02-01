<?php include_once("queries.php") ?>
<?php include("session.php") ?>
<?php
print_r($_POST);
if (isset($_POST["action"]) && $_POST["action"] == "createOrder") {
    if (newOrder($user -> getIdUtente(), $_POST["indirizzo"], $_POST["giorno"], $_POST["ora"], $_SESSION["ordine"])) {
        unset($_SESSION["ordine"]);
        header('Location: ordini.php');
    } else {
        echo "ERRORE nuovo ordine";
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "sendOrder"){
    if (sendOrder($_POST["idOrdine"])) {
        header('Location: utenti.php');
    } else {
        echo "ERRORE invio ordine";
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "dropOrder"){
    if (deleteOrder($_POST["idOrdine"])) {
        if ($isAdmin) {
            header('Location: utenti.php');
        }
        else { 
            header('Location: ordini.php');
        }
    } else {
        echo "ERRORE eliminazione ordine";
    }
}else{
    header('Location: index.php');
}
