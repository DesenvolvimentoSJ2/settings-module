<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    private $data = array();

    public function __construct() {

        $this->data['menu'] = Menu::where('system_id', '9c36f1e1-7980-4f9c-8d25-14c8acbe385a')->with('menu_list')->get();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $this->data['roles'] = Role::orderBy('name')->get();

        return view('settings::roles.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $this->data['form'] = [
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'role_name',
                        'title' => 'Nome da regra',
                        'type' => 'text',
                        'placeholder' => 'Nome...',
                        'class' => 'mb-3',
                        'required' => true
                    ]
                ]
            ],
        ];

        return view('settings::roles.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //

        // dd($request->all());

        Role::create([
            'name' => ucfirst($request->role_name)
        ]);

        return to_route('roles.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Role $role)
    {

        $this->data['role'] = $role;
        $this->data['permissions'] = Permission::all();

        return view('settings::roles.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Role $role)
    {
        //

        foreach ($request->permissions as $item) {
            if (!$role->hasPermissionTo($item)) {
                $role->givePermissionTo($item);
            }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Role $role)
    {
        //
        // dd($role);

        $role->delete();

        return back();
    }
}
