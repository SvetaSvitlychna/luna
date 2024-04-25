<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use DB;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->user = \Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts=DB::table('posts')->orderBy('title','desc')->get();
        //$posts=DB::table('posts')->latest()->get();
        //$posts=DB::table('posts')->oldest()->get();
        //$posts=DB::table('posts')->where('id',">",10)->get();
        // $posts=DB::table('posts')->orderBy('id')->chunk(10, function($items){
        //     foreach ($items as $i) {
        //         dump($i);

        //     }

        // });
        $title = "Posts";
        $subtitle ="Posts management";
     $posts= Post::orderByRaw('id DESC')->paginate(15);;
     return view('admin.posts.index', compact('posts', 'title', 'subtitle'));
        //dump($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Posts";
        $subtitle = "Posts management";
        // $posts = Post::orderByRaw('id DESC')->paginate(15);
        $categories = Category::all()->pluck('name', 'id');
        $tags=Tag::all()->pluck('name','id');
        return view('admin.posts.create', compact('categories','tags', 'title', 'subtitle'));
        // return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $request->validate([
                'title'=>'unique:posts|max:191|min:3|required',
                'content'=>'required',
                'category_id'=>'required',
                'cover'=>'required'
            ]);
        $post= Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id'=>$request->category_id,
            'user_id'=>auth()->id(),
            'cover'=>$this->UploadImage($request->file("cover")),
            'created_at' => now()
        ]);
        $post->tags()->sync($request->input('tags',[]));


        return redirect(route('posts'))->withType('success')->withMessage('Created successfully');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {

        $title = "Posts";
        $subtitle = "Posts management";
        $categories = Category::all()->pluck('name', 'id');
//         $post->load('tags');
        $tags = Tag::all()->pluck('name', 'id');

        $post = Post::join('categories', 'categories.id', '=', 'posts.category_id')->
        join('post_tag', 'post_id', '=', 'posts.id')->
        join('tags', 'tag_id', '=', 'tags.id')->
        select('posts.*', 'categories.name AS categoryname',
        'tags.name AS tagname')->first($id);

        $post = Post::find($id);


        return view('admin.posts.show', compact('post','title', 'categories', 'tags'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
         $title = "Admin";
        $subtitle = "Add Post";
        $categories = Category::all()->pluck('name', 'id');
       $post = Post::find($id);
        $post->load('tags');
        $tags = Tag::all()->pluck('name', 'id');

        // return view('admin.posts.edit')
        //     ->withTitle($title)
        //     ->withSubtitle($subtitle)
        //     ->withCategories($categories)
        //     ->withTags($tags)
        //     ->withPost($post);

    return view('admin.posts.edit', compact('title','subtitle', 'categories','tags',
        'post'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        // $categories = Category::all()->pluck('name', 'id');
        // var_dump($request['title']);
        $request->validate([
            'title'=>'unique:posts|max:191|min:3|required',
            'content'=>'required',
            'category_id'=>'required',
            'cover'=>'required'
        ]);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,

            'created_at' => now()
        ];

        if($request->file("cover")) {
            Storage::delete("public/covers/blog/" . $post->cover);
            Storage::delete("public/covers/blog/thumbnail/" . $post->cover);
            $data += ["cover" => $this->uploadImage($request->file("cover"))];
        } else {
            $data += ["cover" => $post->cover];
        }
        $post->update($data);

        $id_t =$request->tag;
        $post->tags()->sync($request->input('tags', []));

        $post->tags()->attach($id_t);

        return redirect()->route('posts')->withType('success')->withMessage('Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return back()->withType('success')->withMessage('Moved to trash successfully');
    }
    public function trashed(){
        $title = "Post trashed list";
        $posts = Post::onlyTrashed()->paginate(10);
 $subtitle = "Menagement Trashed posts";
        return view('admin.posts.trashed', compact('title','subtitle', 'posts' ));
    }
    public function restore($id)
    {
        Post::withTrashed()->where('id',$id)->first()->restore();
        return back()->withType('success')->withMessage('Restored Successfully ');
    }
    public function force($id){
        Post::withTrashed()->where('id',$id)->first()->forceDelete();
        return back()->withType('success')->withMessage('Deleted successfully');
    }
     public function UploadImage(UploadedFile $file) :string{
        $img = Image::make($file);
        // $filename = time() . "." .$file->getClientOriginalName();
        $filename = $file->getClientOriginalName();
        $filePath = 'app/public/cover/blog';
        $img ->resize(520, 250, function ($constraint){
            $constraint->aspectRatio();
        })->save(storage_path($filePath)."/".$filename);


              $img->resize(250, 125, function ($constraint) {
                  $constraint->aspectRatio();
              })->save(storage_path($filePath) . "/thumbnail/" . $filename);
        return $filename;

     }
    // public function uploadImage(UploadedFile $file): string
    // {

    //     $img = Image::make($file);
    //     $filename = time() . "." . $file->getClientOriginalName();
    //     // $file->getClientOriginalExtension();
    //     $originalPath = 'app/public/cover/blog';

    //     $img->resize(520, 250, function ($constraint) {
    //         $constraint->aspectRatio();
    //     })->save(storage_path($originalPath) . "/" . $filename);

    //     $img->resize(250, 125, function ($constraint) {
    //         $constraint->aspectRatio();
    //     })->save(storage_path($originalPath) . "/thumbnail/" . $filename);

    //     return $filename;
    // }
}
