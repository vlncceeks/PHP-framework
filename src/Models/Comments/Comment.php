<?php
namespace src\Models\Comments;
// пространство имен относительно index.php
use \src\Models\Users\User;
use \src\Models\ActiveRecordEntity; 

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    protected static function getTableName() {
        return 'comments';
    }

    public function getAuthorNickName() {
        return User::getById($this->getAuthorId())->getNickName();
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getArticleId()
    {
        return $this->articleId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setArticleId(Article $article){
        $this->articleId = $article->getId();
    }

    public function setText(string $text){
        $this->text = $text;
    }

    public function setAuthorId(Article $article){
        $this->authorId = $author->getAuthorId()->getId();
    }

}