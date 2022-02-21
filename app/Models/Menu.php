<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    const NOMBRE_TABLA = 'menus';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'label',
        'icon',
        'activo',
        'created_user_id',
        'updated_user_id',

    ];

    public function methods(): HasMany
    {
        return $this->hasMany(Method::class)->orderBy('name','ASC');
    }
}