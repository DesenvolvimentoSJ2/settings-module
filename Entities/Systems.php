<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systems extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'route',
        'image_system_path'
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'system_id');
    }
}
