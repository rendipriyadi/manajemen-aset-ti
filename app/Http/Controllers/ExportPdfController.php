<?php

namespace App\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;

class ExportPdfController extends Controller
{
    public function printPDF()
    {
        $pdf = SnappyPdf::loadView('pages.laporan.laporan-aset-user');
        $pdf->setOption('page-size', 'A4');
        $pdf->setOption('enable-local-file-access', true);

        // Generate PDF and display in the browser
        return $pdf->stream('laporan-aset-user.pdf');
    }
}
