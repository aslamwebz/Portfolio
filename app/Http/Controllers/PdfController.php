<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
