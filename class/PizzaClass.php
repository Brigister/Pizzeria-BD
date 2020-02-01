<?php

class Pizza{
    private $idPizza;
    private $nome;
    private $prezzo;
    private $ingredienti = null;
    
    
    public function __construct() {
        // allocate your stuff
    }

    public static function withID( $id ) {
        $instance = new self();
        $instance->loadByID( $id );
        return $instance;
    }

    public static function withRow( array $row ) {
        $instance = new self();
        $instance->fill( $row );
        return $instance;
    }

    protected function loadByID( $id ) {
        // do query
        $row = getPizzaRowFromId( $id );
        $this->fill( $row );
    }

    protected function fill( array $row ) {
        $this -> idPizza = $row["idpizza"];
        $this -> nome = $row["nome"];
        $this -> prezzo = $row["prezzo"];
    }
    
    public function getIngredienti(){
        $rows = getIngredientiRowFromPizzaId($this -> idPizza); 
        $this -> ingredienti = [];
        
        foreach($rows as $row){
            array_push( $this -> ingredienti, Ingrediente::withRow($row));
        }
        return $this -> ingredienti;
    }
    
    function getIdPizza() {
        return $this->idPizza;
    }

    function getNome() {
        return $this->nome;
    }

    function getPrezzo() {
        return $this->prezzo;
    }
    
    
}
