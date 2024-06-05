<?php

namespace Modules\Settings\Http\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Settings\Entities\Systems;
use Modules\Settings\Http\Requests\CreateSystemsFormRequest;

class SystemRepository
{
    public function add(CreateSystemsFormRequest $request): Systems
    {
        return DB::transaction(function () use ($request) {

            // dd($request->all());

            $file[1] = null;

            if (isset($request->file)) {
                $file = $request->file('module_image')->store('public/systems');
                $file = explode('public/', $file);
            }

            $system = Systems::create([
                'name' => ucfirst(strtolower($request->input("module_name"))),
                'route' => strtolower($request->input("module_route")),
                'image_system_path' => $file[1],
            ]);

            return $system;
        });
    }
}
