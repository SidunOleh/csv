<?php

namespace App\Models;

use App\Components\DB;

class User extends Model
{
    protected static $table = 'users';

    public static function import($filename)
    {
        $result = DB::query("LOAD DATA INFILE '$filename' 
            INTO TABLE users
            FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'
            IGNORE 1 LINES
            (name,surname)");

        return $result ? true : false;
    }

    public static function export()
    {
        $users = self::all();

        $csv = "name,surname\n";
        foreach ($users as $user) {
            $csv .= $user->name . ',' . $user->surname . "\n";
        }

        return $csv;
    } 
}
