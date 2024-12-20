<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'content' ,
        'tags' ,
        'is_visible',
        'thumbnail',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected function thumbnail():Attribute{
        return Attribute::make(get: function($value){
            return $value ? '/storage/thumbnails/'. $value : '/fallback-thumbnail.jpg';
        });
    }
}
