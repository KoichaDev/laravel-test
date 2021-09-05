<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post {

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all() {


        // Alternative 1 approach.
        // return array_map(function ($file) {
        //     $document = YamlFrontMatter::parseFile($file);
        //     return new Post(
        //         $document->title,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body(),
        //         $document->slug,
        //     );
        // }, $files);


        // Alternative 2 approach (cleaner way).
        // Collections are a feature provided by laravel, it's a sort of Array like on stereoids. It gives you more OOP-syntax for calling all sorts of methods
        // if you want to iterate or map over them, filter them, combine them or merge them.

        return cache()->rememberForever('posts.all', function () {
            $files = File::files(resource_path("posts/"));
            return collect($files)
                ->map(function ($file) { // Mapping through the YAML front matter file
                    return YamlFrontMatter::parseFile($file);
                })
                ->map(function ($document) { // after mapping through, we want to fetch it by using the callback function of $document
                    return new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->body(),
                        $document->slug,
                    );
                })
                ->sortByDesc('date');
        });
    }

    public static function find($slug) {
        // Of all the blog posts, find the one with a slug that matches the one that was requested.
        $post = static::all();

        // Get the first item by the given key value pair.
        return $post->firstWhere('slug', $slug);;
    }

    public static function findOrFail($slug) {
        // Get the first item by the given key value pair.
        $post = static::find($slug);

        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
