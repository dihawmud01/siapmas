<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdministratorController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $administrators = Administrator::all();
        return view('users.administrators', compact('user', 'administrators'));
    }

    public function index(Request $request)
    {
        $administrators = Administrator::latest()->get();
        return view('admins.administrators.index', compact('administrators'));
    }

    public function create()
    {
        return view('admins.administrators.create');
    }

    public function store(Request $request)
    {
        $administrators = $request->all();
        $request->file('images')->getClientOriginalExtension();
        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'administrators' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('images')->move(public_path('/storage/images'), $newFileName);
            $administrators['images'] = $newFileName;
        }

        $administrators = Administrator::create($administrators);

        Alert::success('Mantap Sahabat', 'Administrator Berhasil Ditambahkan');

        return redirect()->route('administrators.index');
    }

    public function edit($id, Request $request)
    {
        $administrator = Administrator::find($id);

        return view('admins.administrators.edit', compact('administrator'));
    }

    public function update($id, Request $request)
    {
        $administratorToUpdate = Administrator::findOrFail($id);

        $administratorData = $request->all();
        if ($request->img) {
            $extension = $request->img->getClientOriginalExtension();
            $newFileName = 'administrator_update' . '_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('images')->move(public_path('/storage/images'), $newFileName);
            $administratorData['images'] = $newFileName;
        }

        $administratorToUpdate->update($administratorData);

        Alert::success('Mantap Sahabat', 'administrators Berhasil Di Ubah');

        return redirect()->route('administrators.index');
    }

    public function destroy($id)
    {
        $administrator = Administrator::findOrFail($id);
        $administrator->delete();

        Alert::success('Mantap Sahabat', 'Administrator Berhasil Dihapus');

        return redirect()->route('administrators.index');
    }
}
