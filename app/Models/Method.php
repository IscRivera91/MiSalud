<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Method extends Model
{
    const NOMBRE_TABLA = 'methods';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'label',
        'action',
        'icon',
        'menu_id',
        'is_menu',
        'is_action',
        'activo',
        'created_user_id',
        'updated_user_id',

    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class)->orderBy('name','ASC');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
}