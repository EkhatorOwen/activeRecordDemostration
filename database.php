<?php
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
?>