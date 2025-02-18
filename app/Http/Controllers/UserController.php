<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\PAC;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userCounts = User::count();
        if ($request->has('search')) {
            $user = User::where('username', 'LIKE', '%' . $request->search . '%')
                ->orwhere('name', 'LIKE', '%' . $request->search . '%')
                ->orwhere('nim', 'LIKE', '%' . $request->search . '%')
                ->paginate(25);
        } else {
            $user = User::with('pac')
                ->latest()
                ->paginate(25);
        }

        $firstItem = $user instanceof \Illuminate\Pagination\LengthAwarePaginator ? $user->firstItem() : $user->first();

        return view('admins.users.index', compact('user', 'userCounts', 'firstItem'));
    }

    public function showList($slug, Request $request)
    {
        $pac = PAC::where('slug', $slug)
            ->with('users')
            ->latest()
            ->paginate(25);

        if ($request->has('search')) {
            $user = User::Where('username', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                ->get();
        } else {
            $user = User::with('pac')
                ->latest()
                ->paginate(25);
            $userCounts = User::count();
        }

        return view('admins.pac.show', compact('pac', 'user', 'userCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth();

        $province = Province::all()
            ->sortBy('name')
            ->pluck('name', 'id');

        $pacList = [
            'BATURRADEN',
            'CILONGOK',
            'KEDUNGBANTENG',
            'KARANGLEWAS',
            'PURWOJATI',
            'PURWOKERTO BARAT',
            'PURWOKERTO TIMUR',
            'PURWOKERTO UTARA',
            'PURWOKERTO SELATAN',
            'SUMBANG',
            'SOKARAJA',
            'KEMBARAN',
            'TAMBAK',
            'SOMAGEDE',
            'BANYUMAS',
            'KEMRANJEN',
            'GUMELAR',
            'AJIBARANG',
            'PEKUNCEN',
            'WANGON',
            'RAWALO',
            'JATILAWANG',
            'KEBASEN',
            'PATIKRAJA',
            'KALIBAGOR',
            'LUMBIR',
            'SUMPIUH',
            'KOMISARIAT UNU PURWOKERTO',
            'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];

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

        $cadreLevels = ['Belum Makesta', 'Makesta', 'Lakmud', 'Lakut', 'Latinpel'];

        $genders = [
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
        ];

        return view(
            'admins.users.create',
            compact('province', 'user', 'pacList', 'cadreLevels', 'years', 'attendanceCount', 'genders'),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'nim' => 'required|min:14|unique:users,nim|numeric',
            'address' => 'required',
            'place_of_birth' => 'required',
            'gender' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'gender.required' => 'Jenis Kelamin wajib diisi.',
            'name.alpha' => 'Nama Harus Huruf doang Tolol!!!',
            'nim.required' => 'Nim wajib diisi.',
            'nim.unique' => 'Nim sudah digunakan.',
            'nim.min' => 'Nim kurang anjing minimal 14 Angka goblok.',
            'nim.numeric' => 'Nim Harus Angka Anjing!!!',
            'address.required' => 'Alamatnya di isi dong bodo.',
            'place_of_birth.required' => 'Tulis nama kota kelahirnya. TOLOL!!!.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $request = User::create($request->all());

        Alert::success('Mantap Sahabat', 'Cadre Berhasil Ditambahkan');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, User $user)
    {
        $user = User::find($id);
        $role = Role::find($user->role_id);
        $pac = PAC::find($user->pac_id);
        $province = Province::all()
            ->sortBy('name')
            ->pluck('name', 'id');

        $pacList = [
            'BATURRADEN',
            'CILONGOK',
            'KEDUNGBANTENG',
            'KARANGLEWAS',
            'PURWOJATI',
            'PURWOKERTO BARAT',
            'PURWOKERTO TIMUR',
            'PURWOKERTO UTARA',
            'PURWOKERTO SELATAN',
            'SUMBANG',
            'SOKARAJA',
            'KEMBARAN',
            'TAMBAK',
            'SOMAGEDE',
            'BANYUMAS',
            'KEMRANJEN',
            'GUMELAR',
            'AJIBARANG',
            'PEKUNCEN',
            'WANGON',
            'RAWALO',
            'JATILAWANG',
            'KEBASEN',
            'PATIKRAJA',
            'KALIBAGOR',
            'LUMBIR',
            'SUMPIUH',
            'KOMISARIAT UNU PURWOKERTO',
            'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];
        $roles = ['Kader PC IPNU IPPNU Banyumas', 'Pengjunjung', 'Bukan Kader PC IPPNU Banyumas'];
        $cadreLevels = ['Belum Makesta', 'Makesta', 'Lakmud', 'Lakut', 'Latinpel'];

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
        $genders = [
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
        ];

        return view(
            'admins.users.edit',
            compact('user', 'role', 'roles', 'pac', 'pacList', 'province', 'genders', 'years', 'cadreLevels'),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $userToUpdate = User::findOrFail($id);

        $userData = $request->all();
        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'users' . '_' . $request->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('images')->move(public_path('/storage/images'), $newFileName);
            $userData['images'] = $newFileName;
        }

        $userToUpdate->update($userData);

        Alert::success('Mantap Sahabat', 'User Berhasil Di Update');
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function showAdmins(Request $request)
    {
        $admins = User::whereIn('role_id', [1, 2])
            ->latest()
            ->paginate(10);
        return view('admins.admins.index', compact('admins'));
    }

    public function showMakestaCadres(Request $request)
    {
        $makestaCadres = User::whereIn('cadre_level', ['Makesta', 'Lakmud', 'Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.makesta', compact('makestaCadres'));
    }

    public function showLakmudCadres(Request $request)
    {
        $lakmudCadres = User::whereIn('cadre_level', ['Lakmud', 'Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.lakmud', compact('lakmudCadres'));
    }

    public function showLakutCadres(Request $request)
    {
        $lakutCadres = User::whereIn('cadre_level', ['Lakut', 'Latinpel'])
            ->latest()
            ->paginate(10);

        return view('admins.users.lakut', compact('lakutCadres'));
    }

    public function showLatinpelCadres(Request $request)
    {
        $latinpelCadres = User::where('cadre_level', 'Latinpel')
            ->latest()
            ->paginate(10);
        return view('admins.users.latinpel', compact('latinpelCadres'));
    }

    public function showUnverification(Request $request)
    {
        $unverification = User::where('role_id', 4)->paginate(10);
        return view('admins.users.unverification', compact('unverification'));
    }

    public function showNoncadres(Request $request)
    {
        $noncadres = User::where('role_id', 5)->paginate(10);
        return view('admins.users.noncadres', compact('noncadres'));
    }
}
