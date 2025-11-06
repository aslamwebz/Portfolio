<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PdfController extends Controller
{
    public function download(): BinaryFileResponse
    {
        return response()->file('pdf/resume.pdf', [
            'content-type' => 'application/pdf',
        ]);
    }

    public function show(): View
    {
        return view('resume.show');
    }
}
