<?php

namespace App\Models;

use App\Components\DB;

class CsvModel extends Model
{
    public static function users()
    {
        $db = DB::get();

        $result = $db->query("SELECT * FROM `users`");

        return $result->fetchAll();
    }

    public static function import($filename)
    {
        $db = DB::get();

        $result = $db->query("LOAD DATA INFILE '$filename' 
            INTO TABLE users 
            FIELDS TERMINATED BY ','
            IGNORE 1 LINES");
            
        if (! $result) {
            return false;
        } 

        return true;
    }

    public static function export()
    {
        $users = self::users();

        $csv = "name,surname\r\n";
        foreach ($users as $user) {
            $csv .= $user['name'] . ',' . $user['surname'] . "\r\n";
        }

        return $csv;
    } 
}
