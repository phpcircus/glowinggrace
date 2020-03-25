<?php

namespace App\Http\Responders\Admin\Tshirt\Pdf;

use PDF;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class OrdersPdfResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return mixed
     */
    public function respond()
    {
        $pdf = PDF::loadView('pdf.orders', $this->payload)->setPaper('letter', 'landscape');

        return response()->make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=orders.pdf',
        ]);
    }
}
