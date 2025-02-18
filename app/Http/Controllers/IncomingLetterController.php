<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IncomingLetterController extends Controller
{
    public function index(Request $request): View
    {
        $incomings = Letter::incoming()
            ->agenda($request->since, $request->until, $request->filter)
            ->render($request->search);
        $search = $request->search;
        $since = $request->since;
        $until = $request->until;
        $filter = $request->filter;
        $query = $request->getQueryString();

        return view(
            'admins.letters.incomings.index',
            compact(['incomings', 'search', 'since', 'until', 'filter', 'query']),
        );
    }
}
