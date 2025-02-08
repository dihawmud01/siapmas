<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $userCounts = User::count();

        // User counts by role id
        $roleIds = range(1, 4);

        $members = User::selectRaw('role_id, COUNT(*) as count')
            ->whereIn('role_id', $roleIds)
            ->groupBy('role_id')
            ->pluck('count', 'role_id');

        $memberCounts = [];
        $cadreCounts = 0;

        foreach ($roleIds as $roleId) {
            if (in_array($roleId, range(1, 3))) {
                $memberCounts[$roleId] = $members->get($roleId, 0);
            } else {
                $cadreCounts = $members->get($roleId, 0);
                $cadreCounts = min($cadreCounts, 10);
            }
        }

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

        $posts = News::with('category', 'tags')
            ->where('active', 1)
            ->take(10)
            ->get();

        return view(
            'admins.index',
            compact(
                'posts',
                'memberCounts',
                'cadreCounts',
                'userCounts',
                'cadreLevelCounts',
                'genderCounts',
                'pacCounts',
                'makestaCounts',
                'lakmudCounts',
                'lakutCounts',
                'latinpelCounts',
            ),
        );
    }
}
