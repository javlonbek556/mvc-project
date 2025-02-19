<?php

require_once '../core/Database.php';

class Post {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllPosts() {
        $stmt = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPost($title, $content, $user_id) {
        $stmt = $this->db->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $content, $user_id]);
    }
}
?>
