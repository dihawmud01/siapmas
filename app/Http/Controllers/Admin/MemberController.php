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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Member::search($request->search)->orderBy('name', 'asc');

        if ($user->role_id == 3) {
            $query->where('pac_id', $user->pac_id);
        }

        $totalMembers = $query->count();
        $members = $query->paginate(10);

        return view('admins.members.index', compact('members', 'totalMembers'));
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
        $pacList = [
            1 => 'BATURRADEN',
            2 => 'CILONGOK',
            3 => 'KEDUNGBANTENG',
            4 => 'KARANGLEWAS',
            5 => 'PURWOJATI',
            6 => 'PURWOKERTO BARAT',
            7 => 'PURWOKERTO TIMUR',
            8 => 'PURWOKERTO UTARA',
            9 => 'PURWOKERTO SELATAN',
            10 => 'SUMBANG',
            11 => 'SOKARAJA',
            12 => 'KEMBARAN',
            13 => 'TAMBAK',
            14 => 'SOMAGEDE',
            15 => 'BANYUMAS',
            16 => 'KEMRANJEN',
            17 => 'GUMELAR',
            18 => 'AJIBARANG',
            19 => 'PEKUNCEN',
            20 => 'WANGON',
            21 => 'RAWALO',
            22 => 'JATILAWANG',
            23 => 'KEBASEN',
            24 => 'PATIKRAJA',
            25 => 'KALIBAGOR',
            26 => 'LUMBIR',
            27 => 'SUMPIUH',
            28 => 'KOMISARIAT UNU PURWOKERTO',
            29 => 'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];
        $formalCadreLevels = ['makesta', 'lakmud', 'lakut'];
        $nonFormalCadreLevels = ['diklatama', 'diklatnas', 'diklatmad', 'latinpel'];

        $genders = Gender::getLabels();
        $membershipStatus = MembershipStatus::getLabels();

        return view(
            'admins.members.create',
            compact(
                'user',
                'formalCadreLevels',
                'nonFormalCadreLevels',
                'years',
                'genders',
                'membershipStatus',
                'pacList',
            ),
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            array_merge(
                [
                    'name' => 'required|string|max:255',
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                    'gender' => 'required|string',
                    'place_of_birth' => 'required|string',
                    'date_of_birth' => 'required|date',
                    'address' => 'required|string',
                    'formal_cadre_levels' => 'nullable|array',
                    'formal_cadre_levels.*' => 'string|in:makesta,lakmud,lakut',
                    'non_formal_cadre_levels' => 'nullable|array',
                    'non_formal_cadre_levels.*' => 'string|in:diklatama,diklatmad,diklatnas,latinpel',
                    'makesta_year' => 'nullable|integer',
                    'lakmud_year' => 'nullable|integer',
                    'lakut_year' => 'nullable|integer',
                    'phone' => 'required|string|max:15',
                ],
                $request->user()->role_id == 3
                    ? []
                    : [
                        'pac_id' => 'required|integer',
                        'membership_status' => 'required|string',
                    ],
            ),
        );

        $validatedData['gender'] = Gender::tryFrom($request->gender);
        $user = Auth::user();

        $validatedData['pac_id'] = $user->role_id == 3 ? $user->pac_id : $request->pac_id;

        if ($user->role_id != 3) {
            $validatedData['membership_status'] = MembershipStatus::tryFrom($request->membership_status);
        }

        $formalCadres = collect($request->input('formal_cadre_levels', []));
        $validatedData['is_makesta'] = $formalCadres->contains('makesta');
        $validatedData['is_lakmud'] = $formalCadres->contains('lakmud');
        $validatedData['is_lakut'] = $formalCadres->contains('lakut');

        $nonFormalCadres = collect($request->input('non_formal_cadre_levels', []));
        $validatedData['is_diklatama'] = $nonFormalCadres->contains('diklatama');
        $validatedData['is_diklatnas'] = $nonFormalCadres->contains('diklatnas');
        $validatedData['is_diklatmad'] = $nonFormalCadres->contains('diklatmad');
        $validatedData['is_latinpel'] = $nonFormalCadres->contains('latinpel');

        if ($request->hasFile('photo')) {
            $pacSlug = Str::slug(PAC::where('id', $validatedData['pac_id'])->value('pac'));
            $path = "images/members/{$pacSlug}/photo/";

            $file = $request->file('photo');
            $filename = Str::slug($request->name) . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $filename, 'public');

            $validatedData['photo'] = $filename;
        } else {
            $validatedData['photo'] = 'default.png';
        }

        Member::create($validatedData);

        Alert::success('Anggota berhasil ditambahkan');

        return redirect()->route('dashboard.members.index');
    }

    public function show(Request $request, Member $member)
    {
        $detailMember = [
            'Nama Lengkap' => $member->name,
            'Jenis Kelamin' => $member->gender->label(),
            'Tempat, Tanggal Lahir' => $member->place_of_birth . ', ' . $member->formatted_date_of_birth,
            'Alamat' => $member->address,
            'PAC' => $member->pac->pac,
            'Tahun Makesta' => $member->makesta_year ?? '-',
            'Tahun Lakmud' => $member->lakmud_year ?? '-',
            'Tahun Lakut' => $member->lakut_year ?? '-',
            'No. HP' => $member->phone,
            'Status Keanggotaan' => $member->membership_status->label(),
        ];

        return view('admins.members.show', compact('member', 'detailMember'));
    }

    public function edit($id)
    {
        $member = Member::find($id);

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
        $pacList = [
            1 => 'BATURRADEN',
            2 => 'CILONGOK',
            3 => 'KEDUNGBANTENG',
            4 => 'KARANGLEWAS',
            5 => 'PURWOJATI',
            6 => 'PURWOKERTO BARAT',
            7 => 'PURWOKERTO TIMUR',
            8 => 'PURWOKERTO UTARA',
            9 => 'PURWOKERTO SELATAN',
            10 => 'SUMBANG',
            11 => 'SOKARAJA',
            12 => 'KEMBARAN',
            13 => 'TAMBAK',
            14 => 'SOMAGEDE',
            15 => 'BANYUMAS',
            16 => 'KEMRANJEN',
            17 => 'GUMELAR',
            18 => 'AJIBARANG',
            19 => 'PEKUNCEN',
            20 => 'WANGON',
            21 => 'RAWALO',
            22 => 'JATILAWANG',
            23 => 'KEBASEN',
            24 => 'PATIKRAJA',
            25 => 'KALIBAGOR',
            26 => 'LUMBIR',
            27 => 'SUMPIUH',
            28 => 'KOMISARIAT UNU PURWOKERTO',
            29 => 'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];

        $formalCadreLevelList = ['makesta', 'lakmud', 'lakut'];

        $formalCadreLevels = old(
            'formal_cadre_levels',
            array_filter([
                $member->is_makesta ? 'makesta' : null,
                $member->is_lakmud ? 'lakmud' : null,
                $member->is_lakut ? 'lakut' : null,
            ]),
        );

        $nonFormalCadreLevelList = ['diklatama', 'diklatnas', 'diklatmad', 'latinpel'];
        $nonFormalCadreLevels = old(
            'non_formal_cadre_levels',
            array_filter([
                $member->is_diklatama ? 'diklatama' : null,
                $member->is_diklatnas ? 'diklatnas' : null,
                $member->is_diklatmad ? 'diklatmad' : null,
                $member->is_latinpel ? 'latinpel' : null,
            ]),
        );

        $genders = Gender::getLabels();
        $membershipStatus = MembershipStatus::getLabels();

        return view(
            'admins.members.edit',
            compact(
                'member',
                'years',
                'pacList',
                'formalCadreLevelList',
                'formalCadreLevels',
                'nonFormalCadreLevelList',
                'nonFormalCadreLevels',
                'genders',
                'membershipStatus',
            ),
        );
    }

    public function update(Request $request, Member $member)
    {
        $validatedData = $request->validate(
            array_merge(
                [
                    'name' => 'required|string|max:255',
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                    'gender' => 'required|string',
                    'place_of_birth' => 'required|string',
                    'date_of_birth' => 'required|date',
                    'address' => 'required|string',
                    'formal_cadre_levels' => 'nullable|array',
                    'formal_cadre_levels.*' => 'string|in:makesta,lakmud,lakut',
                    'non_formal_cadre_levels' => 'nullable|array',
                    'non_formal_cadre_levels.*' => 'string|in:diklatama,diklatmad,diklatnas,latinpel',
                    'makesta_year' => 'nullable|integer',
                    'lakmud_year' => 'nullable|integer',
                    'lakut_year' => 'nullable|integer',
                    'phone' => 'required|string|max:15',
                ],
                $request->user()->role_id == 3
                    ? []
                    : [
                        'pac_id' => 'required|integer',
                        'membership_status' => 'required|string',
                    ],
            ),
        );

        $validatedData['gender'] = Gender::tryFrom($request->gender);
        $user = Auth::user();

        $validatedData['pac_id'] = $user->role_id == 3 ? $user->pac_id : $request->pac_id;

        if ($user->role_id != 3) {
            $validatedData['membership_status'] = MembershipStatus::tryFrom($request->membership_status);
        }

        $formalCadres = collect($request->input('formal_cadre_levels', []));
        $validatedData['is_makesta'] = $formalCadres->contains('makesta');
        $validatedData['makesta_year'] = $validatedData['is_makesta'] ? $validatedData['makesta_year'] : null;
        $validatedData['is_lakmud'] = $formalCadres->contains('lakmud');
        $validatedData['lakmud_year'] = $validatedData['is_lakmud'] ? $validatedData['lakmud_year'] : null;
        $validatedData['is_lakut'] = $formalCadres->contains('lakut');
        $validatedData['lakut_year'] = $validatedData['is_lakut'] ? $validatedData['lakut_year'] : null;

        $nonFormalCadres = collect($request->input('non_formal_cadre_levels', []));
        $validatedData['is_diklatama'] = $nonFormalCadres->contains('diklatama');
        $validatedData['is_diklatnas'] = $nonFormalCadres->contains('diklatnas');
        $validatedData['is_diklatmad'] = $nonFormalCadres->contains('diklatmad');
        $validatedData['is_latinpel'] = $nonFormalCadres->contains('latinpel');

        $pacSlug = Str::slug(PAC::where('id', $validatedData['pac_id'])->value('pac'));

        if ($request->hasFile('photo')) {
            $oldPhotoPath = 'images/members/' . Str::slug($member->pac->pac) . "/photo/{$member->photo}";

            if ($member->photo && $member->photo !== 'default.png' && Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }

            $file = $request->file('photo');
            $filename = Str::slug($request->name) . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $file->storeAs("images/members/{$pacSlug}/photo/", $filename, 'public');
            $validatedData['photo'] = $filename;
        }

        $member->update($validatedData);

        Alert::success('Update anggota berhasil');
        return redirect()->route('dashboard.members.index');
    }

    public function destroy(Member $member)
    {
        if ($member->photo && $member->photo !== 'default.png') {
            $pacSlug = strtolower(str_replace(' ', '-', optional($member->pac)->pac));
            $path = "images/members/{$pacSlug}/photo/{$member->photo}";

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $member->delete();

        Alert::success('Anggota berhasil dihapus');

        return redirect()->route('dashboard.members.index');
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

    public function showByPAC($slug, Request $request)
    {
        $user = Auth::user();

        $pacList = PAC::where('slug', $slug)
            ->with([
                'members' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                },
            ])
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

        return view('admins.pac.show', compact('pacList', 'user', 'members'));
    }
}
