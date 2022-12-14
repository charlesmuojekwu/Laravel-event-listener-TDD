<?php

namespace App\Http\Controllers;

use App\Events\NewEntryRecievedEvent;
use App\Models\ContestEntry;
use Illuminate\Http\Request;

class ContestEntryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email'
        ]);


        $contestEntry = ContestEntry::create($data);


        //event(NewEntryRecievedEvent::class);

        NewEntryRecievedEvent::dispatch($contestEntry);
    }
}
