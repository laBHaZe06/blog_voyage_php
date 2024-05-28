<?php

namespace App\Controllers;

class PostController extends Controller {

    public function index() {
        $posts = $this->conn->query("SELECT * FROM posts")->fetchAll();
        include('../views/index.php');
        return $posts;
    }

    public function show($id) {
        $post = $this->conn->query("SELECT * FROM posts WHERE id = $id")->fetch();
        include('../views/show.php');
        return $post;   
    }

}

?>