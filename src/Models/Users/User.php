<?php
namespace src\Models\Users;
// пространство имен относительно index.php
use src\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity 
{
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;

    protected static function getTableName() {
        return 'users';
    }

    public function setName(string $nickname){
        $this->nickname = $nickname;
    }
    public function getNickName(): string
    {
        return $this->nickname;
    }
}