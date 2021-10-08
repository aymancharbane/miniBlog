<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all post 
        $posts = Post::orderBy('id','ASC')->paginate(10);
        return view('post.index',['posts'=>$posts]);

    }


   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get the courant user
        $user=Auth::user();
        //return all categories
        $categories=Categorie::get();

        //if the user has role publisher, return the category creation page
        if($user->role == 'publisher'){
            return view('post.create',['categories'=>$categories]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //get the courant user
        $user=Auth::user();

        //if the user has role publisher, create post
        if($user->role == 'publisher'){
            $this->validate($request,
            [
                'title'=> 'string|required|max:100',
                'body'=> 'string|required',
                'image'=> 'required',
                'idCategory'=> 'required',
            ]);

            // dd($request->image);
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $imgUrl = '/images/'.$imageName;

            $status = Post::create([
                'idPublisher'=>$request->user()->id,
                'title'=>$request->title,
                'slug'=>str_replace(" ", "_", $request->title),
                'body'=>$request->body,
                'image'=>$imgUrl,
                'idCategory'=>$request->idCategory
            ]);
            if($status){
                request()->session()->flash('success','post successfully added');
            }
            else{
                request()->session()->flash('error','Error occurred while adding Categorie');
            }
            return redirect()->route('posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        $categories=Categorie::get();
        return view('post.edit',['post'=>$post,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,
        [
            'title'=> 'string|required|max:100',
            'body'=> 'string|required',
            'idCategory'=> 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $imgUrl = '/images/'.$imageName;
        $categorie = Categorie::findOrFail($id);

        $status=$categorie->fill([
            'title'=>$request->title,
            'slug'=>str_replace(" ", "_", $request->title),
            'body'=>$request->body,
            'image'=>$imageName,
            'idCategory'=>$request->idCategory
        ])->save();
        if($status){
            request()->session()->flash('success','Successful update');
        }
        else{
            request()->session()->flash('error','An error occurred while updating');
        }
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $status = $post->delete();
        if($status){
            request()->session()->flash('success','post successfully deleted');
        }
        else{
            request()->session()->flash('error','An error occurred while deleting');
        }
        return redirect()->route('posts.index');
        //
    }
}
