<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Participante extends Model
{
    use HasFactory;
    public $incrementing = false; // No utilizar la columna 'id'
    protected $table = 'participantes';
    // En el modelo Participante
    protected $fillable = ['dni', 'name_and_last_name', 'email', 'phone_number', 'signatureBase64'];
    protected $encryptable =  [
        //'nombre_y_apellido',
        //'email',
    ];
}
