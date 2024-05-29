<?php
namespace App\Controllers;
use App\Controllers\Controller;

use App\Models\Users;
use App\Database\Connection;

class LoginController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $db = Connection::getInstance();
        $this->userModel = new Users($db);
    }

    public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $user = $this->userModel->verifyPassword($this->conn,$email, $password);
        if ($user) {
            // Génération d'un token simple pour l'exemple (en production, utilisez JWT ou une autre méthode sécurisée)
            $token = bin2hex(random_bytes(16));
            echo json_encode(['message' => 'Login successful', 'token' => $token]);
        } else {
            echo json_encode(['message' => 'Invalid credentials']);
        }
    }
}
?>