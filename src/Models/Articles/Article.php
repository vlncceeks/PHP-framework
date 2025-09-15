<?php
namespace src\Models\Articles;
// пространство имен относительно index.php
use \src\Models\Users\User;
use \src\Models\Comments\Comment;
use src\Models\ActiveRecordEntity;

class Article extends ActiveRecordEntity
{
        protected $authorId;
        protected $title;
        protected $text;
        protected $createdAt;

        protected static function getTableName() {
            return 'articles';
        }

        public function setTitle(string $title){
            $this->title = $title;
        }
        public function setText(string $text){
            $this->text = $text;
        }
        public function setAuthorId(User $author){
            $this->authorId = $author->getId();
        }
        public function getTitle()
        {
            return $this->title;
        }
        public function getText()
        {
            return $this->text;
        }
        public function getAuthorId() :User
        {
            return User::getById($this->authorId);
        }
        public function getCreatedAt() 
        {
            return $this->createdAt;
        }

        public function getComments():array {
            return $this->getCommentsByArticleId();
        }
    }
