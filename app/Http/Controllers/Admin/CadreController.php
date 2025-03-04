<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CadreLevel;
use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PAC;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravolt\Indonesia\Models\Province;
use RealRashid\SweetAlert\Facades\Alert;

class CadreController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $members = Member::where('pac_id', $user->pac_id)
            ->search($request->search)
            ->paginate(10);

        return view('admins.members.index', compact('members'));
    }

    public function showStatistic(Request $request)
    {
        $statistic = Member::all();

        return view('admins.index', compact(['statistic']));
    }

    public function create()
    {
        $user = Auth();

        $province = Province::all()
            ->sortBy('name')
            ->pluck('name', 'id');

        $years = [
            '2016' => 'Sebelum 2017',
            '2017' => '2017',
            '2018' => '2018',
            '2019' => '2019',
            '2020' => '2020',
            '2021' => '2021',
            '2022' => '2022',
            '2023' => '2023',
            '2024' => '2024',
        ];

        $attendanceCount = [
            'Belum Pernah',
            'Pernah 1 kali',
            'Pernah 2 Kali',
            'Pernah 3 Kali',
            'Pernah 4 Kali',
            'Pernah 5 Kali',
            'Pernah 6 Kali',
            'Pernah 7 Kali',
            'Pernah 8 Kali',
            'Pernah 9 Kali',
            'Lebih dari 9 Kali',
        ];

        $cadreLevels = CadreLevel::getLabels();

        $genders = Gender::getLabels();

        return view(
            'admins.members.create',
            compact('province', 'user', 'cadreLevels', 'years', 'attendanceCount', 'genders'),
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'boarding_school' => 'nullable|string',
            'highschool' => 'required|string',
            'college_year' => 'required|integer',
            'phone' => 'required|string|max:15',
            'informal' => 'required|string',
            'cadre_levels' => 'required|array',
            'cadre_levels.*' => 'string|in:makesta,lakmud,lakut,latinpel',
            'makesta_year' => 'nullable|integer',
            'lakmud_year' => 'nullable|integer',
            'lakut_year' => 'nullable|integer',
            'latinpel_year' => 'nullable|integer',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $validatedData['pac_id'] = $user->pac_id;

        if ($request->hasFile('img')) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'profile_' . $request->name . '_' . now()->timestamp . '.' . $extension;
            $request->file->move(
                public_path('storage/cadre/' . strtolower(str_replace(' ', '-', $user->pac->pac)) . '/photo/'),
                $newFileName,
            );

            $validatedData['img'] = $newFileName;
        } else {
            $validatedData['img'] = 'default.png';
        }

        Member::create($validatedData);

        Alert::success('Penambahan Anggota Berhasil');

        return redirect()->route('members.index');
    }

    public function edit($id)
    {
        $cadre = Member::find($id);
        $genders = [
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
        ];

        return view('admins.cadres.edit', compact('cadre', 'genders'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'img' => 'required',
            'simtimes|image:gif,png,jpg,jpeg',
        ]);

        $cadre = Member::find($id);

        $cadre->name = $request->name;
        $cadre->address = $request->address;
        $cadre->nim = $request->nim;
        $cadre->gender = $request->gender;
        $cadre->place_of_birth = $request->place_of_birth;
        $cadre->date_of_birth = $request->date_of_birth;
        $cadre->phone = $request->wa;
        $cadre->highschool = $request->highschool;
        $cadre->grad_year = $request->grad_year;
        $cadre->boarding_school = $request->boarding_school;
        $cadre->college_year = $request->college_year;
        $cadre->makesta_year = $request->makesta_year;
        $cadre->organizer_makesta = $request->organizer_makesta;
        $cadre->lakmud_year = $request->lakmud_year;
        $cadre->lakut_year = $request->lakut_year;
        $cadre->latinpel_year = $request->latinpel_year;
        $cadre->informal = $request->informal;
        $cadre->organizer_informal = $request->organizer_informal;
        $cadre->nonformal = $request->nonformal;
        $cadre->organizer_nonformal = $request->organizer_nonformal;
        $cadre->update();

        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'profile' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->storeAs('/uploads', $newFileName);
            $cadre['img'] = $newFileName;
            $cadre->update();
        }

        return redirect()->route('cadres.index');
    }

    public function destroy($id)
    {
        $cadre = Member::findOrFail($id);
        $cadre->delete();

        return redirect()->route('cadres.index');
    }

    public function viewCadre($id)
    {
        $cadre = Member::find($id);
        $user = User::find($id);

        return view('admins.cadres.view', compact(['cadre', 'user']));
    }

    public function showMakestaCadres(Request $request)
    {
        $makestaCadres = User::whereIn('cadre_levels', ['Makesta', 'Lakmud', 'Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.makesta', compact('makestaCadres'));
    }

    public function showLakmudCadres(Request $request)
    {
        $lakmudCadres = User::whereIn('cadre_levels', ['Lakmud', 'Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.lakmud', compact('lakmudCadres'));
    }

    public function showLakutCadres(Request $request)
    {
        $lakutCadres = User::whereIn('cadre_levels', ['Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.lakut', compact('lakutCadres'));
    }

    public function showLatinpelCadres(Request $request)
    {
        $latinpelCadres = User::where('cadre_levels', 'Latinpel')
            ->latest()
            ->paginate(10);
        return view('admins.users.latinpel', compact('latinpelCadres'));
    }

    public function showList($slug, Request $request)
    {
        $user = Auth::user();

        $pac = PAC::where('slug', $slug)
            ->with('members')
            ->latest()
            ->paginate(10);

        if ($request->has('search')) {
            $members = Member::Where('name', 'LIKE', '%' . $request->search . '%')
                ->orwhere('gender', 'LIKE', '%' . $request->search . '%')
                ->orwhere('pac_id', $user->pac_id)
                ->paginate(10);
        } else {
            $members = Member::latest()->paginate(10);
        }

        return view('admins.pac.show', compact('pac', 'user'));
    }
}
