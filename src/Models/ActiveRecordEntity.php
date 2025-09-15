<?php
namespace src\Models;
use src\Services\Db;
use src\Models\Comments\Comment;

abstract class ActiveRecordEntity {
    protected $id;
    
    public function getId() 
    {
        return $this->id;
    }

    public function __set($column, $value) {
        $property = $this->upperToCamelCase($column);
        $this->$property=$value;
    }

    private function upperToCamelCase($column) {
        return lcfirst(str_replace('_', '', ucwords($column, '_')));
    } 

    public static function findAll() :array 
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `'.static::getTableName().'`';  
        return $db->query($sql, [], static::class);
    }

    protected abstract static function getTableName();

    public static function getById(int $id) {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `'.static::getTableName().'` WHERE `id`=:id';
        $entities = $db->query($sql, [':id'=>$id], static::class);
        return $entities ? $entities[0] : null;
    }

    protected function MappedPropertiesToDB() {
        $reflector = new \ReflectionObject($this);
        $properties=[];
        foreach($reflector->getProperties() as $property){
            $propertyName = $property->getName();
            $propertyNameDb = $this->camelcaseToUpper($property->getName());
            $properties[$propertyNameDb] = $this->$propertyName;
        }
        return $properties;
    }

    private function camelcaseToUpper($property){
        return strtolower(preg_replace('/([A-Z])/','_$1', $property));
    }
    public function save() {
        echo("!");
        $propertiesDB = $this->MappedPropertiesToDB();
        if($this->id) $this->update($propertiesDB);
        else $this->insert($propertiesDB);
    }
    protected function update($propertiesDB){
        $db = DB::getInstance();
        $columns2Params = [];
        $params2Values = [];
        foreach($propertiesDB as $key=>$value){
            $param = ':'.$key;
            $column = '`'.$key.'`';
            $columns2Params[] = $column.'='.$param;
            $params2Values[$param] = $value;
        }
        $sql = 'UPDATE `'.static::getTableName().'` SET '.implode(',', $columns2Params).' WHERE `id`=:id';
        $db->query($sql, $params2Values, static::class);
    }

    protected function insert($propertiesDB) {
        $propertiesDB = array_filter($propertiesDB);
        $db = Db::getInstance();
        $columns = [];
        $params = [];
        $params2Values = [];
        foreach($propertiesDB as $key=>$value){
            $columns[] = '`'.$key.'`';
            $param = ':'.$key;
            $params[] = $param;
            $params2Values[$param] = $value;
        }
        $sql = 'INSERT INTO `'.static::getTableName().'` ('.implode(',', $columns).') VALUES ('.implode(',', $params).')';
        $db->query($sql, $params2Values, static::class);
    }
    public function remove() {
        $sql = 'DELETE FROM `'.static::getTableName().'`  WHERE `id`=:id';
        $db = Db::getInstance();
        $db->query($sql, [':id'=>$this->id], static::class);
    }
    public function getCommentsByArticleId() :array {
        $sql = 'SELECT * FROM`'.Comment::getTableName().'` WHERE `article_id`=:id';
        $db = Db::getInstance();
        return $db->query($sql, [':id'=>$this->id], Comment::class);
    }
}