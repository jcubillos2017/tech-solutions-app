<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Proyecto extends Model
{
    use HasFactory;
    /**
     * los atributos que se pueden asignar de forma masiva.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'fecha_inicio',
        'estado',
        'responsable',
        'monto',
        'created_by',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
