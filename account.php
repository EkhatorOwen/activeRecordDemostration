<?php

interface modelInterface
{
    public function save();
    public function delete();

}

final class account extends project\model implements modelInterface
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



}
?>