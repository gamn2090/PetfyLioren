<?php

namespace App\Http\Controllers;

use App\Imports\InvoiceImport;
use App\Imports\NdcImport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function UpdaloadExcel(Request $request)
    {

        $importar = Excel::import(new InvoiceImport, request()->file('excel'));
        
        
        return redirect('home');
        
    }

    public function UpdaloadNdcExcel(Request $request)
    {

        $importar = Excel::import(new NdcImport, request()->file('excel'));
        return redirect('home');      
    }

    public function CargarExcel()
    {
        return view('excels.load');
    }

    public function CargarNdcExcel()
    {
        return view('excels.loadNdc');
    }
}
