<?php

namespace Modules\Settings\Entities;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Routes extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'route_id');
    }
}
