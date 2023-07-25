<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    
    public $translatedAttributes = ['title','description'];

    public function scopeFilter($query, array $filters){
        if($filters[1] ?? false){
            $query->where('category_id', 'like', request('category'));
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
