<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'Cliente';
    protected $primaryKey = 'ci_cliente';
    protected $fillable = [
        'ci_cliente',
        'nit',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'ci', 'ci_cliente');
    }
}
