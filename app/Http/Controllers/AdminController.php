<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    //admin can blocked publisher
    public function blockPublisher($idPublisher){
        $user=User::where('id',$idPublisher)->first();
        $user->status='blocked';
        $user->save();
    }

    //admin can deblocked publisher
    public function deblockPublisher($idPublisher){
        $user=User::where('id',$idPublisher)->first();
        $user->status='not blocked';
        $user->save();
    }

    //admin can approved post
    public function approvePost(Request $request){

        $post=Post::where('id',$request->idPost)->first();
        $post->approved=1;
        $post->save();
        return redirect()->route('posts.index');
    }
}
