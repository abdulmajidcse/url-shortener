<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        if (auth()->user()->is_admin) {
            $data['users'] = User::withCount('shortUrls')->latest()->paginate(10)->onEachSide(1)->withQueryString();
        } else {
            $data['short_urls_count'] = auth()->user()->shortUrls->count();
        }

        return view('dashboard', $data);
    }
}
