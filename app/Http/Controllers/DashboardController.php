<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->role == 'peserta') {
            $ticket = Ticket::select('ticket')->where('user_id', auth()->user()->id)->first();

            return Inertia::render('Dashboard',[
                'ticket' => $ticket,
            ]);
        }
        
        return Inertia::render('Admin/AdminDashboard');
    }
}
