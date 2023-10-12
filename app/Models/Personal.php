<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'personal';
    protected $primaryKey = 'ci_personal';

    protected $fillable = [
        'ci_personal',
        'Dirección',
        'Sexo',
        'Teléfono',
        'id_cargo',
        // Otros campos del personal
    ];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'ci', 'ci_personal');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo', 'id');
    }
}
