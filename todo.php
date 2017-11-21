<?php

interface modelInterface
{
    public function save();
    public function delete();

}
final class todo extends project\model implements modelInterface{

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
    public static $idOfColumn = '';

}

?>