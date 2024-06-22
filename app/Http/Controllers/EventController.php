<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ticket;

class EventController extends Controller
{
    public function daftar(Request $request)
    {
        Ticket::create([
            'user_id' => Auth::id(),
            'ticket' => Str::uuid(),
        ]);

        return redirect()->back()->with('success', 'Tiket berhasil dibuat!');
    }
}
