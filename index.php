<style>

    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }


</style>
<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);

define('SERVERNAME', 'sql1.njit.edu');
define('USERNAME','oe52');
define('PASSWORD','EBFDKE2u');
define('DBNAME','oe52');

class model{

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

class database
{
    protected static $conn;
    function __construct()
    {
        try {
            self::$conn = new PDO('mysql:host='.SERVERNAME.';dbname='.DBNAME , USERNAME, PASSWORD);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'connected succesfully';
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }
    static function getConnection()
    {
        if(!self::$conn)
        {
            new database;
        }
        return self::$conn;
    }
}
class collection
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
        $stmt->setFetchMode(PDO::FETCH_CLASS,$class);
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
        $stmt->setFetchMode(PDO::FETCH_CLASS,$class);
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
        $stmt->setFetchMode(PDO::FETCH_CLASS,$class);
        $result= $stmt->fetchAll();
        echo '<br>';
        echo 'The number of rows returned is '.$stmt->rowCount();
        return $result;
    }
}
class accounts extends collection
{
    protected static $modelName = 'accounts';
}
class todos extends collection {

    protected static $modelName = 'todos';
}

class htmlTable
{
    function makeTable($data)
    {
        echo '<table>';

        foreach ($data as $data)
        {
            echo "<tr>";

            foreach ($data as $column) {

                echo "<td>$column</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}

class todo extends model {

    // column names
    public $owneremail = 'owneremail';
    public $ownerid = 'ownerid';
    public $createddate = 'createddate';
    public $duedate = 'duedate';
    public $message = 'message';
    public $isdone = 'isdone';

    //corresponding data
    protected static $dataToInsert = array('o@ek.com','34','11/13/2017','12/13/2017','how are you','1');
    //table name
    public static $tableName = 'todos';

    //column to be updated for update query
    public static $columnToUpdate='owneremail';
    //data to be updated into column
    public static $updateData = 'nnn@test.com';
    //id to update
    public static $idOfColumn = '3';

}

class account extends model
{

    //column names
    public $email = 'email';
    public $fname = 'fname';
    public $lname = 'lname';
    public $phone = 'phone';
    public $birthday = 'birthday';
    public $gender = 'gender';
    public $password = 'password';

    //corresponding data
    protected static $dataToInsert = array('o@tes.com','bubu','james','08136718898','12-02-1999','male','xxxx');

    //table name
    public static $tableName = 'accounts';

    //column to be updated
    public static $columnToUpdate='lname';

    //data to be inserted into column
    protected static $updateData = 'Abraham';

    //id to update
    public static $idOfColumn = '6';

    // public static $columnId = 8;


}

class string
{
    static function printThisInH1($string)
    {
        echo '<h1>'.$string.'</h1>';
    }

    static function printThisInH3($string)
    {
        echo '<h3>'.$string.'</h3>';
    }
}


string::printThisInH1('Select All Record From Accounts Table');
$obj =  accounts::create();
$result = $obj -> findAll();
$tab = new htmlTable;
$tab->makeTable($result);
echo '<br>';
echo '<br>';

string::printThisInH1('Select One Record From Accounts Table');
string::printThisInH3('Select Record ID 6');

$obj =  accounts::create();
$result = $obj -> findOne(6);
$tab = new htmlTable;
$tab->makeTable($result);
echo '<br>';
echo '<br>';

string::printThisInH1('Insert New Record in Accounts Table');
//string::printThisInH3('Select Record ID 6');
$obj = new Account;
$obj->save('');
$obj =  accounts::create();
$result = $obj -> findAll();
$tab = new htmlTable;
$tab->makeTable($result);
echo '<br>';
echo '<br>';

string::printThisInH1('Update New Record in Accounts Table');
string::printThisInH3('update lname = Abraham where id=9');
$obj = new Account;
$obj->save();
$obj =  accounts::create();
$result = $obj -> findAll();
$tab = new htmlTable;
$tab->makeTable($result);
echo '<br>';
echo '<br>';


/*$obj = new account;
$obj->save();
echo '<br>';

$obj->delete();










