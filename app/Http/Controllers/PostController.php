<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index')->with([
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create')->with([
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
        if($request->validated()){
            $data = $request->except('_token');
            $file = $request->file('photo');
            $image_name = time().'_'.'photo'.'_'.$file->getClientOriginalName();
            $file->move('uploads', $image_name);
            $data['photo'] = 'uploads/'.$image_name;
            $data['slug'] = Str::slug($request->title_en);
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $post = Post::create($data);
            $post->tags()->sync($request->tags);
            return redirect()->route('posts.index')->with([
                'success' => 'Post added successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        $next = Post::where('id', '>', $post->id )->orderBy('id')->first();
        $previous = Post::where('id', '<', $post->id )->orderBy('id', 'desc')->first();
        return view('posts.show')->with([
            'post' => $post,
            'next' => $next,
            'previous' => $previous
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('admin.posts.edit')->with([
            'tags' => Tag::all(),
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        if($request->validated()){
            $data = $request->except('_token');
            if($request->has('photo')){
                if(File::exists($post->photo)){
                    File::delete($post->photo);
                }
                $file = $request->file('photo');
                $image_name = time().'_'.'photo'.'_'.$file->getClientOriginalName();
                $file->move('uploads', $image_name);
                $data['photo'] = 'uploads/'.$image_name;
            }
            $data['slug'] = Str::slug($request->title_en);
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $post->update($data);
            $post->tags()->sync($request->tags);
            return redirect()->route('posts.index')->with([
                'success' => 'Post updated successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        if(File::exists($post->photo)){
            File::delete($post->photo);
        }
        $post->delete();
        return redirect()->route('posts.index')->with([
            'success' => 'Post deleted successfully'
        ]);
    }

    public function togglePublished(Post $post){
        $post->update([
            'published' => $post->published ? 0 : 1
        ]);
        return redirect()->route('posts.index')->with([
            'success' => 'Post updated successfully'
        ]);
    }

    public function togglePremium(Post $post){
        $post->update([
            'premium' => $post->premium ? 0 : 1
        ]);
        return redirect()->route('posts.index')->with([
            'success' => 'Post updated successfully'
        ]);
    }
}
