<?php

namespace App\Controllers;

use App\Models\Users;
use App\Database\Connection;
use App\Controllers\Controller;

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
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        $email = $data['email'] ?? '';
        $created_at = new \DateTime();

        if ($this->userModel->create($username, $password, $email,$created_at->format('d-m-Y'))) {
            echo json_encode(['message' => 'User registered successfully']);
        } else {
            echo json_encode(['message' => 'Failed to register user']);
        }
    }

    //envoi de mail de confirmation d'inscription 
    public function sendMail()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $to = "borne.yoan@gmail.com";
        $subject = "Confirmation d'inscription";
        $message = "Votre compte a bien été créé";
        $from = $data['email'] ?? '';
        $headers = "From:". $from;

        mail($to,$subject,$message,$headers);
        if(mail($to,$subject,$message,$headers))
            echo json_encode(['message' => 'Mail sent successfully']);
        else
            echo json_encode(['message' => 'Failed to send mail']);
        
    }

}
?>