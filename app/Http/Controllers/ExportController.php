<?php

namespace App\Http\Controllers;

use App\Exports\ItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ItemsExport, 'items.xlsx');
    }
}