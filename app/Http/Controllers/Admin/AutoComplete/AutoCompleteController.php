<?php

namespace App\Http\Controllers\Admin\AutoComplete;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoCompleteController extends Controller
{
    function index()
    {
        return view('autocomplete');
    }
    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('users')
                ->where('email', 'LIKE', "%{$query}%")
                ->where('email', '<>', auth()->user()->email)
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            foreach ($data as $row) {
                $output .= '
                <li><a class="dropdown-item" href="#">' . $row->email . '</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
