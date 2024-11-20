<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'conteudo', 'user_id'];

    public function usuario() {
        return $this->belongsTo('App\Models\User');
    }

    public function empresa()
{
    return $this->belongsTo(Empresa::class);
}

}
