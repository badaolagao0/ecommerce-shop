<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->get();
        $categories = Category::where('parent_id', 0)->get();
        return view('home.home', compact('sliders', 'categories'));
    }


}