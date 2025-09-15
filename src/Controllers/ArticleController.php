<?php

namespace src\Controllers;
use src\View\View;
use src\Models\Articles\Article;

class ArticleController{
    private $view;
    private $db;
    
    public function __construct() {
        $this->view = new View;
    }

    public function index(){
        $articles = Article::findAll();
        //var_dump($articles);
        $this->view->renderHtml('article/index', ['articles'=>$articles]);
    }
    public function show($id){
        $article = Article::getById($id);  
        if ($article == []) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('article/show', ['article'=>$article]);
    }
    public function edit($id) {
        $article = Article::getById($id);
        $this->view->renderHtml('article/edit', ['article'=>$article]);
    }
     public function update($id){
        $article = Article::getById($id);
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->save();
        return header('Location:http://localhost/PHP/Project/www/article/'.$article->getId());
    }
    public function create(){
        $this->view->renderHtml('article/create');
    }
    public function store(){
        $article = new Article;
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->authorId = 1;
        $article->save();
        return header('Location:http://localhost/PHP/Project/www/');
    }
    public function delete($id) {
        $article = Article::getById($id);
        $comments = $article->getCommentsByArticleId();
        foreach ($comments as $comment) {
            $comment->remove();
        }
        $article->remove();
        return header('Location:http://localhost/PHP/Project/www/');
    }

}