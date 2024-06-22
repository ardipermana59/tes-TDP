<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Inertia\Inertia;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->paginate(10);
        return Inertia::render('Admin/Pesanan/Index', [
            'tickets' => $tickets,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $tickets = Ticket::where('ticket', 'like', '%' . $query . '%')
            ->with('user')
            ->paginate(10);

        return Inertia::render('Admin/Pesanan/Index', [
            'tickets' => $tickets,
            'searchQuery' => $query,
        ]);
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return redirect()->back()->withErrors(['message' => 'Pesanan tidak ditemukan']);
        }

        $ticket->delete();

        return redirect()->back()->with(['message' => 'Data berhasil dihapus']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ticket' => 'required|string',
        ]);

        // Cek tiket yang sama
        $isExistTicket = Ticket::where('ticket', $request->ticket)->first();

        if ($isExistTicket) {
            return redirect()->back()->withErrors(['message' => 'Tiket sudah ada']);
        }
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return redirect()->back()->withErrors(['message' => 'Pesanan tidak ditemukan']);
        }


        $ticket->ticket = $request->ticket;
        $ticket->save();

        return redirect()->back()->with(['message' => 'Data berhasil diupdate']);
    }
}
