<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\PortfolioItem;

class PortfolioItemController extends Controller
{
    public function index()
    {
        // Return portfolio items ordered by creation date in descending order (newest first)
        return response()->json(PortfolioItem::orderBy('created_at', 'desc')->get());
    }
}
