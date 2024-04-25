<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $title= "ADmin";
        $subtitle="Management tags";
        $tags = Tag::paginate(15);

        return view ('admin.tags.index', compact('tags', 'title', 'subtitle'));
    }


    public function create()
    {
       $title= "admin";
       $subtitle = "management tags";

       return view('admin.tags.create', compact('title', 'subtitle'));


    }


    public function store(Request $request)
    {
        $title = "admin";
        $subtitle = "management tags";

        Tag::create(['name'=>$request->name]);

        return redirect(url('admin/tags'));

    }


    public function show($id)
    {
        $title = 'admin';
        $subtitle = 'management tags';
        $tag = Tag::find($id);
      return view('admin.tags.show', compact('tag', 'title', 'subtitle'));
    }


    public function edit($id)
    {
         $title = 'admin';
        $subtitle = 'management tags';
        $tag = Tag::find($id);
      return view('admin.tags.edit', compact('tag', 'title', 'subtitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = "admin";
        $subtitle = "management tags";
        // var_dump($request['name']);die;
        $tag = Tag::find($id);
        $tag->update(['name'=>$request->name]);

        return redirect(url('admin/tags'));
        // return redirect(route('tags', compact('request', 'tag')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function trashed (){
        $title = "Tags trashed list";
        $tags = Tag::onlyTrashed()->paginate(10);
        $subtitle ="Management Trashed Tags";

        return view('admin.tags.trashed ', compact('title','subtitle','tags'));
    }
    public function destroy($id)
    {
        $title = "admin";
        $subtitle = "management tags";
$tag = Tag::find($id);
        $tag->delete();
return back();
//        return redirect(url('admin/tags'));
    }
    public function restore($id){

        Tag::withTrashed()->where('id', $id)->first()->restore();

        return back();

    }
    public function force($id)
    {
        Tag::withTrashed()
            ->where('id', $id)
            ->first()
            ->forceDelete();
        return back();
    }
}
