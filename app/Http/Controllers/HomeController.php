<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\News;
use App\Models\User;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $home = Home::all();

        $quotes = Quote::latest()
            ->take(5)
            ->get();

        $recentNews = News::with('category', 'user')
            ->where('active', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // User counts by cadres level
        $levels = ['Belum Makesta', 'Latinpel', 'Lakut', 'Lakmud', 'Makesta'];

        $cadreLevels = User::selectRaw('cadre_level, COUNT(*) as count')
            ->whereIn('cadre_level', $levels)
            ->groupBy('cadre_level')
            ->pluck('count', 'cadre_level');

        $cadreLevelCounts = [];
        foreach ($levels as $level) {
            $cadreLevelCounts[$level] = $cadreLevels->get($level, 0);
        }

        // User counts by gender
        $genderLists = ['L', 'P'];

        $genders = User::selectRaw('gender, COUNT(*) as count')
            ->whereIn('gender', $genderLists)
            ->groupBy('gender')
            ->pluck('count', 'gender');

        $genderCounts = [];

        foreach ($genderLists as $gender) {
            $genderCounts[$gender] = $genders->get($gender, 0);
        }

        // User counts by PAC
        $pacs = User::selectRaw('pac_id, COUNT(*) as count')
            ->whereIn('pac_id', range(1, 29))
            ->groupBy('pac_id')
            ->pluck('count', 'pac_id');

        $pacCounts = [];

        foreach (range(1, 29) as $pacId) {
            $pacCounts[$pacId] = $pacs->get($pacId, 0);
        }

        // User counts by Makesta year
        $years = ['Sebelum 2017', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025'];

        $makestas = User::selectRaw('makesta_year, COUNT(*) as count')
            ->whereIn('makesta_year', $years)
            ->groupBy('makesta_year')
            ->pluck('count', 'makesta_year');

        $lakmuds = User::selectRaw('lakmud_year, COUNT(*) as count')
            ->whereIn('lakmud_year', $years)
            ->groupBy('lakmud_year')
            ->pluck('count', 'lakmud_year');

        $lakuts = User::selectRaw('lakut_year, COUNT(*) as count')
            ->whereIn('lakut_year', $years)
            ->groupBy('lakut_year')
            ->pluck('count', 'lakut_year');

        $latinpels = User::selectRaw('latinpel_year, COUNT(*) as count')
            ->whereIn('latinpel_year', $years)
            ->groupBy('latinpel_year')
            ->pluck('count', 'latinpel_year');

        $makestaCounts = [];
        $lakmudCounts = [];
        $lakutCounts = [];
        $latinpelCounts = [];

        foreach ($years as $year) {
            $makestaCounts[$year] = $makestas->get($year, 0);
            $lakmudCounts[$year] = $lakmuds->get($year, 0);
            $lakutCounts[$year] = $lakuts->get($year, 0);
            $latinpelCounts[$year] = $latinpels->get($year, 0);
        }

        return view(
            'users.home',
            compact([
                'home',
                'user',
                'quotes',
                'recentNews',
                'cadreLevelCounts',
                'genderCounts',
                'pacCounts',
                'makestaCounts',
                'lakmudCounts',
                'lakutCounts',
                'latinpelCounts',
            ]),
        );
    }

    public function adminIndex()
    {
        $pages = Home::all();

        return view('admins.pages.index', compact(['pages']));
    }

    public function edit($id)
    {
        $pages = Home::find($id);
        return view('admins.pages.edit', compact(['pages']));
    }

    public function update($id, Request $request)
    {
        $pagesToUpdate = Home::findOrFail($id);

        $pagesData = $request->all();
        if ($request->file) {
            $extension = $request->file->getClientOriginalExtension();
            $newFileName = 'banner_update' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('file')->move(public_path('/storage/images'), $newFileName);
            $pagesData['file'] = $newFileName;
        }

        $pagesToUpdate->update($pagesData);

        Alert::success('Mantap Sahabat', 'Banner Berhasil Di Ubah');
        return redirect()->route('pages.index');
    }
}
