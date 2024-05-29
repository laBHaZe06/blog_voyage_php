<?php

namespace App\Controllers;

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
            $username = $data['username']?? '';
            $password = $data['password']?? '';
            $email = $data['email']?? '';
            
            if (!empty($username) && !empty($password) && !empty($email)) {
                $created_at = new \DateTime();
                if ($this->userModel->create($username, $password, $email, $created_at->format('d-m-Y'))) {
                    echo json_encode(['message' => 'User registered successfully']);
                    $this->sendMail();
                } else {
                    echo json_encode(['message' => 'Failed to register user']);
                }
            } else {
                echo json_encode(['message' => 'All fields are required']);
            }   

        } catch (Exception $e) {
            echo json_encode(['message' => 'An error occurred :'. $e->getMessage()]);
        }

    }

    //envoi de mail de confirmation d'inscription 
    public function sendMail()
    {
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            $to = "borne.yoan@gmail.com";
            $subject = "Confirmation d'inscription";
            $message = "Votre compte a bien été créé";
            $from = $data['email'] ?? '';
            $headers = "From:". $from;
            
            if(!empty($to) && !empty($subject) && !empty($message) && !empty($from)){
                mail($to,$subject,$message,$headers);
                echo json_encode(['message' => 'Email sent successfully']);
            } else {
                echo json_encode(['message' => 'Problem sending email']);
            }
            
        } catch (Exception $e) {
            echo json_encode(['message' => 'An error occurred :'. $e->getMessage()]);
        }
    }

}
?>