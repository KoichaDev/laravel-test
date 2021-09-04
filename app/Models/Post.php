<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post {

    public static function all() {
        $files = File::files(resource_path("posts/"));

        return array_map(fn ($file) => $file->getContents(), $files);
    }

    public static function find($slug) {
        // This is Laravel helper functions that will give you the path to the base of the install, basically path to your project
        base_path();

        // App Path gives you the path directory of the app
        // app_path();
        if (!file_exists($path = resource_path("/posts/{$slug}.html"))) {
            // parameter takes a url path
            // return redirect('/');
            // abort(404);
            throw new ModelNotFoundException();
            // dd = die and dump, or dump and die. Good for quick debugging
            // dd('File does not exist!');
        }

        // Used for caching the website, so user doesn't need to re-download the site many times
        // 2nd param: is used for caching it for example 5 seconds. You could also use the object add Minute
        return cache()->remember("posts.{$slug}", now()->addMinutes(20), fn () => file_get_contents($path));
    }
}
