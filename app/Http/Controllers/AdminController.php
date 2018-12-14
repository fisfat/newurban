<?php

namespace App\Http\Controllers;

use App\User;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\signup;

class AdminController extends Controller
{
     /**
     * Restrict usage by users
     * 
     */
    
    public function __construct()
    {
        $this->middleware('isAdmin');
        
    }
    public function send(){
        Mail::to('fisfat-ca3339@inbox.mailtrap.io')->send(new SignUp);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(4);
        //$articles = User::find(Auth::user()->id)->articles()->orderBy('created_at', 'desc')->paginate(4);
        $newUsers = User::orderBy('id', 'desc')->limit(10)->simplePaginate(3);
        return view('admin.index', ['articles'=>$articles, 'newUsers'=>$newUsers]);
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        $user = User::where('id', $user->id)->first();
       
        return view('admin.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $theuser = User::find($user->id);
        $user_role_id = $theuser->role_id;
        $updateuser = User::find($user->id);
        
        if(Auth::user()->id != $user->id){
            if($request->has('deactivate')){   
                $updateuser->active = $user->active == true ? false : true;
            }elseif($request->has('submit')){
                $updateuser->role_id = $user_role_id == 1 ? 2 : 1;
            }
            if($updateuser->save()) return redirect()->back()->withSuccess('Changes have been made on user ' . $user->name);
        }else{
            return redirect()->back()->withErrors('You cannot perform this operation on your self');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        
    }
}
