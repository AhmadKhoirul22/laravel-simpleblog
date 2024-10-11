<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
class Dashboard_Controller extends Controller
{
    public function index(){
        return view('dashboard',['title' => 'Dashboard']);
    }
}
