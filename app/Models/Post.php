<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title','category_id','content','author','' 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
