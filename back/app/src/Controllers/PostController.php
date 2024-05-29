<?php

namespace App\Controllers;

use App\Controllers\Controller;

class PostController extends Controller 
{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $result = $this->conn->query("SELECT * FROM posts");
        $posts = $result->fetchAll();
        $data = array();
        foreach ($posts as $p) {
            $data[] = [
                'title' => $p['title'],
                'content' => $p['content'],
                'created_at' => $p['created_at'],
                'updated_at' => $p['updated_at'],
            ];
        }

        if (empty($data)) {
            http_response_code(404);
            return json_encode(['message' => 'Aucun article trouvé']);
        }

        $json = json_encode($data);
        header('Content-Type: application/json');
        return $json;
    }

    public function show($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->bindParam('i', $id);
        $stmt->execute();
        $post = $stmt->fetch();
        $stmt->closeCursor();


        if (!$post) {
            http_response_code(404);
            return json_encode(['message' => 'Article non trouvé']);
        }

        header('Content-Type: application/json');
        return json_encode($post);
    }

    public function create() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $this->conn->query("INSERT INTO posts (title, content) VALUES ('$title', '$content')");
        header('Location: /posts');
        exit();
    }

}

?>