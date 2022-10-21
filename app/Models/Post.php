<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_fr','title_en','body_fr','body_en',
        'photo','category_id','admin_id','slug',
        'published','premium'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query){
        return $query->where('published', 1);
    }

    public function scopePremium($query){
        return $query->where('premium', 1);
    }

    public function scopeSimple($query){
        return $query->where('premium', 0);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
