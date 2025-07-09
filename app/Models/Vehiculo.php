<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = [
        'marca_id',
        'modelo',
        'anio',
        'tipo',
        'placa',
        'precio',
        'transmision',
        'pasajeres',
        'propietario_id',
        'imagen',
        'estado',
        'rental_status',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function propietario()
    {
        return $this->belongsTo(User::class, 'propietario_id');
    }
}
