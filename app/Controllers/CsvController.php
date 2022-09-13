<?php

namespace App\Controllers;

use App\Models\CsvModel;
use App\Components\Response;
use App\Validation\CsvValidator;

class CsvController extends Controller
{
    public function index()
    {
        return Response::view('index');
    }

    public function table()
    {
        $users = CsvModel::users();

        return Response::view('table', compact('users'));
    }

    public function import()
    {
        header('Location: /');
        
        if (! isset($_FILES['csv']) or $_FILES['csv']['error']) {
            $_SESSION['message'] = 'Problem with CSV file';
            return;
        }

        $filename = ROOT . '/csv/files/' . randStr() . '.csv';
        move_uploaded_file($_FILES['csv']['tmp_name'], $filename);

        $validator = new CsvValidator(ROOT . '/csv/scheme/scheme.json');

        if (! $validator->isValidFile($filename)) {
            $_SESSION['message'] = 'CSV file is invalid';
            return;
        }
        
        CsvModel::import($filename);

        $_SESSION['message'] = 'CSV file is successfully uploaded';
    }

    public function export()
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=users.csv');

        $csv = CsvModel::export();

        return $csv;
    }
}
