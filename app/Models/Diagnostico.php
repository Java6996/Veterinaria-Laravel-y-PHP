<?php

namespace App\Models;
// para relacion diagnostico entre mascota y usuario
use App\Models\Mascota;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $table = 'diagnosticos';

    use HasFactory;

    protected $fillable = [
                            'sintomas',
                            'diagnostico',
                            'tratamiento',
                            'fecha',
                            'user_id',
                            'mascota_id',
                        ];
    // Relación con la mascota
   public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id', 'id_mascota');
    }



    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
