<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index() {
        return view('back-end.catalog.index');
    }
    public function edit($key_token) {
        return view('back-end.catalog.edit', compact('key_token'));
    }
}
