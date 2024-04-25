<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $title = 'About page';
        $subtitle= 'fgsdf';
        // return view('about.index', ['title'=>"about page"]);
        $uri = action('App\Http\Controllers\AboutController@index');
        return view('about.index')->withTitle('lflflfl')->withSubtitle($uri);
        
    }
}
