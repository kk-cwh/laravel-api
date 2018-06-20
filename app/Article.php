<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'category_id','subtitle','page_image', 'user_id', 'status', 'content','published_at'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'tag_articles','article_id','tag_id');
    }
}
