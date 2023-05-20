<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\MainGallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->user){
            $user = User::where('id', $request->user)->get();
            if(count($user)){
                Auth::login($user[0]);
            }

        }
        $user = auth()->user();
        $galleries = MainGallery::all();
        if($user){
            if($user->role === 'ROLE_ADMIN' or $user->role === 'ROLE_TEACHER' or $user->role === 'ROLE_PARENT' or $user->role === 'ROLE_USER'){
                $children = Child::where('parent_id', $user->id)->get();
                return view('index', compact('children'));
            }
            return view('index', compact('galleries'));
        }

        return view('index',compact('galleries'));
    }
}
