<?php

namespace App\Controllers;

use App\Database\Connection;

class Controller {

    protected $conn;

    public function __construct() {
        // Récupérer l'instance de connexion à la base de données
        $this->conn = Connection::getInstance();
        // Vérifier la connexion
        if ($this->conn === null) {
            die("Erreur de connexion à la base de données. Veuillez vérifier vos configurations.");
        } 
    }


}
?>