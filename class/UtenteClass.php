<?php

class Utente{
    private $idUtente;
    private $nome;
    private $cognome;
    private $indirizzo;
    private $email;
    private $telefono;
    private $password;
    private $isAdmin;
    
    
    public function __construct() {
        // allocate your stuff
    }

    public static function withID( $id ) {
        $instance = new self();
        $instance->loadByID( $id );
        return $instance;
    }

    public static function withRow( array $row ) {
        if(empty($row))return;
		$instance = new self();
        $instance->fill( $row );
        return $instance;
    }

    protected function loadByID( $id ) {
        // do query
        $row = getUtenteRowFromId( $id );
        $this->fill( $row );
    }

    protected function fill( array $row ) {
        $this -> idUtente = $row["idutente"];
        $this -> nome = $row["nome"];
        $this -> cognome = $row["cognome"];
        $this -> indirizzo = $row["indirizzo"];
        $this -> email = $row["email"];
        $this -> telefono = $row["telefono"];
        $this -> password = $row["password"];
        $this -> isAdmin = ($row["isadmin"]==1)?true:false;
    }
    function getIdUtente() {
        return $this->idUtente;
    }

    function getNome() {
        return $this->nome;
    }

    function getCognome() {
        return $this->cognome;
    }

    function getIndirizzo() {
        return $this->indirizzo;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getPassword() {
        return $this->password;
    }

    function isAdmin() {
        return $this->isAdmin;
    }


}