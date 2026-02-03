<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Player;
use App\Models\Team;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/Dashboard', [
            'stats' => [
                'teams' => Team::count(),
                'players' => Player::count(),
                'partners' => Partner::count(),
            ],
        ]);
    }
}
