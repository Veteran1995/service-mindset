<?php

namespace App\Http\Controllers\Admin\Crews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrewsController extends Controller
{
    public function crews()
    {
        return view('admin.Crews.crews');
    }

    public function crewMembers($crew_id)
    {
        return view('admin.Crews.members')->with('crew_id', $crew_id);;
    }

    public function singleCrew($crew_id)
    {
        return view('admin.Crews.single-crew')->with('crew_id', $crew_id);;
    }

    public function addCrewMembers($crew_id)
    {
        return view('admin.Crews.add-crew-members')->with('crew_id', $crew_id);;
    }
}
