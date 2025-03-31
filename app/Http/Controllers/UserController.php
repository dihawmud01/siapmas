<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\PAC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $userCounts = User::count();
        if ($request->has('search')) {
            $user = User::where('username', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                ->paginate(25);
        } else {
            $user = User::with('pac')->latest()->paginate(25);
        }

        $firstItem = $user instanceof \Illuminate\Pagination\LengthAwarePaginator ? $user->firstItem() : $user->first();

        return view('admins.admins.index', [
            'admins' => $user,
            'userCounts' => $userCounts,
            'firstItem' => $firstItem
        ]);
    }

    public function create()
    {
        $roles = Role::whereIn('id', [1, 2, 3])->get();
        $pacList = PAC::all();
        
        return view('admins.admins.create', compact('roles', 'pacList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer',
            'pac_id' => 'nullable|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['bio'] = $request->input('bio', '');

        $user = User::create($validatedData);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            
            $destinationPath = public_path("storage/images/user/photos/{$user->id}");
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $photo->move($destinationPath, $filename);
            
            $user->update(['photo' => $filename]);
        } else {
            $user->update(['photo' => 'default.png']);
        }

        Alert::success('Success', 'User berhasil ditambahkan');
        return redirect()->route('dashboard.admins.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::whereIn('id', [1, 2, 3])->get();
        $pacList = PAC::all();
        
        return view('admins.admins.edit', compact('user', 'roles', 'pacList'));
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|integer',
            'pac_id' => 'nullable|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            
            $destinationPath = public_path("storage/images/user/photos/{$user->id}");
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $photo->move($destinationPath, $filename);
            
            if ($user->photo && $user->photo !== 'default.png') {
                $oldPhotoPath = public_path("storage/images/user/photos/{$user->id}/{$user->photo}");
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
            
            $validatedData['photo'] = $filename;
        }
        
        $user->update($validatedData);
        
        Alert::success('Success', 'User berhasil diperbarui');
        return redirect()->route('dashboard.admins.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admins.admins.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus foto jika bukan default.png
        if ($user->photo && $user->photo !== 'default.png') {
            $photoPath = public_path("storage/images/user/photos/{$user->id}/{$user->photo}");
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }

            // Hapus folder jika kosong
            $photoDir = public_path("storage/images/user/photos/{$user->id}");
            if (is_dir($photoDir) && count(scandir($photoDir)) == 2) { // Hanya ada . dan ..
                rmdir($photoDir);
            }
        }

        $user->delete();

        Alert::success('Success', 'User dan foto berhasil dihapus');
        return redirect()->route('dashboard.admins.index');
    }


    public function showAdmins(Request $request)
    {
        $search = $request->input('search');

        $admins = User::whereIn('role_id', [1, 2, 3])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(20);

        return view('admins.admins.index', compact('admins'));
    }
}