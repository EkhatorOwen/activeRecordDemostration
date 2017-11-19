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



include 'model.php';
include 'database.php';
include 'collection.php';
include "account.php";
include "todos.php";
include "string.php";
include "todo.php";
include 'accounts.php';
include "htmlTable.php";


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

string::printThisInH1('Insert New Record in Todos Table');
//string::printThisInH3('Insert wher3');
$obj = new Todo;
$obj->save();
$obj =  todos::create();
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



*/







