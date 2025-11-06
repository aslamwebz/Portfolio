<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class IntroController extends Controller
{
    public function index()
    {
        $role = 'Senior Web Developer & Tech Lead';
        $techStack = 'LAMP - LEMP - PHP/Laravel';
        $status = 'Lead Developer @Qewam
Co-founder & CTO @Muthlthat';

        return view('intro', [
            'role' => $role,
            'techStack' => $techStack,
            'status' => $status,
        ]);
    }
}
