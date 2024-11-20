<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'conflitos'];

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    public function noticias()
    {
        return $this->hasMany(Noticia::class);
    }
}
