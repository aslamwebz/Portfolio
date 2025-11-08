<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class IntroController extends Controller
{
    public function index(): View
    {
        $role = 'Senior Web Developer & Tech Lead';
        $techStack = 'LAMP - LEMP - PHP/Laravel';
        $status = "Lead Developer @Qewam\nCo-founder & CTO @Muthlthat";

        return view('intro', [
            'role' => $role,
            'techStack' => $techStack,
            'status' => $status,
        ]);
    }
}
