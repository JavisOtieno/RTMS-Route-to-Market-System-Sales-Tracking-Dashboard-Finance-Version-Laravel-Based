<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Models\Clockin;
use App\Models\Product;
use App\Models\Clockout;
use App\Models\SaleItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Exports\ClockinsExport;
use App\Exports\StockTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportSenderTest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    // public function __construct()
    // {
    //     //
    // }
    public $clockin;

    public function __construct($clockin)
    {
        $this->clockin = $clockin;
    }
    public function build()
    {
        $clockincount = Clockin::whereDate('created_at', Carbon::yesterday())->count();
        $clockincounttill8 = Clockin::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '00:00:00')
        ->whereTime('created_at', '<', '08:00:00')
        ->count();
        $clockincounttill16 = Clockin::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '08:00:00')
        ->whereTime('created_at', '<', '16:00:00')
        ->count();
        $clockincounttill24 = Clockin::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '16:00:00')
        ->whereTime('created_at', '<', '24:00:00')
        ->count();
        $clockinfirst = Clockin::whereDate('created_at', Carbon::yesterday())->first();
        $clockinlast = Clockin::whereDate('created_at', Carbon::yesterday())
        ->orderBy('created_at', 'desc')->first();

                    // Excel::download(new , 'products.xlsx');
        // Generate the Excel file in memory
        $excelFile = Excel::raw(new ClockinsExport, \Maatwebsite\Excel\Excel::XLSX);



        $clockoutcount = Clockout::whereDate('created_at', Carbon::yesterday())->count();
        $clockoutcounttill8 = Clockout::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '00:00:00')
        ->whereTime('created_at', '<', '08:00:00')
        ->count();
        $clockoutcounttill16 = Clockout::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '08:00:00')
        ->whereTime('created_at', '<', '16:00:00')
        ->count();
        $clockoutcounttill24 = Clockout::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '16:00:00')
        ->whereTime('created_at', '<', '24:00:00')
        ->count();
        $clockoutfirst = Clockout::whereDate('created_at', Carbon::yesterday())->first();



        $visitcount = Visit::whereDate('created_at', 
        Carbon::yesterday())->count();
        $newoutletscount = Outlet::whereDate('created_at', 
        Carbon::yesterday())->count();
        $visitcounttill8 = Visit::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '00:00:00')
        ->whereTime('created_at', '<', '08:00:00')
        ->count();
        $visitcounttill16 = Visit::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '08:00:00')
        ->whereTime('created_at', '<', '16:00:00')
        ->count();
        $visitcounttill24 = Visit::whereDate('created_at', Carbon::yesterday())
        ->whereTime('created_at', '>=', '16:00:00')
        ->whereTime('created_at', '<', '24:00:00')
        ->count();

        $salescount = Sale::whereDate('created_at', 
        Carbon::yesterday())->count();

        $topseller = Sale::whereDate('created_at', Carbon::yesterday())
        ->selectRaw('user_id, COUNT(*) as total_sales')
        ->groupBy('user_id')
        ->orderByDesc('total_sales')
        ->first();
        
        $topsellercount = $topseller->total_sales;
        $topseller = User::find($topseller->user_id)->name;

        $topproduct = SaleItem::whereHas('sale', function ($query) {
            $query->whereDate('created_at', Carbon::yesterday());
        })
        ->selectRaw('product_id, COUNT(*) as product_sales')
        ->groupBy('product_id')
        ->orderByDesc('product_sales')
        ->first();
        
        $topproductcount = $topproduct->product_sales;
        $topproduct = Product::find($topproduct->product_id)->name;






        return $this->subject('Daily Report - ' . Carbon::yesterday()->format('Y-m-d'))
        ->attachData($excelFile, 'clockins_report.xlsx', [
            'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])
        ->view('email.clockintest',compact('clockincount','clockincounttill8'
        ,'clockincounttill16','clockincounttill24','clockinfirst','clockoutcount',
        'clockoutcounttill8','clockoutcounttill16','clockoutcounttill24',
        'clockoutfirst','visitcount','newoutletscount','clockinlast',
        'visitcounttill8','visitcounttill16','visitcounttill24',
        'salescount','topseller','topproduct','topsellercount','topproductcount'

    ));

        

        // return $this->subject('Daily Sales Report')
        //             ->attachData($excelFile, 'sales_report.xlsx', [
        //                 'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        //             ])
        //             ->view('emails.sales_report');
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Report Sender Test',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
