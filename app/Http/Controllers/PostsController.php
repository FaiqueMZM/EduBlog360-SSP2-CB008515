<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index')
        ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }

    public function myblog(){
        return view('blog.myblog')->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }

    public function blogrequest(){
        return view('blog.indexmoderator')->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => '0',
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/blog')
            ->with('message', '  Your post has been added!');
    }

    /**
     * 
     *
     * @param  string  
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show')
            ->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * 
     *
     * @param  string  
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('blog.edit')
            ->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  
     * @param  string  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Post::where('slug', $slug)
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'status' => '0',
                'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
                'user_id' => auth()->user()->id
            ]);

        return redirect('/blog')
            ->with('message', '  Your post has been updated!');
    }

    public function updateStatus($id)
    {
        $blog = Post::where('id', '=', $id)->first();
        
        $blog->status = '1';
        $blog->save();

        return redirect('/blog')
            ->with('message', '  Post has been published!');
    }

    public function rejectBlog($id)
    {
        $blog = Post::where('id', '=', $id)->first();
        
        $blog->status = '0';
        $blog->save();

        return redirect('/blog')
            ->with('message', '  Post has been rejected!');
    }

    /**
     * 
     *
     * @param  int  
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();

        return redirect('/blog')
            ->with('message', '  Your post has been deleted!');
    }
}

