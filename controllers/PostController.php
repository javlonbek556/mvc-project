<?php

session_start();
require_once __DIR__ . '/../models/Post.php';

class PostController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }
        
        $postModel = new Post();
        $posts = $postModel->getAllPosts();
        include __DIR__ . '/../views/posts/index.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
                exit();
            }
            
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
            $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
            $user_id = intval($_SESSION['user_id']);

            $postModel = new Post();
            if ($postModel->createPost($title, $content, $user_id)) {
                header("Location: /posts");
                exit();
            } else {
                echo "Post yaratishda xatolik!";
            }
        }
    }
}

?>
