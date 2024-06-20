<?php
namespace App\Controllers;
require_once __DIR__ ."/function/function.php";

use App\Controllers\Controller;
use App\Models\Users;
use App\Database\Connection;
use Exception;

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

        try{
            $data = json_decode(file_get_contents('php://input'), true);
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';

            if(!empty($email) && !empty($password) && $email != '' && $password != '' )
                
                $this->userModel->verifyPassword($email, $password);
            else 
                echo json_encode(['message' => 'Tous les champs sont requis']);
            

        } catch(Exception $e){
            echo json_encode(['message' => 'Une erreur est survenue :'. $e->getMessage()]);
        }
    }
}
?>