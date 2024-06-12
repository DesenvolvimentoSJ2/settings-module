<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'submenu';

    protected $fillable = [
        'menu_id',
        'title',
        'route_id',
    ];

    public function route()
    {
        return $this->hasOne(Routes::class, 'id', 'route_id');
    }
}
