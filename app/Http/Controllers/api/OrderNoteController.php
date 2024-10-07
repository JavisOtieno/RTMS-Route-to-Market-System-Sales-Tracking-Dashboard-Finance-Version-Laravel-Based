<?php

namespace App\Http\Controllers\api;

use Dompdf\Dompdf;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderNoteController extends Controller
{
    //

    public function downloadMobilePdf($id)
    {
        $userId = auth()->id();
        $sale = Sale::where('user_id',$userId)->find($id);

        $html = view('ordernote', compact('sale'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('pdf_document.pdf', ['Attachment' => 0]);
    }
}
