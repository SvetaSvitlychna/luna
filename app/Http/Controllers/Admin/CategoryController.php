<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, User,Profile};
use App\Models\Post;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="Categories page";
        $subtitle = "management category";
    //  $categories=DB::table('categories')->get();
    $categories = Category::orderByRaw('id DESC')->paginate(15);
    //  dd(DB::table('categories')->pluck('id'));
    return view('admin.categories.index',compact('categories', 'title', 'subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Category";
$subtitle = 'category management';
        // dd($_POST);
    //     DB::table('categories')->insert(['name'=>$request['name'],
    //    'description'=>$request['description'],
    //    'created_at'=>now()]);
    //    return redirect(url('admin.categories'));
       return view('admin.categories.create',compact('title', 'subtitle') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
$validator = Validator::make($request->all(), [
    'name'=>'unique:categories|max:20|min:8|required',
    'description'=>'nullable|string',
]);
if($validator->fails()){
    return redirect('admin/categories/create')->withErrors($validator)->withInput();
}


        DB::table('categories')->insert(['name'=>$request['name'],
       'description'=>$request['description'],
       'created_at'=>now()]);

    //    return redirect()->route('categories');
    return redirect(route('categories'))->withMessage('Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {

$title = "Category show";
$subtitle = 'category management';
         $category = DB::table('categories')->find($id);

        return view('admin.categories.show', compact('category','title', 'subtitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   $title = "Category";
$subtitle = 'category management';
$category = DB::table('categories')->find($id);
       return view('admin.categories.edit', compact('category','title', 'subtitle')->withMessage('Edit successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
            $data =[
                'name' => $request->name,
                'description' => $request->description,
                'status'=>($request->status =='on')?1:0,
                ];
                // dd($data);
                $category->update($data);
       return redirect(route('categories', compact ('request','category')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $category = Category::find($id);
        $category->delete();
        // dd($category);
        return back();
    }
       public function trashed(){
        $title = "Admin";
        $subtitle = "Menagement Trashed categories";
        $categories = Category::onlyTrashed()-> paginate(5);
        return view('admin.categories.trashed', compact('categories',
        'title', 'subtitle'));

    }
    public function restore($id){

         Category::withTrashed()->where('id', $id)->first()->restore();
        return back();

    }
    public function force($id){

        Category::withTrashed()
        ->where('id', $id)
        ->first()
        ->forceDelete();
       return back();

   }
}
