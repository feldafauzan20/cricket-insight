<?php

namespace App\Http\Controllers;

use App\Models\OngoingTournament;
use Illuminate\Http\Request;

class OngoingTournamentController extends Controller
{
    /**
     * Display a listing of the ongoing tournaments.
     */
    public function index()
    {
        $ongoingTournaments = OngoingTournament::query()
            ->orderByDesc('time_date')
            ->paginate(12);

        return view('ongoing-tournaments.index', compact('ongoingTournaments'));
    }

    /**
     * Display the specified ongoing tournament.
     */
    public function show($id)
    {
        $ongoingTournament = OngoingTournament::findOrFail($id);

        return view('ongoing-tournaments.show', compact('ongoingTournament'));
    }
}
