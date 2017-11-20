<?php

namespace project;

abstract class collection
{
    static public function create()
    {
        $model = new static::$modelName;
        return $model;
    }
    static function findAll()
    {
        $conn = database::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM '.$tableName;
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $class = static::$modelName;
        $stmt->setFetchMode(\PDO::FETCH_CLASS,$class);
        // $stmt->setFetchMode(PDO::FETCH_COLUMN);

        $result= $stmt->fetchAll();
        return $result;
    }
    static function findOne($id)
    {
        $conn = database::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM '.$tableName.' WHERE id =' .$id;
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $class = static::$modelName;
        $stmt->setFetchMode(\PDO::FETCH_CLASS,$class);
        $result= $stmt->fetchAll();
        return $result;
    }
    static function findOneLessThan($id)
    {
        $conn = database::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM '.$tableName.' WHERE id < ' .$id;
        // $sql = 'SELECT * FROM :table WHERE id <:id';
        $stmt=$conn->prepare($sql);
        $stmt->execute(['table'=>$tableName,'id'=>$id]);
        $class = static::$modelName;
        $stmt->setFetchMode(\PDO::FETCH_CLASS,$class);
        $result= $stmt->fetchAll();
        echo '<br>';
        echo 'The number of rows returned is '.$stmt->rowCount();
        return $result;
    }
}
?>