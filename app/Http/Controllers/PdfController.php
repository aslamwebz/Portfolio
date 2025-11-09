<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PdfController extends Controller
{
    public function download(): BinaryFileResponse
    {
        return response()->file('pdf/resume.pdf', [
            'content-type' => 'application/pdf',
        ]);
    }
}
