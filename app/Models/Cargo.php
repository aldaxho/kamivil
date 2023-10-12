<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $table = 'cargo';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'rol',
        // Otros campos del cargo
    ];

    public function personal()
    {
        return $this->hasMany(Personal::class, 'id_cargo', 'id');
    }
}
