<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $table = 'alquileres';

    protected $fillable = [
        'user_id',
        'vehiculo_id',
        'propietario_id',
        'fecha_inicio',
        'fecha_fin',
        'monto_total',
        'estado',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propietario()
    {
        return $this->belongsTo(User::class, 'propietario_id');
    }
}
