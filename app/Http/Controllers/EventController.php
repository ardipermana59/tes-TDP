<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class EventController extends Controller
{
    public function daftar(Request $request)
    {
       Ticket::create([
            'user_id' => Auth::id(),
            'ticket' => Str::uuid(),
        ]);
      
        // Redirect atau kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Tiket berhasil dibuat!');
    }
}
