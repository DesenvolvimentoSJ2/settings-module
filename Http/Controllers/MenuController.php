<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Settings\Entities\Menu;
use Modules\Settings\Entities\Routes;
use Modules\Settings\Entities\Submenu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // dd($request->all());

        if ($request->input('menu_type') == 'menu') {

            $route = Routes::create([
                'name' => strtolower($request->input('menu_route'))
            ]);

            Menu::create([
                'system_id' => $request->input('menu_id_system'),
                'title' => ucfirst($request->input('menu_title')),
                'route_id' => $route->id,
                'icon' => strtolower($request->input('menu_icon')),
                'type' => $request->input('menu_type')
            ]);
        } else if ($request->input('menu_type') == 'submenu') {
            $menu = Menu::create([
                'system_id' => $request->input('menu_id_system'),
                'title' => ucfirst($request->input('menu_title')),
                'icon' => strtolower($request->input('menu_icon')),
                'type' => $request->input('menu_type')
            ]);

            $submenu_list = [];
            foreach ($request->submenu as $submenu) {
                $route = Routes::create([
                    'name' => strtolower($submenu['route'])
                ]);

                $submenu_list[] = [
                    'menu_id' => $menu->id,
                    'title' => ucfirst($submenu['title']),
                    'route_id' => $route->id
                ];
            }

            Submenu::insert($submenu_list);
        }

        return to_route('modules.show', $request->input('menu_id_system'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
