<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioItemController extends Controller
{
    public function index()
    {
        return response()->json(PortfolioItem::all());
    }
}
