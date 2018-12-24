<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{   
    //protected $table = 'categorias';
    //protected $primarykey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','descripcion','condicion'];
}
