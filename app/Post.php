<?php

namespace App;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title','content',' slug','category_id'];

    // prende stringa come input e converte in slug
    public static function convertToSlug($title){
        $slugPrefix = Str::slug($title);
        $slug = $slugPrefix;
        $postFound = Post::where('slug',$slug)->first();
        $count = 1;
        while($postFound){
            $slug = $slugPrefix.'_'.$count;
            $count++;
            $postFound = Post::where('slug',$slug)->first();
        }
        return $slug;
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
