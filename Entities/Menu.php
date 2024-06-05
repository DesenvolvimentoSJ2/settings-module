<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'system_id',
        'title',
        'route',
        'icon',
        'type'
    ];

    public function menu_list()
    {
        return $this->hasMany(Submenu::class, 'menu_id');
    }
}
