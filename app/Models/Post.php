<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'idPublisher',
        'title',
        'slug',
        'body',
        'image',
        'idCategory',
        'approved',
    ];


    public function publisher(){
        return $this->belongsTo(User::class,'idPublisher','id');
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class,'idCategory','id');
    }
}
