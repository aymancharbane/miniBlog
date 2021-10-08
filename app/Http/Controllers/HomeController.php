<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //get the courant user
        $user=Auth::user();

        //if the user has role publisher, function return publisher blog
        if($user->role=='publisher'){
            $posts = Post::where('approved',1)->get();
            return view('home',['posts'=>$posts]);
        }
        //if the user has role admin, function return admin's table
        else{
            $posts = Post::orderBy('id','ASC')->paginate(10);
            return view('post.index',['posts'=>$posts]);
        }
        
        
    }


    public function getPostByPublisher($idPublisher){


        //get the courant user
        $user=Auth::user();

        //if the user has role publisher, function return blog of selected publisher 

        if($user->role=='publisher'){
            $posts=Post::where('idPublisher',$idPublisher)->where('approved',1)->get();
            // dd($posts);
            return view('home',['posts'=>$posts]);
        }

        //if the user has role admin, function return publisher selected post
        else{
            $posts = Post::where('idPublisher',$idPublisher)->orderBy('id','ASC')->paginate(10);
            return view('post.index',['posts'=>$posts]);
        }
    }

    public function getApprovedPost(){
        //get the courant user
        $user=Auth::user();

        //if the user has role admin, function return approved posts 

        if($user->role=='admin'){

            $posts = Post::where('approved',1)->orderBy('id','ASC')->paginate(10);
            return view('post.index',['posts'=>$posts]);
        }

        //if the user has role publishe, function return home page
        else{
            $posts = Post::where('approved',1)->get();
            return view('home',['posts'=>$posts]);
        }
    }


    public function getunapprovedPost(){
        //get the courant user
        $user=Auth::user();

        //if the user has role admin, function return approved posts 

        if($user->role=='admin'){

            $posts = Post::where('approved',0)->orderBy('id','ASC')->paginate(10);
            return view('post.index',['posts'=>$posts]);
        }

        //if the user has role publishe, function return home page
        else{
            $posts = Post::where('approved',1)->get();
            return view('home',['posts'=>$posts]);
        }
    }
}
