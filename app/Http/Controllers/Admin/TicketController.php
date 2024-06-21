<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->get();

        return Inertia::render('Admin/Pesanan/Index', [
            'tickets' => $tickets,
        ]);
    }

    // public function destroy() {}
}
