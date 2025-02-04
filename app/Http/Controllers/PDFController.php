<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PAC;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PDFController extends Controller
{
    public function pacPDF($slug, Request $request)
    {
        $pac = PAC::where('slug', $slug)
            ->with('users')
            ->latest()
            ->first();

        if (! $pac) {
            abort(404);
        }

        $count_user = $pac->users->count();
        $now = Carbon::now()->format('Y-m-d');

        return view('admins.pac.pac-pdf', compact('pac', 'count_user', 'now'));
    }

    public function cadrePDF($id, Request $request)
    {
        $users = User::findOrFail($id);
        $now = Carbon::now()->format('Y-m-d');

        return view('admins.users.pdf', compact('users', 'now'));
    }
}
