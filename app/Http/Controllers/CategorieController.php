<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the courant user
        $user=Auth::user();
        
        //verfiy if the user has role admin
        if($user->role == 'admin'){
            $categories = Categorie::orderBy('id','ASC')->paginate(10);
            return view('category.index',['categories'=>$categories]);
        }
        else{
            $posts = Post::orderBy('id','ASC')->paginate(10);
            return view('post.index',['posts'=>$posts]);
        }
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
        if($user->role == 'admin'){
            return view('category.create');
        }
        else{
            $posts = Post::orderBy('id','ASC')->paginate(10);
            return view('post.index',['posts'=>$posts]);
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

        //if user has role admin, he can show categories table
        if($user->role == 'admin'){
            $this->validate($request,
            [
                'name'=> 'string|required',
            ]);

            
            $status = Categorie::create($request->all());
            if($status){
                request()->session()->flash('success','Category successfully added');
            }
            else{
                request()->session()->flash('error','Error occurred while adding Categorie');
            }
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get the courant user
        $user=Auth::user();

        //if the user has role admin, he can modify category
        if($user->role == 'admin'){
            $categorie = Categorie::find($id);
            return view('category.edit',['categorie'=>$categorie]);
        }
        else{
            $posts = Post::orderBy('id','ASC')->paginate(10);
            return view('post.index',['posts'=>$posts]);
        }
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
        //get the courant user
        $user=Auth::user();

        //if the user has role admin, he can modify category
        if($user->role == 'admin'){
            $this->validate($request,
            [
                'name'=>'string|required',
                
            ]);

            $categorie = Categorie::findOrFail($id);
            $status=$categorie->fill($request->all())->save();
            if($status){
                request()->session()->flash('success','Successful update');
            }
            else{
                request()->session()->flash('error','An error occurred while updating');
            }
            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get the courant user
        $user=Auth::user();

        //if the user has role admin, he can delete category
        if($user->role == 'admin'){
            $categorie = Categorie::findOrFail($id);
            $status = $categorie->delete();
            if($status){
                request()->session()->flash('success','category successfully deleted');
            }
            else{
                request()->session()->flash('error','An error occurred while deleting');
            }
            return redirect()->route('categories.index');
        }
        
    }
}
