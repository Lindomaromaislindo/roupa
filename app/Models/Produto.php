<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produto';
    protected $fillable = ['colecao_id', 'nome', 'preco', 'descricao', 'imagem'];

    public function colecao()
    {
        return $this->belongsTo(Colecao::class);
    }
}
