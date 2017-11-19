<?php
abstract class model{

    // static $tableName;
    static $key;
    static $value;
    static $id;

    public function save()
    {
        if (static::$idOfColumn == '')
        {
            $array = get_object_vars($this);
            self::$key = implode(', ', $array);
            self::$value = implode(', ', array_fill(0, count($array), '?'));
            $sql = $this->insert();
            // echo $sql;
            $conn = database::getConnection();
            $statement = $conn->prepare($sql);
            $statement->execute(static::$dataToInsert);
        }
        else
        {
            $sql = $this->update();
            $conn = database::getConnection();
            $statement = $conn->prepare($sql);
            $statement->execute();
            return $sql;
            echo '<br>';
            //  print_r( static::$columnId);
        }
    }

    private function insert()
    {
        $sql = "INSERT INTO ".static::$tableName." (".self::$key.") VALUES (".self::$value.")";
        return $sql;
    }
    private function update()
    {
        $sql = "UPDATE ".static::$tableName." SET ".static::$columnToUpdate." = '".static::$updateData."' WHERE id=".static::$idOfColumn;
        return $sql;
    }
    public function delete()
    {
        $conn = database::getConnection();
        $sql = "DELETE from ".static::$tableName." WHERE id=".static::$idOfColumn;
        $statement = $conn->prepare($sql);
        $statement->execute();


    }
}
?>