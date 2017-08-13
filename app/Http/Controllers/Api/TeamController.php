<?php

namespace App\Http\Controllers\Api;

use App\Individual;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $individualId = $request->input('individualId');

        return Team::withJoined($individualId)->get()->keyBy('id');
    }

    public function join(Request $request)
    {
        $team = Team::findOrFail($request->input('teamId'));
        $individual = Individual::where('user_id', \Auth::id())->firstOrFail();

        try {
            $team->individuals()->save($individual);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return ['status' => 'already joined'];
            }
        }
        return ['status' => 'ok'];
    }
}
