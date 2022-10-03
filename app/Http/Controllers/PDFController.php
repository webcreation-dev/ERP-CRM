<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comfile;
use PDF;
use App\User;

class PDFController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function printPDF($id) {

        $comfile = Comfile::where("id", $id)->first();

        $pdf = PDF::loadView('livewire.print', compact('comfile'));

        return $pdf->stream('Print.pdf');
    }


    public function exportPDF() {

        $data = [
            "comfiles" => Comfile::where("status", "client")->get(),
        ];
        $pdf = PDF::loadView('livewire.export', $data);

        return $pdf->stream('Export.pdf', $data);
    }
}
