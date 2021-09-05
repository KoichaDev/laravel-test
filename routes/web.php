<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts', [
        'posts' => Post::all(),
    ]);
});

// {post} wrapping the curly brakcet is a wild card
Route::get('posts/{post}', function ($slug) {
    return view(
        'post',
        [
            'post' => Post::find($slug)
        ]
    );

    // regex: find one or more A-z characters with upper or lowercase letter
    // it's okey to allow underscore and a dash as well
})->where('post', '[A-z_\-]+');

// If you want more control, then you could do the where() with the regular expression
// ->whereAlpha('post');
