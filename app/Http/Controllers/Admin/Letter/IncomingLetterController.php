<?php

namespace App\Http\Controllers\Admin\Letter;

use App\Http\Controllers\Controller;
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

        $totalIncomings = Letter::incoming()->count();

        $search = $request->search;
        $since = $request->since;
        $until = $request->until;
        $filter = $request->filter;
        $query = $request->getQueryString();

        return view(
            'admins.letters.incomings.index',
            compact(['incomings', 'totalIncomings', 'search', 'since', 'until', 'filter', 'query']),
        );
    }
}
