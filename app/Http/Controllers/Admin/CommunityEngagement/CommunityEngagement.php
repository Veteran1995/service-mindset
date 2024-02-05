<?php

namespace App\Http\Controllers\Admin\CommunityEngagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityEngagement extends Controller
{
    public function communityEngagement()
    {
        return view('admin.CommunityEngagement.communityEngagement');
    }
}
