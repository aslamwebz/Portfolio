<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\JsonResponse;

class PortfolioItemController extends Controller
{
    public function index(): JsonResponse
    {
        // Return portfolio items ordered by creation date in descending order (newest first)
        return response()->json(PortfolioItem::orderBy('created_at', 'desc')->get());
    }
}
