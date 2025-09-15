<?php

namespace src\Controllers;
use src\View\View;
use src\Models\Comments\Comment;
use src\Models\Articles\Article;

class CommentController {
    private $view;
    private $db;
    
    public function __construct() {
        $this->view = new View;
    }
    public function create(){
        $this->articleId=(int)$_GET['id'];
        $this->view->renderHtml('comment/create');
    }
    public function store(){
        $comment = new Comment;
        $comment->articleId = $_POST['id'];
        $comment->text = $_POST['text'];
        $comment->authorId = 1;
        $comment->save();
        return header('Location:http://localhost/PHP/Project/www/article/'.$comment->getArticleId());
    }
    public function edit($id) {
        $comment = Comment::getById($id);
        $this->view->renderHtml('comment/edit', ['comment'=>$comment]);
    }
    public function delete($id) {
        $comment = Comment::getById($id);
        $comment->remove();
        return header('Location:http://localhost/PHP/Project/www/article/'.$comment->getArticleId());
    }
    public function update($id) {
        $comment = Comment::getById($id);
        $comment->text = $_POST['text'];
        $comment->save();
        return header('Location:http://localhost/PHP/Project/www/article/'.$comment->getArticleId());
    }
}