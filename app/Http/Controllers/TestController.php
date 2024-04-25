<?php

namespace App\Http\Controllers;



class TestController extends Controller
{
    public function index (){
$title = "users- kfkfk";
    $subtitle = "retewrwert";
    return view('/users',compact ('title','subtitle'));
    }
}
