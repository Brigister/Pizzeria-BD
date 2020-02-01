<?php

class PizzaOrdine extends Pizza {

    private $qnt;

    function getQuantita() {
        return $this->qnt;
    }

    function setQuantita($qnt) {
        $this->qnt = $qnt;
    }

    public static function withRow(array $row) {
        $instance = new self();
        $instance->fill($row);
        return $instance;
    }

    protected function fill(array $row) {
        $this->idPizza = $row["idpizza"];
        $this->nome = $row["nome"];
        $this->prezzo = $row["prezzo"];
        $this->qnt = $row["quantita"];
    }
    
     function getNome() {
        return $this->nome;
    }

}

class Ordine {

    private $data;
    private $stato;
    private $indirizzo;
    private $giorno;
    private $ora;
    private $idUtente;
    private $idOrdine;
    private $pizze;

    public function __construct() {
        // allocate your stuff
    }

    public static function withID($id) {
        $instance = new self();
        $instance->loadByID($id);
        return $instance;
    }

    public static function withRow(array $row) {
        $instance = new self();
        $instance->fill($row);
        return $instance;
    }

    protected function loadByID($id) {
        // do query
        $row = getIngredienteRowFromId($id);
        $this->fill($row);
    }

    protected function fill(array $row) {
        $this->idOrdine = $row["idordine"];
        $this->data = $row["data"];
        $this->stato = $row["stato"];
        $this->indirizzo = $row["indirizzo"];
        $this->giorno = $row["giorno"];
        $this->ora = $row["ora"];
        $this->idUtente = $row["fkutente"];
    }

    function getPizze() {
        $rows = getPizzeRowFromOrdineId($this->getIdOrdine());
        $this->pizze = [];

        foreach ($rows as $row) {
            array_push($this->pizze, PizzaOrdine::withRow($row));
        }
        return $this->pizze;
    }

    function getData() {
        return $this->data;
    }

    function getStato() {
        return $this->stato;
    }

    function getIndirizzo() {
        return $this->indirizzo;
    }

    function getGiorno() {
        return $this->giorno;
    }

    function getOra() {
        return $this->ora;
    }

    function getIdUtente() {
        return $this->idUtente;
    }

    function getIdOrdine() {
        return $this->idOrdine;
    }

}
