<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Gate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        // Seleciona todos os posts
        $posts = $post->all();

        // Seleciona todos os posts do usuário logado
        // $posts = $post->where('user_id', auth()->user()->id)->get();

        return view('home', compact('posts'));
    }

    public function update($idpost){
        
        $post = Post::find($idpost);

        // $this->authorize('update-post', $post);

        if( Gate::denies('update-post', $post) )
            abort(403, 'Unauthorized');

        return view('post-update', compact('post'));

    }

    public function rolesPermissions(){
        // return 'Roles e Permissions to users';

        $nameUser = auth()->user()->name;
        echo "<h1>{$nameUser}</h1>";

        foreach(auth()->user()->roles as $role){
            echo "<b>$role->name</b> -> ";
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                echo " $permission->name , ";
            }
            echo "<hr>";
        }

    }

}
