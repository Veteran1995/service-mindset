<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function itineraryDetail($itinerary_id)
    {
        return view('admin.Itinerary.itinerary-detail')->with('itinerary_id', $itinerary_id);
    }
}
