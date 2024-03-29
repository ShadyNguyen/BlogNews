<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','category_id','content','author','describe' ,'slug'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // public function posts(){
    //     return $this->hasMany(Post::class);
    // }
}
