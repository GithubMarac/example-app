<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

 

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;
    
    public $translatedAttributes = ['title','description'];


    public function scopeTags($query, $tags){
        if($tags){
            $tags = explode(',', $tags);
            return $query->has('tags', '=', count($tags))
            ->whereHas('tags', function($q) use($tags) {
            $q->whereIn('tag_id', $tags);
        }, '=', count($tags));
        }else{
            return $query;
        }
    }

    public function scopeCategory($query, $category){
        if($category == 'NULL'){
            return $query->whereNull('category_id');
        }else if($category == '!NULL'){
            return $query->whereNotNUll('category_id');
        }else if($category){
            return $query->where('category_id', 'like', $category);
        }
    }


    public function ingredients(){
        return $this->belongsToMany(Ingredient::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function categories(){
        return $this->belongsTo(Category::class);
    }
}
