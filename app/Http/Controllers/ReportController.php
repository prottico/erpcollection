<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function pdfQuotationBudgetGenerate(string $token)
    {
        
        $pdf = Pdf::loadView('reports.template');
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('honorarios'.'.pdf');
    }
}
