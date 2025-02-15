<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tag;
use App\Models\News;
use App\Models\User;
use App\Models\Library;
use App\Models\Category;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index()
    {
        $profile = Auth::user();

        $news = News::where('user_id', '=', $profile->id)
            ->with('category', 'comments', 'user')
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count the number of picture and book news uploaded by users
        $postCounts = News::where('user_id', '=', $profile->id)
            ->where('active', 1)
            ->count();

        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $user = Auth::user();

        return view('users.profile', compact('tags', 'user', 'profile', 'postCounts', 'categories', 'news'));
    }

    public function showAccount()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $user = Auth::user();

        $genders = [
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
        ];

        return view('users.account', compact('user', 'categories', 'tags', 'genders'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:500',
            'date_of_birth' => 'required|date',
            'highschool' => 'required|string|max:255',
            'grad_year' => 'required|integer|min:1900|max:' . date('Y'),
            'bachelor_year' => 'required|integer|min:1900|max:' . date('Y'),
            'bio' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->fill(
            $request->only([
                'address',
                'phone',
                'x',
                'fb',
                'ig',
                'gender',
                'bio',
                'place_of_birth',
                'date_of_birth',
                'highschool',
                'grad_year',
                'bachelor_year',
            ]),
        );

        if ($request->input('remove_img') == '1') {
            $user->img = 'default.png';
        } elseif ($request->hasFile('img')) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'profile_' . $user->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->move(public_path('/storage/images'), $newFileName);
            $user->img = $newFileName;
        }

        $user->save();

        Alert::success('Mantap Sahabat', 'Profil Anda Sudah Diperbaharui');

        return redirect()
            ->route('profile')
            ->with('users', $user);
    }

    public function showUploads(Request $request)
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $user = Auth::user();

        $postCounts = News::where('user_id', $user->id)
            ->where('active', 1)
            ->count();

        $category = BookCategory::all();

        return view('users.uploads', compact('user', 'tags', 'category', 'postCounts', 'categories'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'reenter_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->input('current_password'), $user->password)) {
            return redirect()
                ->back()
                ->withErrors([
                    'current_password' => 'Kata sandi yang diberikan tidak cocok dengan kata sandi Anda saat ini.',
                ]);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()
            ->back()
            ->with('Mantap Sahabat', 'Password Berhasil Diubah.');
    }

    public function storePost(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'news' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->move(public_path('/storage/images'), $newFileName);
            $data['image'] = $newFileName;
        }

        $post = News::create($data);
        $post->tags()->sync($request->tags);

        Alert::success('Mantap Sahabat', 'Postingan akan ditinjau terlebih dahulu oleh admins');

        return redirect()->route('profile');
    }

    public function storeLibrary(Request $request)
    {
        $library = $request->all();
        $library['user_id'] = Auth::user()->id;

        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'libraries' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->move(public_path('/storage/images'), $newFileName);
            $library['image'] = $newFileName;
        }

        if ($request->pdf) {
            $extension = $request->pdf->getClientOriginalExtension();
            $newFileName = 'libraries' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('pdf')->move(public_path('/storage/pdf'), $newFileName);
            $library['pdf'] = $newFileName;
        }

        Library::create($library);

        Alert::success('Mantap Sahabat', 'File Berhasil Ditambahkan');

        return redirect()->route('profile');
    }

    public function showDetail($id, Request $request)
    {
        $user = User::findOrFail($id);
        $province = Province::find($user->province_id);
        $city = City::find($user->city_id);
        $district = District::find($user->district_id);
        $village = Village::find($user->village_id);

        $detailUser = [
            'Nama Lengkap' => $user->name,
            'NIM' => $user->nim,
            'Alamat' =>
                ($provinsi->name ?? '') .
                ', ' .
                ($city->name ?? '') .
                ', ' .
                ($district->name ?? '') .
                ', ' .
                ($village->name ?? '') .
                ',' .
                ($user->address ?? ''),
            'Pesantren' => $user->boarding_school,
            'Tempat, Tanggal Lahir' => $user->place_of_birth . ', ' . $user->date_of_birth,
            'SMA/SMK/MA/Sederajat' => $user->highschool,
            'Tahun Lulus' => $user->grad_year,
            'Tahun Kuliah' => $user->bachelor_year,
            'PAC' => $user->pac->pac,
            'Tahun Makesta' => $user->makesta_year,
            'Tahun Lakmud' => $user->lakmud_year,
            'Tahun Lakut' => $user->lakut,
            'Tahun Latinpel' => $user->latinpel,
        ];

        return view('admins.users.detail', compact('user', 'detailUser', 'province', 'city', 'district', 'village'));
    }

    public function show($slug, Request $request)
    {
        $user = Auth::user();
        $profile = User::where('slug', $slug)->firstOrFail();

        $news = News::where('user_id', '=', $profile->id)
            ->with('category', 'comments', 'user')
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        //        $libraryProfiles = Library::where('user_id', $profile->id)->get();

        $postCounts = News::where('user_id', '=', $profile->id)
            ->where('active', 1)
            ->count();

        //        $libraryCounts = Library::where('user_id', '=', $profile->id)->count();

        return view('users.user-profile', compact('user', 'profile', 'postCounts', 'news'));
    }
}
