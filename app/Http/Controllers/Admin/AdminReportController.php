<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Inertia\Inertia;

class AdminReportController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->orderBy('checked_in', 'DESC')->paginate(10);
       
        return Inertia::render('Admin/Report/Index', [
            'tickets' => $tickets,
        ]);
    }
}
