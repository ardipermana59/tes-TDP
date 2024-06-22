<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Error;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminCheckinController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Checkin/Index');
    }

    public function checkTicket(Request $request)
    {
        $request->validate([
            'ticket' => ['required', 'string'],
        ]);

        $ticket = Ticket::where('ticket', $request->ticket)->first();

        if (!$ticket) {
            return redirect()->back()->withErrors(['message' => 'Tiket tidak ditemukan']);
        }

        if ($ticket->checked_in != null) {
            return redirect()->back()->withErrors(['message' => 'Tiket sudah digunakan']);
        }

        $ticket->checked_in = now();

        $ticket->save();

        return redirect()->back()->with(['message' => 'Berhasil checkin']);
    }
}
