<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioItemController extends Controller
{
    public function index()
    {
        // Return portfolio items ordered by creation date in descending order (newest first)
        return response()->json(PortfolioItem::orderBy('created_at', 'desc')->get());
    }
}
