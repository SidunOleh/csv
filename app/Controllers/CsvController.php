<?php

namespace App\Controllers;

use App\Components\Response;
use App\Models\User;
use App\Validators\Rules\Csv;
use App\Validators\Validator;

class CsvController extends Controller
{
    public function index()
    {
        return Response::view('index');
    }

    public function table()
    {
        $users = User::all();

        return Response::view('table', compact('users'));
    }

    public function import()
    {
        Response::headers(['Location'=>'/']);
        
        $validator = new Validator([
            'csv' => new Csv('/^[a-zA-Z]{3,100},[a-zA-Z]{3,100}$/', true),
        ]);

        $validator->validate();

        if ($validator->isFaiulre()) {
            $_SESSION['message'] = $validator->errors()['csv'];
            return;
        }

        $filename = ROOT . '/storage/' .randStr() . '.csv';
        move_uploaded_file($_FILES['csv']['tmp_name'], $filename);
        
        User::import($filename);

        $_SESSION['message'] = 'CSV file is successfully uploaded';
    }

    public function export()
    {
        Response::headers([
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=users.csv',
        ]);

        return User::export();
    }
}
