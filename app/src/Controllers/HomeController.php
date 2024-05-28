<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function index()
    {
        $statement = $this->conn->query('SELECT DATABASE()');
        $result = $statement->fetchColumn();

        return 'Bienvenue sur le blog de voyage ! Base de données connectée : ' . $result;
    }
}
?>