<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use DB;
use App\Models\User;
use App\Models\Profile;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
$this->user=$user;

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
        $title='Admin';
        $subtitle='Users';
//        $users= DB::table('users')->get()->sortDesc();
        $users= User::orderByRaw('id DESC')->paginate(15);
        return view('admin.users.index',compact('title',
            'subtitle', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
$title= 'Create user';
return view('admin.users.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $profile = new Profile();

        $user->profile('ip_address')->save($profile);
        return redirect()->route('users')->withType('success')->withSuccess('User created successfully');

//        $request->validate([
//            'name'=>'unique:users|required|max:10|min:4',
//            'email'=>'required',
//            'password'=>'required|max:10|min:4'
//        ]);
//        $user =User::create([
//            'name'=>$request->name,
//            'email'=>$request->email,
//            'password'=>$request->password
//        ]);
//
////        $profile = new Profile();
//        $user->profile()->save($profile);
//        return redirect(route('users'))->withType('success')->withMessage('user created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
$title='Users';

        $user = User::with('profile')->findOrFail($id);

return view('admin.users.show', compact('title','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Admin";
$subtitle='Edit User';
//        $profile = Profile::all()->pluck('first_name','last_name', 'id');
        $user = User::find($id);




        return view('admin.users.edit', compact('title','subtitle','user',
            ));
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
        $user = User::find($id);
        $request->validate([
           'name'=>'required|max:10|min:4',
            'email'=>'required|unique',
            'password'=>'required|min:7|max:10'

        ]);
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ];

        $user->update($data);
        return redirect()->route('users')->withType('success')->withMessage('Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->withType('success')->withMessage('Moved to trash successfully');
    }
    public function trashed(){
        $title = "User trashed list";
        $users = User::onlyTrashed()->paginate(10);
        $subtitle = "Menagement Trashed posts";
        return view('admin.users.trashed', compact('title','subtitle', 'users' ));
    }
    public function restore($id)
    {
        User::withTrashed()->where('id',$id)->first()->restore();
        return back()->withType('success')->withMessage('Restored Successfully ');
    }
    public function force($id){
        User::withTrashed()->where('id',$id)->first()->forceDelete();
        return back()->withType('success')->withMessage('Deleted successfully');
    }
}
