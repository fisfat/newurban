<?php
    namespace App\helpers;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use App\User as UserModel;
    use App\Comment;
    use App\Article;


    class User{
        /**
         * @param \Illuminate\Http\Request  $request 
         * 
         * @return \Illuminate\Http\Response
         * 
         */
        public static function get_request($request)
        {
            $validator = Validator::make($request->all(), [
                'comment' => 'required',
                'article_id' => 'required|int',
            ]);
            if($validator->fails()) return redirect()->back()->withErrors($validator);
            
            $comment = new Comment;
            $comment->user_id = Auth::user()->id;
            $comment->article_id = $request->input('article_id');
            $comment->body = $request->input('comment');

            if($comment->save()) return redirect()->back()->withSuccess('You have successfully posted a comment');
        }

            /**
             * @param string $input  this takes in user input
             * 
             * @return \Illuminate\Http\Response
             */
            public static function find_user($input){
                if (strpos($input, ' ') != false){
                    $query = explode(' ', $input);
                    foreach($query as $query_word){
                       $newbies = UserModel::where('email', 'LIKE', '%' . $query_word . '%')->orWhere('name', 'LIKE', '%' . $query_word . '%')->paginate(5);
                    }
                }else{
                   $newbies = UserModel::where('email', 'LIKE', '%' . $input . '%')->orWhere('name', 'LIKE', '%' . $input . '%')->paginate(5);
                }
            if(count($newbies) != 0){

                return view('admin.search', ['newbies'=>$newbies])->withSuccess('Your Search for ' . $input . ' matched ' . count($newbies) . ' result(s) ' );
                
                
            }else{
                return view('admin.search', ['newbies'=>$newbies])->withErrors('Your search for ' . $input . ' matched no results');
            }
    }
        /**
         * @param string $input
         * 
         * @return \Illuminate\Http\Response
         */
        public static function find_post($input){
            if(strpos($input, ' ') != false){
                $values = explode(' ', $input);

                foreach($values as $value){
                    $results = Article::where('title', 'LIKE', '%' . $value . '%')->orderBy('created_at', 'DESC')->paginate(15);
                }   
            }else{
                $results = Article::where('title', 'LIKE', '%' . $input . '%')->orderBy('created_at', 'DESC')->paginate(15);
            }
            
            $count =  count($results);
            if( $count > 0) return view('articles.search', ['results'=>$results])->withSuccess('Your search for ' . $input . ' matched '. $count .' result(s)' );
            else return view('articles.search')->withErrors('Your search for ' . $input . ' matched '. $count .' results' );

        }
}