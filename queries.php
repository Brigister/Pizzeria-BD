<?php

include_once ("DBConn.php");
include_once ("class/PizzaClass.php");
include_once ("class/OrdineClass.php");
include_once ("class/IngredienteClass.php");
include_once ("class/UtenteClass.php");

$db = new Database();

function getAllPizze() {
    global $db;
    $db->query("SELECT * FROM pizze");
    $rows = $db->resultset();

    $pizzas = [];
    foreach ($rows as $row) {
        array_push($pizzas, Pizza::withRow($row));
    }

    return $pizzas;
}

function getPizzeLike($s) {
    global $db;
    $db->query("SELECT * FROM pizze WHERE LOWER(nome) LIKE LOWER('%{$s}%')");
    $rows = $db->resultset();

    $pizzas = [];
    foreach ($rows as $row) {
        array_push($pizzas, Pizza::withRow($row));
    }

    return $pizzas;
}

function getOrdiniFromUserId($id) {
    global $db;
    $db->query("SELECT * FROM ordini WHERE fkutente = {$id}");
    $rows = $db->resultset();

    $ordini = [];
    foreach ($rows as $row) {
        array_push($ordini, Ordine::withRow($row));
    }

    return $ordini;
}

function getAllClienti() {
    global $db;
    $db->query("SELECT * FROM utenti"); // WHERE isAdmin = 0
    $rows = $db->resultset();

    $clienti = array();
    foreach ($rows as $row) {
        array_push($clienti, Utente::withRow($row));
    }

    return $clienti;
}

function getAllIngredienti() {
    global $db;
    $db->query("SELECT * FROM ingredienti"); // WHERE isAdmin = 0
    $rows = $db->resultset();

    $clienti = array();
    foreach ($rows as $row) {
        array_push($clienti, Ingrediente::withRow($row));
    }

    return $clienti;
}

function getAllOrdini() {
    global $db;
    $db->query("SELECT * FROM ordini");
    $rows = $db->resultset();

    $ordini = array();
    foreach ($rows as $row) {
        array_push($ordini, new Ordine($row));
    }

    return $ordini;
}

function getPizzaRowFromId($id) {
    global $db;
    $db->query("SELECT * FROM pizze where idpizza = {$id}");
    return $db->single();
}

function getPizzeRowFromOrdineId($id) {
    global $db;
    $db->query("SELECT * , quantita FROM pizze INNER JOIN ordine_pizza ON pizze.idpizza = ordine_pizza.fkpizza WHERE ordine_pizza.fkordine = {$id}");
    return $db->resultset();
}

function getIngredientiRowFromPizzaId($id) {
    global $db;
    $db->query("SELECT * FROM ingredienti INNER JOIN pizza_ingrediente ON ingredienti.idingrediente = pizza_ingrediente.fkIngrediente WHERE pizza_ingrediente.fkpizza = {$id}");
    return $db->resultset();
}

function getIngredienteRowFromId($id) {
    global $db;
    $db->query("SELECT * FROM ingredienti WHERE ingredienti.idingrediente = {$id}");
    return $db->resultset();
}

function getUserByEmail($email) {
    global $db;
    $db->query("SELECT * FROM utenti WHERE utenti.email = '{$email}'");
	$res = $db->single();
	if(!$res)
		return array();
    return $res;
}

function newOrder($idUtente, $indirizzo, $giorno, $ora, $pizze) {
    global $db;
    $db->beginTransaction();
    $now = $date = date('Y-m-d H:i');
    $db->query("INSERT INTO ordini (fkutente, data,indirizzo, giorno, ora) VALUES ({$idUtente},'{$now}','{$indirizzo}','{$giorno}','{$ora}')");
    $db->execute();
    $id = $db->lastInsertId();
    foreach ($pizze as $pizza) {
        $db->query("INSERT INTO ordine_pizza (fkordine, fkPizza, quantita) VALUES ({$id},{$pizza["pizza"]->getIdPizza()},{$pizza["qnt"]})");
        $db->execute();
    }
    return $db->endTransaction();
}

function createIngrediente($nome) {
    global $db;
    $db->beginTransaction();
    $db->query("INSERT INTO ingredienti (nome, quantita) VALUES ('{$nome}', 0)");
    $db->execute();
    return $db->endTransaction();
}
function createPizza($nome) {
    global $db;
    $db->beginTransaction();
    $db->query("INSERT INTO pizze (nome, prezzo) VALUES ('{$nome}', 0)");
    $db->execute();
    $db->endTransaction();
    return $db->lastInsertId();
}

