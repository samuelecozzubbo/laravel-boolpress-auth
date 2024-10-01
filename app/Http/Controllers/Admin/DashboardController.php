<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $count_posts = Post::where('user_id', Auth::id())->count();
        return view('admin.dashboard', compact('count_posts'));
    }
}
