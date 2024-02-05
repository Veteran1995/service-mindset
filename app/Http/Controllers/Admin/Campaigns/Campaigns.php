<?php

namespace App\Http\Controllers\Admin\Campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Campaigns extends Controller
{
    public function campaigns()
    {
        return view('admin.Campaigns.campaigns');
    }
}
