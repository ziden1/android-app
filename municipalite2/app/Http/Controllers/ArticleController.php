<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index()
    {
        $data = Article::all();
        return response()->json( [ 'success' => true, 'data' => $data ] );
    }
}
