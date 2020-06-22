<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Product;

class Menu extends Controller
{
    public function index() {
        return view('index', ["menu"=>"active"]);
    }

    public function history() {
        return view('history', ["history"=>"active"]);
    }
}
