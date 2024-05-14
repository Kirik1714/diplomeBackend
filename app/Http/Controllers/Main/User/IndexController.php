<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(){
        $users= User::paginate(4); 
        
        return view('user.index',compact('users'));  


    }
    public function search(Request $request){
        $searchQuery = $request->input('search');
        $users = User::where('name', 'like', '%' . $searchQuery . '%')->paginate(5);
    
        return view('user.search', compact('users', 'searchQuery'));
    }
}
