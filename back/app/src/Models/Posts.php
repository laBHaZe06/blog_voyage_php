<?php

namespace App\Models;


class Posts {

    public $id;
    public $title;
    public $content;
    public $created_at;
    public $updated_at;

    public function __construct($id, $title, $content, $created_at, $updated_at) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }
    
    public function getCreatedAt() {
        return $this->created_at;
    }
    
    public function getUpdatedAt() {
        return $this->updated_at;
    }
    
    public function __toString() {
        return $this->title;
    }

}