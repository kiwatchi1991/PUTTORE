<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'detail', 'lesson', 'default_price', 'pic1' ];
    
    //多対多のリレーションを作る
    //カテゴリー
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    //難易度
    public function difficulties()
    {
        return $this->belongsToMany('App\Difficulty');
    }

     // 1対多のリレーションを作る
     public function lessons()
     {
         return $this->hasMany('App\Lesson');
     }

    // 検索機能
    public function scopeTagFilter($query, ?string $tag)
    {
        if (!is_null($tag)) {
                return $query->where('categorie ', $tag);
            }
        return $query;
    }
}

