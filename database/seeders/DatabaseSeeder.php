<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin'
        ]);

         for ($i = 1; $i <= 50; $i++) {
            User::factory()->create([
                'name' => "Peserta $i",
                'email' => "peserta{$i}@gmail.com",
                'role' => 'peserta',
            ]);
        }
        
        $pesertaUsers = User::where('role', 'peserta')->get();

        foreach ($pesertaUsers as $peserta) {
            Ticket::create([
                'user_id' => $peserta->id,
                'ticket' => Str::uuid(),
                'checked_in' => null,
            ]);
        }
    }
}
