<?php

namespace App\Controllers;
require_once __DIR__ ."/function/function.php";

use App\Models\Users;
use App\Database\Connection;
use App\Controllers\Controller;
use Exception;

class RegisterController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $db = Connection::getInstance();
        $this->userModel = new Users($db);
    }

    public function register()
{
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        $email_ = $data['email'] ?? '';
        $created_at = new \DateTime();

        if (!empty($username) && !empty($password) && !empty($email_)) {

           checkData($username);
           checkEmail($email_);

            $email = $this->userModel->findEmail($email_);
            if ($email) {
                echo json_encode(['message' => 'Email déjà utilisé']);
            } else {
               
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->userModel->create($username, $hashedPassword, $email_, $created_at);
                $this->sendMail($email_);
                echo json_encode(['message' => 'Utilisateur créer avec succès']);
            }

        } else {
            echo json_encode(['message' => 'Tous les champs sont requis']);
        }

    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['message' => 'Une erreur est survenue :'. $e->getMessage()]);
    }
}

    public function sendMail($email)
    {
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            $to = "borne.yoan@gmail.com";
            $subject = "Confirmation d'inscription";
            $message = "Votre compte a bien été créé";
            $from = $email;
            $headers = "From:". $from;

            if(!empty($to) && !empty($subject) && !empty($message) && !empty(checkEmail($from))){
                mail($to,$subject,$message,$headers);
                echo json_encode(['message' => 'Email envoyer avec succès']);
            } else {
                echo json_encode(['message' => 'Problème lors de l\'envoie de l\'email']);
            }
            
        } catch (Exception $e) {
            echo json_encode(['message' => 'Une erreur est survenue :'. $e->getMessage()]);
        }
    }
}

?>