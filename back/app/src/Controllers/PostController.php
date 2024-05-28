<?php

namespace App\Controllers;

class PostController extends Controller {

    public function index() {
        $postsData = $this->conn->query("SELECT * FROM posts")->fetchAll();
        $posts = [];
        foreach ($postsData as $p) {
            $posts[] = [
                'id' => $p['id'],
                'title' => $p['title'],
                'content' => $p['content'],
                'created_at' => $p['created_at']
            ];
        }
        return $posts;
    }

    public function show($id) {
        $post = $this->conn->query("SELECT * FROM posts WHERE id = $id")->fetch();
        return $post;
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