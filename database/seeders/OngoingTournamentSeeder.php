<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OngoingTournament;

class OngoingTournamentSeeder extends Seeder
{
    public function run(): void
    {
        $tournaments = [
            [
                'tournament_title' => 'Bali Bash International 2026',
                'image' => null,
                'redirect_link' => 'https://cricketinsight.com/tournaments/bali-bash-2026',
                'time_date' => now()->addDays(5),
                'description' => 'Official International Cricket Tournament hosted in Bali, Indonesia featuring top Asian and European teams.',
            ],
            [
                'tournament_title' => 'Sweden Tour to Indonesia 2026',
                'image' => null,
                'redirect_link' => 'https://cricketinsight.com/tournaments/sweden-tour-2026',
                'time_date' => now()->addDays(12),
                'description' => 'Exclusive T20 and ODI match series between Sweden National Cricket Team and Indonesia National Team.',
            ],
            [
                'tournament_title' => 'Kartini Cup T20 Women Series',
                'image' => null,
                'redirect_link' => 'https://cricketinsight.com/tournaments/kartini-cup-2026',
                'time_date' => now()->addDays(20),
                'description' => 'Women\'s premier T20 tournament bringing together international national teams in South East Asia.',
            ],
        ];

        foreach ($tournaments as $data) {
            OngoingTournament::firstOrCreate(
                ['tournament_title' => $data['tournament_title']],
                $data
            );
        }
    }
}
