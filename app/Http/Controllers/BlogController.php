<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Post;

class BlogController extends Controller
{

    public function index(){
//        $title = "Blog page";
//       $posts= Post::with('category')
//       ->with('user')
//       ->get();
    //    ->join('categories','categories.id', '=', 'posts.category_id')
    //    ->join('users', 'users.id', '=', 'posts.user_id')
    //    ->select('posts.*', 'categories.name AS categoryname','users.name AS username')->get();

//       return view('blog.index', compact('title','posts'));
return view('blog.index');
    }

    // public function postsByUser($id)
    // {
    //     $title = "Blog page";
    //     $posts = Post::where('user_id', $id)
    //         ->with('category')
    //         ->with('user')
    //         ->get();
    //     //    ->join('categories','categories.id', '=', 'posts.category_id')
    //     //    ->join('users', 'users.id', '=', 'posts.user_id')
    //     //    ->select('posts.*', 'categories.name AS categoryname','users.name AS username')->get();

    //     return view('blog.index', compact('title', 'posts'));

    // }
    public function postsByUser($id)
    {

        $title = "Blog page";
        $posts = Post::where('user_id', $id)
            ->with('category')
            ->with('user')
            ->get();

        return view('blog.index', compact('title', 'posts'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($slug)
    {
         $title = "Blog POst";
         if (is_numeric($slug)){
            $post = Post::findOrFail($slug);
            return redirect (route('blog.show', $post->slug),301);
         }

    //    $post= DB::table('posts')->join('categories','categories.id', '=', 'posts.category_id')
    //    ->join('users', 'users.id', '=', 'posts.user_id')
    //    ->select('posts.*', 'categories.name AS categoryname','users.name AS username')->
    //    where('posts.id', $id)->first();

    $post = Post::whereSlug($slug)
    ->with('user')
    ->with('category')
    ->firstOrFail();

       return view('blog.show', compact('title','post'));

    }
 public function resent()
    {
        return "Resent";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function like($id){
        $post = Post::where('id',$id)->increment('votes');
        return back();

    }
    public function postByCategory($id){
        $title ="fgsdf";
        $posts = Post::where('category_id',$id)
        ->with('user')
        ->with('category')
        ->get();
        return view('blog.index', compact('posts', 'title'));

    }
}
