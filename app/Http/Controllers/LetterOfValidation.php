<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Letter;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterOfValidation extends Controller
{
    public function index(Request $request): View
    {
        return view('admins.letters.sp.index', [
            'data' => Letter::incoming()->render($request->search),
            'search' => $request->search,
        ]);
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $user = Auth::user();

        $genders = [
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
        ];

        return view('admins.letters.sp.create', compact('user', 'categories', 'tags', 'genders'));
    }
}
