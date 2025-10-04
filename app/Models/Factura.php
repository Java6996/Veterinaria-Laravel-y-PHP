<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    
    use HasFactory;

    protected $fillable = ['monto', 'fecha_emision', 'estado_pago', 'email', 'user_id'];
    // correcion Relación: una factura pertenece a un usuario
    public function user()
{
    return $this->belongsTo(User::class);
}


}
