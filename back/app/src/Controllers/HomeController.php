<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function index()
    {
        $statement = $this->conn->query('SELECT DATABASE()');
        $result = $statement->fetchColumn();

        if ($result === false) {
            return 'Erreur de connexion à la base de données. Veuillez vérifier vos configurations.';
        } else if ($result === null) {  
            return "Connexion réussie mais vous n\'avez pas encore ajoutés de données.";
        } else {
            return 'Bienvenue sur le blog de voyage! Base de données connectée : '. $result;
        }
    }
}
?>