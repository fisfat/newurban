<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Events\ArticlePosted;

use App\Notifications\ArticlePosted as ArticlePostedNotification;

class ArticlesController extends Controller
{   
    /**
     * Restrict usage by users
     * 
     */
    
    public function __construct()
    {
        $this->middleware('isAdmin')->except('index', 'show');
        
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id', 'desc')->paginate(15);
        
        $user = User::find(Auth::user()->id);
        $user->notify( new ArticlePostedNotification($user) );
        
        return view('articles.index', ['articles'=>$articles]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
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
            'title' => 'Required',
            'content' => 'Required',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2000',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator);

        if($request->hasFile('image')){

            $filenamewithext = $request->file('image')->getClientOriginalName();
  
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
  
            $fileext = $request->file('image')->getClientOriginalExtension();
  
            /*store the file with the current time so that
              images of users with the same image name will 
              be stored differently. 
            */
            $filenametostore = $filename.time().'.'.$fileext;
            //Now store the image
  
            $path = $request->file('image')->storeAs('/public/images', $filenametostore);
           }
          else{
            $filenametostore = '';
          }

          $article = new Article;
          $article->title = $request->input('title');
          $article->body = $request->input('content');
          $article->user_id = Auth::user()->id;
          $article->image = $filenametostore;
          
          if($article->save())return redirect()->back()->withSuccess('New post as been created');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article = Article::find($article->id);
        $user = User::find($article->id);
        $comments = DB::table('comments')->join('articles', 'comments.article_id', '=', 'articles.id')
                                         ->join('users', 'comments.user_id', '=', 'users.id')
                                         ->select('comments.body', 'comments.created_at', 'users.name')
                                         ->where('articles.id', $article->id)
                                         ->orderBy('comments.created_at', 'ASC')
                                         ->paginate(10);
        //$comments = Article::find($article->id)->comments;    //where('article_id', $article->id)->get();
        
        return view('articles.show', ['article'=>$article, 'user'=>$user, 'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $article = Article::find($article->id);
        return view('articles.edit', ['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'Required',
            'content' => 'Required',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:1999',
        ]);
           
        if($validator->fails()) return redirect()->back()->withErrors($validator);

        if($request->hasFile('image')){

            $filenamewithext = $request->file('image')->getClientOriginalName();
  
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
  
            $fileext = $request->file('image')->getClientOriginalExtension();
  
            /*store the file with the current time so that
              images of users with the same image name will 
              be stored differently. 
            */
            $filenametostore = $filename.time().'.'.$fileext;
            //Now store the image
  
            $path = $request->file('image')->storeAs('/public/images', $filenametostore);
           }
          else{
            $filenametostore = '';
          }

        $article = Article::find($article->id);
        $article->title = $request->input('title');
        $article->body = $request->input('content');
        $article->image = $filenametostore;

        $update = $article->save();
        event( new ArticlePosted($update));

        if($update) return redirect()->back()->withSuccess('Changes successfully made.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article = Article::find($article->id);
        $article->comments()->delete();
        $article->delete();

        return redirect()->back()->withSuccess('Article successfully deleted');
    }

    public function arrayinput(Request $request){
        for ($i=0; $i < count($request->msg); $i++) { 
            dd($request->pool);
        }
    }
    public function arrayinputget(){
        return view('articles.arrayinput');
    }
}
