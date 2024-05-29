<?php

namespace App\Models;

use PDO;

class Users
{
    private $conn;
    private $id;
    private $username;
    private $password;
    private $email;
    private $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function create($conn, $username, $password, $email)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $passwordHash, $email]);
    }

    public function findByEmail($conn, $email)
    {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyPassword($conn, $email, $password)
    {
        $user = $this->findByEmail($conn, $email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>
