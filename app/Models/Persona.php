<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model implements AuthenticatableContract
{
    use HasFactory;
    protected $table = 'persona';
    protected $primaryKey = 'ci';
    protected $hashPassword = false;

    protected $fillable = [
        'ci',
        'Nombre',
        'CorreoElectronico',
        'password',
        // Otros campos del personal
    ];
    public function hasRole($rol)
    {
        if ($this->personal) {
            // Verificar si 'personal' no es nulo
            return $this->personal->cargo->rol === $rol;
        }
        return false;
        
    }

    public function personal()
    {
        return $this->hasOne(Personal::class, 'ci_personal', 'ci');
    }
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'ci_cliente', 'ci');
    }
    // Implementar los métodos requeridos por la interfaz Authenticatable

    public function getAuthIdentifierName()
    {
        return 'CorreoElectronico'; // Reemplaza 'ci' con el nombre de la columna que sirve como identificador
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }


    public function getAuthPassword()
    {
        return $this->password; // Devuelve la contraseña en texto plano
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Asegúrate de que coincida con el nombre de la columna en tu tabla
    }


}
