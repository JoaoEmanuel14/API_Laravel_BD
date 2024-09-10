<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    //Determina que o campo cpf sera a chave primaria
    protected $primaryKey = 'cpf';

    protected $fillable = [
        'cpf',
        'nome',
        'data_nascimento'
    ];
}
