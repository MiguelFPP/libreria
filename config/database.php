<?php
class DataBase
{
    public static function connect()
    {
        $db = new mysqli('localhost', 'root', '', 'libreria');
        $db->query("set names 'utf8'");

        return $db;
    }
}