function deleteOrder($idOrdine) {
    global $db;
    $db->beginTransaction();
    $db->query("DELETE FROM ordini WHERE idordine = {$idOrdine}");
    $db->execute();
    $db->query("DELETE FROM ordine_pizza WHERE fkordine = {$idOrdine}");
    $db->execute();
    return $db->endTransaction();
}

function deleteUtente($idUtente) {
    global $db;
    $db->beginTransaction();
    $db->query("DELETE FROM utenti WHERE idutente = {$idUtente}");
    $db->execute();
    return $db->endTransaction();
}

function sendOrder($idOrdine) {
    global $db;
    $db->beginTransaction();
    $db->query("UPDATE ordini SET stato = 'consegnato' WHERE idordine = {$idOrdine}");
    $db->execute();
    $db->query("SELECT pizza_ingrediente.fkingrediente, SUM(pizza_ingrediente.quantita)*SUM(ordine_pizza.quantita) as totale FROM ordine_pizza INNER JOIN pizza_ingrediente ON ordine_pizza.fkpizza = pizza_ingrediente.fkpizza WHERE ordine_pizza.fkordine = {$idOrdine} GROUP BY  pizza_ingrediente.fkingrediente;");
    $result = $db->resultset();
    foreach ($result as $row) {
        $db->query("UPDATE ingredienti SET quantita = quantita - {$row['totale']} WHERE idingrediente = {$row['fkingrediente']}");
        $db->execute();
    }
    return $db->endTransaction();
}

function refill($idIngrediente, $qnt) {
    global $db;
    $db->beginTransaction();
    $db->query("UPDATE ingredienti SET quantita = quantita + {$qnt} WHERE idingrediente = {$idIngrediente}");
    $db->execute();
    return $db->endTransaction();
}

function deleteIngrediente($idIngrediente) {
    global $db;
    $db->beginTransaction();
    $db->query("DELETE FROM ingredienti WHERE idingrediente = {$idIngrediente}");
    $db->execute();
    $db->query("DELETE FROM pizza_ingrediente WHERE fkingrediente = {$idIngrediente}");
    $db->execute();
    return $db->endTransaction();
}

function addIngredientePizza($idPizza, $idIngrediente, $qnt) {
    global $db;
    $db->beginTransaction();
    $db->query("INSERT INTO pizza_ingrediente (fkpizza, fkingrediente ,quantita) VALUES ($idPizza, $idIngrediente, $qnt)");
    $db->execute();
    return $db->endTransaction();
}

function deleteIngredientePizza($idPizza, $idIngrediente) {
    global $db;
    $db->beginTransaction();
    $db->query("DELETE FROM pizza_ingrediente WHERE fkpizza = $idPizza  AND fkingrediente = $idIngrediente");
    $db->execute();
    return $db->endTransaction();
}

function editPrezzo($idPizza, $prezzo) {
    global $db;
    $db->beginTransaction();
    $db->query("UPDATE pizze SET prezzo = {$prezzo} WHERE idpizza = {$idPizza}");
    $db->execute();
    return $db->endTransaction();
}

function deletePizza($idPizza) {
    global $db;
    $db->beginTransaction();
    $db->query("DELETE FROM pizze WHERE idpizza = $idPizza");
    $db->execute();
    $db->query("DELETE FROM pizza_ingrediente WHERE fkpizza = $idPizza");
    $db->execute();
    return $db->endTransaction();
}

function createUtente($email, $password, $indirizzo, $nome, $cognome, $telefono) {
    global $db;
    $db->beginTransaction();
    $db->query("INSERT INTO utenti (email, password, indirizzo, nome, cognome, telefono) VALUES ('{$email}', '{$password}', '{$indirizzo}', '{$nome}', '{$cognome}','{$telefono}')");
    $db->execute();
    return $db->endTransaction();
}
function editPassword($idUtente, $password) {
    global $db;
    $db->beginTransaction();
     $db->query("UPDATE utenti SET password = '{$password}' WHERE idutente = {$idUtente}");
    $db->execute();
    return $db->endTransaction();
}