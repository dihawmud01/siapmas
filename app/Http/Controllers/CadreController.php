<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CadreController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $cadres = Cadre::Where('name', 'LIKE', '%' . $request->search . '%')
                ->orwhere('gender', 'LIKE', '%' . $request->search . '%')
                ->get();
        } else {
            $cadres = Cadre::latest()->get();
        }

        return view('admins.cadres.index', compact(['cadres']));
    }

    public function showStatistic(Request $request)
    {
        $statistic = Cadre::all();

        return view('admins.index', compact(['statistic']));
    }

    public function create()
    {
        $genders = [
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
        ];

        $hobbies = [
            'Bermain Game' => 'Bermain Game Online',
            'Bermusik' => 'Bermusik: Mendengarkan, Bermain, atau Bernyanyi',
            'Olahraga' => 'Berolahraga: Basket, Sepak Bola, atau Lainnya',
            'Travelling' => 'Travelling: Jalan-jalan, Touring, Mendaki Gunung, atau Pergi ke Pantai',
            'Membaca' => 'Membaca: Buku, Novel, Al-Quran, atau Lainnya',
            'Seni dan kreativitas' =>
                'Seni dan Kreativitas: Melukis, Menggambar, Fotografi, Membuat Konten, atau Lainnya',
            'Menonton film dan serial TV' => 'Menonton: Film, Drakor, Anime, atau Serial TV',
        ];

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
            '0' => 'Belum Pernah',
            '1' => 'Pernah 1 kali',
            '2' => 'Pernah 2 Kali',
            '3' => 'Pernah 3 Kali',
            '4' => 'Pernah 4 Kali',
            '5' => 'Pernah 5 Kali',
            '6' => 'Pernah 6 Kali',
            '7' => 'Pernah 7 Kali',
            '8' => 'Pernah 8 Kali',
            '9' => 'Pernah 9 Kali',
            '10' => 'Lebih dari 9 Kali',
        ];

        return view('admins.cadres.create', compact('genders', 'hobbies', 'pacList', 'attendanceCount', 'years'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'nim' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'wa' => 'required',
            'highschool' => 'required',
            'grad_year' => 'required',
            'boarding_school' => 'required',
            'college_year' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'makesta_year' => 'required',
            'organizer_makesta' => 'required',
            'lakmud_year' => 'required',
            'lakut_year' => 'required',
            'latinpel_year' => 'required',
            'informal' => 'required',
            'organizer_informal' => 'required',
            'nonformal' => 'required',
            'organizer_nonformal' => 'required',
            'photo' => 'required',
            'simtimes|image:gif,png,jpg,jpeg',
        ]);

        $cadre = new Cadre();
        $cadre->name = $request->name;
        $cadre->address = $request->address;
        $cadre->nim = $request->nim;
        $cadre->gender = $request->gender;
        $cadre->place_of_birth = $request->place_of_birth;
        $cadre->date_of_birth = $request->date_of_birth;
        $cadre->wa = $request->wa;
        $cadre->highschool = $request->highschool;
        $cadre->grad_year = $request->grad_year;
        $cadre->boarding_school = $request->boarding_school;
        $cadre->college_year = $request->college_year;
        $cadre->fakultas = $request->fakultas;
        $cadre->jurusan = $request->jurusan;
        $cadre->makesta_year = $request->makesta_year;
        $cadre->organizer_makesta = $request->organizer_makesta;
        $cadre->lakmud_year = $request->lakmud_year;
        $cadre->lakut_year = $request->lakut_year;
        $cadre->latinpel_year = $request->latinpel_year;
        $cadre->informal = $request->informal;
        $cadre->organizer_informal = $request->organizer_informal;
        $cadre->nonformal = $request->nonformal;
        $cadre->organizer_nonformal = $request->organizer_nonformal;

        $cadre->save();

        if ($request->photo) {
            $extension = $request->photo->getClientOriginalExtension();
            $newFileName = 'profile' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('/uploads', $newFileName);
            $cadre['photo'] = $newFileName;
            $cadre->save();
        }

        return redirect()->route('cadres.index');
    }

    public function edit($id)
    {
        $cadre = Cadre::find($id);
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

        $cadre = Cadre::find($id);

        $cadre->name = $request->name;
        $cadre->address = $request->address;
        $cadre->nim = $request->nim;
        $cadre->gender = $request->gender;
        $cadre->place_of_birth = $request->place_of_birth;
        $cadre->date_of_birth = $request->date_of_birth;
        $cadre->wa = $request->wa;
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
            $newFileName = 'profile' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('/uploads', $newFileName);
            $cadre['photo'] = $newFileName;
            $cadre->update();
        }

        return redirect()->route('cadres.index');
    }

    public function destroy($id)
    {
        $cadre = Cadre::findOrFail($id);
        $cadre->delete();

        return redirect()->route('cadres.index');
    }

    public function viewCadre($id)
    {
        $cadre = Cadre::find($id);
        $user = User::find($id);

        return view('admins.cadres.view', compact(['cadre', 'user']));
    }
}
