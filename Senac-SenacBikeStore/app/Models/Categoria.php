<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

 //Campos publicaveis.
 protected $fillable = ['nomedacategoria'];

 //nome da chave primaria
 protected $primaryKey = 'pkcategoria';

 // Nome da Tabela
 protected $table = 'categorias';

 // Informa que esta trabalhando com incremento
 public $incrementing = true;

 //Não utiliza timestamps nos controles (created & updated)
 public $timestamps = false;
 
}
