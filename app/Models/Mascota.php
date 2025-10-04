<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas';
    protected $primaryKey = 'id_mascota';
 // nombre realde la PK
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['id_mascota',
                            'nombre',
                            'especie',
                            'raza',
                            'fecha_nacimiento',
                            'user_id'
                            ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function diagnosticos()
    {
        return $this->hasMany(Diagnostico::class, 'mascota_id', 'id_mascota');
    }
}