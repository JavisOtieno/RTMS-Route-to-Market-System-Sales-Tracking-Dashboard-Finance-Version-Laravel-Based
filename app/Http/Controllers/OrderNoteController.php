<?php

namespace App\Http\Controllers;

use App\Models\Sale;
//use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use Dompdf\Dompdf;

class OrderNoteController extends Controller
{
    //
    public function index($id){
        $sale = Sale::find($id);
        return view('ordernote',compact('sale'));
    }
    public function downloadPdf($id)
    {
        $sale = Sale::find($id);

        $html = view('ordernote', compact('sale'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream('pdf_document.pdf', ['Attachment' => 0]);
    }
    // public function downloadPdf($id)
    // {
    //     // Data to pass to the view
    //     $data = [
    //         'variable' => 'This is dynamic content',
    //     ];
    //     $sale = Sale::find($id);

    //     // Load the view and pass the data
    //     $pdf = PDF::loadView('ordenote', $sale);

    //     // Download the generated PDF
    //     return $pdf->download('page.pdf');
    // }
    
}
