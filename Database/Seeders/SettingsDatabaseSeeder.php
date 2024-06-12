<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Entities\Systems;

class SettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Systems::truncate();

        Systems::create([
            'name' => 'Settings',
            'route' => 'modules.index',
            'image_system_path' => null,
        ]);

        Systems::create([
            'name' => 'Author',
            'route' => 'author.index',
            'image_system_path' => null,
        ]);

        Systems::create([
            'name' => 'Series',
            'route' => 'series.index',
            'image_system_path' => null,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
