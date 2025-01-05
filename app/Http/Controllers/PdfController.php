<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response as HttpResponse;

class PdfController extends Controller
{
    public function download()
    {
        return response()->file('pdf/resume.pdf', [
            'content-type' => 'application/pdf',
        ]);
    }

    public function show()
    {
        return view('resume.show');
    }
}
