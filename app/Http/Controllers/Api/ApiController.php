<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ApiController extends Controller
{
    public function post()
    {
        $data_post = Post::with(['categories', 'users:id,name,images'])
            ->where('active', '1')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Add base URL to 'images' on each image
        foreach ($data_post as $post) {
            $post->img = 'https://pmiiuninus.com/storage/images/' . $post->img;
        }

        return response()->json([
            'data' => $data_post
        ]);
    }

    public function show($slug)
    {
        $show_post = Post::where('slug', $slug)
            ->with(['categories', 'comments', 'users:id,name,images'])
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->firstOrFail();

        // Add base URL to 'image'
        $show_post->img = 'https://pmiiuninus.com/storage/images/' . $show_post->img;
        $show_post->user->img = 'https://pmiiuninus.com/storage/images/' . $show_post->user->img;

        return response()->json([
            'data' => $show_post
        ]);
    }
}
