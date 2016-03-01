<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Response;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        $response = Response::json($posts,200);
        return $response;
    }
}
