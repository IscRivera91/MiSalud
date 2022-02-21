<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presion extends Model
{
    const NOMBRE_TABLA = 'presiones';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'activo',
        'created_user_id',
        'updated_user_id',

    ];
}