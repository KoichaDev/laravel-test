<?php

use Illuminate\Support\Facades\Route;

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
    return view('posts');
});

// {post} wrapping the curly brakcet is a wild card
Route::get('posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    // ddd = dump, die, debug 
    ddd($path);

    if (!file_exists($path)) {
        // parameter takes a url path
        return redirect('/');

        // abort(404);
        // dd = die and dump, or dump and die. Good for quick debugging
        // dd('File does not exist!');
    }

    $post =  file_get_contents($path);
    return view('post', [
        'post' => $post
    ]);
    // regex: find one or more A-z characters with upper or lowercase letter
    // it's okey to allow underscore and a dash as well
})->where('post', '[A-z_\-]+');

    // If you want more control, then you could do the where() with the regular expression
    // ->whereAlpha('post');