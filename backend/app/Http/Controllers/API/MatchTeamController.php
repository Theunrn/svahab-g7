<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MatchTeam;
use Illuminate\Http\Request;

class MatchTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matchTeams = MatchTeam::all();
        $matchTeams = MatchTeam::latest()->get();
        return response()->json(['sucess' => true, 'data' => $matchTeams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        MatchTeam::store($request);
        return response()->json(['success' => true, 'message' =>'created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
