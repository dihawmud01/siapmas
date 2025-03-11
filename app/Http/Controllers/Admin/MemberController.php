<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Gender;
use App\Enums\MembershipStatus;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PAC;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $members = Member::where('pac_id', $user->pac_id)
            ->search($request->search)
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('admins.members.index', compact('members'));
    }

    //    public function showStatistic(Request $request)
    //    {
    //        $statistic = Member::all();
    //
    //        return view('admins.index', compact(['statistic']));
    //    }

    public function create()
    {
        $user = Auth::user();

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
        $formalCadreLevels = ['makesta', 'lakmud', 'lakut'];
        $nonFormalCadreLevels = ['diklatama', 'diklatnas', 'diklatmad', 'latinpel'];

        $genders = Gender::getLabels();
        $membershipStatus = MembershipStatus::getLabels();

        return view(
            'admins.members.create',
            compact('user', 'formalCadreLevels', 'nonFormalCadreLevels', 'years', 'genders', 'membershipStatus'),
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'gender' => 'required|string',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'formal_cadre_levels' => 'required|array|min:1',
            'formal_cadre_levels.*' => 'string|in:makesta,lakmud,lakut',
            'non_formal_cadre_levels' => 'nullable|array|min:1',
            'non_formal_cadre_levels.*' => 'string|in:diklatama,diklatmad,diklatnas,latinpel',
            'makesta_year' => 'nullable|integer',
            'lakmud_year' => 'nullable|integer',
            'lakut_year' => 'nullable|integer',
            'phone' => 'required|string|max:15',
        ]);

        $user = Auth::user();
        $validatedData['pac_id'] = $user->pac_id;

        $formalCadres = $request->input('formal_cadre_levels', []);
        $validatedData['is_makesta'] = in_array('makesta', $formalCadres);
        $validatedData['is_lakmud'] = in_array('lakmud', $formalCadres);
        $validatedData['is_lakut'] = in_array('lakut', $formalCadres);

        $nonFormalCadres = $request->input('non_formal_cadre_levels', []);
        $validatedData['is_diklatama'] = in_array('diklatama', $nonFormalCadres);
        $validatedData['is_diklatnas'] = in_array('diklatnas', $nonFormalCadres);
        $validatedData['is_diklatmad'] = in_array('diklatmad', $nonFormalCadres);
        $validatedData['is_latinpel'] = in_array('latinpel', $nonFormalCadres);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename =
                'photo_' .
                strtolower(str_replace(' ', '-', $request->name)) .
                '_' .
                now()->timestamp .
                '.' .
                $file->getClientOriginalExtension();
            $path = 'images/members/' . strtolower(str_replace(' ', '-', $user->pac->pac)) . '/photo/';
            $file->storeAs('public/' . $path, $filename);

            $validatedData['photo'] = $filename;
        } else {
            $validatedData['photo'] = 'default.png';
        }

        Member::create($validatedData);

        Alert::success('Penambahan Anggota Berhasil');

        return redirect()->route('dashboard.members.index');
    }

    public function show($id, Request $request)
    {
        $member = Member::findOrFail($id);

        //        $detailUser = [
        //            'Nama Lengkap' => $member->name,
        //            'NIM' => $member->nim,
        //            'Alamat' =>
        //                ($provinsi->name ?? '') .
        //                ', ' .
        //                ($city->name ?? '') .
        //                ', ' .
        //                ($district->name ?? '') .
        //                ', ' .
        //                ($village->name ?? '') .
        //                ',' .
        //                ($member->address ?? ''),
        //            'Pesantren' => $member->boarding_school,
        //            'Tempat, Tanggal Lahir' => $member->place_of_birth . ', ' . $member->date_of_birth,
        //            'SMA/SMK/MA/Sederajat' => $member->highschool,
        //            'Tahun Lulus' => $member->grad_year,
        //            'Tahun Kuliah' => $member->bachelor_year,
        //            'PAC' => $member->pac->pac,
        //            'Tahun Makesta' => $member->makesta_year,
        //            'Tahun Lakmud' => $member->lakmud_year,
        //            'Tahun Lakut' => $member->lakut,
        //            'Tahun Latinpel' => $member->latinpel,
        //        ];

        return view('admins.members.detail', compact('member'));
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
            'photo' => 'required',
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

        if ($request->photo) {
            $extension = $request->photo->getClientOriginalExtension();
            $filename = 'profile' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('/uploads', $filename);
            $cadre['photo'] = $filename;
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
        $makestaCadres = User::whereIn('formal_cadre_levels', ['Makesta', 'Lakmud', 'Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.makesta', compact('makestaCadres'));
    }

    public function showLakmudCadres(Request $request)
    {
        $lakmudCadres = User::whereIn('formal_cadre_levels', ['Lakmud', 'Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.lakmud', compact('lakmudCadres'));
    }

    public function showLakutCadres(Request $request)
    {
        $lakutCadres = User::whereIn('formal_cadre_levels', ['Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.lakut', compact('lakutCadres'));
    }

    public function showLatinpelCadres(Request $request)
    {
        $latinpelCadres = User::where('formal_cadre_levels', 'Latinpel')
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
