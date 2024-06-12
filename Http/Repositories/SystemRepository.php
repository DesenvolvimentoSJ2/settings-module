<?php

namespace Modules\Settings\Http\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Settings\Entities\Systems;
use Modules\Settings\Http\Requests\CreateSystemsFormRequest;

class SystemRepository
{
    public function add(CreateSystemsFormRequest $request): Systems
    {
        return DB::transaction(function () use ($request) {

            // dd($request->all());

            $file[1] = null;

            if ($request->file('module_image') != '') {
                $file = $request->file('module_image')->store('systems');
                $file = explode('public/', $file);
            }

            // dd($file);

            $system = Systems::create([
                'name' => ucfirst(strtolower($request->input("module_name"))),
                'route' => strtolower($request->input("module_route")),
                'image_system_path' => $file[1],
            ]);

            return $system;
        });
    }

    public function update(Request $request, Systems $module): Systems
    {
        return DB::transaction(function () use ($request, $module) {
            $file[0] = $module->image_system_path;

            if ($request->file('module_image') != '') {

                if (!empty($file[0])) {
                    Storage::delete($file[0]);
                }

                $file = $request->file('module_image')->store('systems');
                $file = explode('public/', $file);
            }

            $module->update([
                'name' => ucfirst(strtolower($request->input("module_name"))),
                'route' => strtolower($request->input("module_route")),
                'image_system_path' => $file[0],
            ]);

            return $module;
        });
    }
}
