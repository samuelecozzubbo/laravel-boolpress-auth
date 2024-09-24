<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Con questo metodo richiamando $miaCategoria->posts ottengo tutti i post in relazione alla categoria
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected $fillable = ['name', 'slug'];
}
