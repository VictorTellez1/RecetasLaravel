<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //Campos que se agregaran
    protected $fillable = [
        'titulo',
        'preparacion',
        'ingredientes',
        'imagen',
        'categoria_id'
    ];

    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }
    //Obtener la informacion del usuario via FK
    public function autor(){
        return $this->belongsTo(User::class,'user_id');
    }
     //Likes que ha recibido una receta

     public function likes()
     {
         return $this->belongsToMany(User::class,'likes_receta'); //El segundo campo indica donde se van a guardar
     }
}
