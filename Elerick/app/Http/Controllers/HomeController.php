<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function landing(){
    $data['blogs'] = Blog::latest()->get();
    return view('landing', $data);
   }

}
