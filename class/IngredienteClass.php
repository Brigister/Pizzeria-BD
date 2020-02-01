<?php
class Ingrediente{
    private $idIngrediente;
    private $nome;
    private $quantita;
    
    
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
        $row = getIngredienteRowFromId( $id );
        $this->fill( $row );
    }

    protected function fill( array $row ) {
        $this -> idIngrediente = $row["idingrediente"];
        $this -> nome = $row["nome"];
        $this -> quantita = $row["quantita"];
    }
    
    function getIdIngrediente() {
        return $this->idIngrediente;
    }

    function getNome() {
        return $this->nome;
    }

    function getQuantita() {
        return $this->quantita;
    }


}
