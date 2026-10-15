<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class UserController extends Controller
{
     public function showDataHome(){
          $post = Post::all();
          return view('home', compact('post'));
     }

     public function showFullPost($id){
          $post = Post::findOrFail($id);
          return view('fullpost', compact('post'));
     }

     public function home(Request $request){
          // Jodi admin hoy, admin dashboard-e pathabe
          if ($request->user()->usertype == 'admin') {
               return redirect()->route('admin.dashboard');
          } 
          
          // Jodi normal user hoy, tahole user dashboard-er poriborte 
          // direct frontend UI homepage-e pathiye debe:
          return redirect()->route('home');
     }

     public function index(Request $request){
          if ($request->user()->usertype == 'admin') {
               return view('admin.dashboard');
          } else {
               return redirect()->route('dashboard');
          }
     }
}