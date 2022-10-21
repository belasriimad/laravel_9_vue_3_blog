<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $posts = Post::published()->simple()->latest()->paginate(10);
        $postsPremium = Post::published()->premium()->latest()->get();
        return view('home')->with([
            'posts' => $posts,
            'postsPremium' => $postsPremium
        ]);
    }

    public function postsByCategory(Category $category){
        return view('home')->with([
            'posts' => $category->posts()->paginate(10),
            'category' => $category,
        ]);
    }

    public function postsByTag(Tag $tag){
        return view('home')->with([
            'posts' => $tag->posts()->paginate(10),
            'tag' => $tag
        ]);
    }

    public function changeLang($lang){
        session()->forget('lang');
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function searchByTerm(Request $request){
        $posts = Post::orderBy('created_at','desc')
                    ->where('title_en', 'like', '%'.$request->term.'%')
                    ->orWhere('title_fr', 'like', '%'.$request->term.'%')
                    ->published()->get();
        return response()->json($posts);
    }
}