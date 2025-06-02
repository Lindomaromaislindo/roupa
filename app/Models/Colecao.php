<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colecao extends Model
{
    use HasFactory;

    protected $table = 'colecao';
    protected $fillable = ['nome_colecao', 'descricao', 'data_lancamento',];

    public function produto()
    {
        return $this->hasMany(Produto::class, 'colecao_id', 'colecao_id');
    }
}
