<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserModules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Modules\Settings\Entities\Menu;
use Modules\Settings\Entities\Systems;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    private $data = array();

    public function __construct()
    {
        // $this->data['menu'] = [
        //     // [
        //     //     'route' => 'systems.index',
        //     //     'title' => 'Selecione',
        //     //     'is_active' => !FacadesRequest::is('management*') && !FacadesRequest::is('users*') ? true : false,
        //     //     'icon' => 'ti-pointer'
        //     // ],
        //     [
        //         'route' => null,
        //         'title' => 'Módulos',
        //         'is_active' => FacadesRequest::is('modules*') ? true : false,
        //         'icon' => 'ti-folders',
        //         'menu_list' => [
        //             ['route' => 'modules.index', 'title' => 'Módulos'],
        //             ['route' => 'modules.create', 'title' => 'Novo Modulo'],
        //         ]
        //     ],
        //     [
        //         'route' => null,
        //         'title' => 'Usuários',
        //         'is_active' => FacadesRequest::is('users*') ? true : false,
        //         'icon' => 'ti-users',
        //         'menu_list' => [
        //             ['route' => 'users.create', 'title' => 'Novo Usuário'],
        //         ]
        //     ],
        // ];

        $this->data['menu'] = Menu::where('system_id', '9c36f1e1-7980-4f9c-8d25-14c8acbe385a')->with('menu_list')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['users'] = User::all();

        return view('settings::users.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        foreach (Systems::all() as $index => $system) {
            $list_systems[$index] = [
                'value' => $system->id,
                'path_image' => asset('storage/' . $system->image_system_path),
                'label' => $system->name
            ];
        }

        $this->data['form'] = [
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'user_name',
                        'title' => 'Nome',
                        'type' => 'text',
                        'placeholder' => 'Nome...',
                        'class' => 'mb-3',
                        'required' => true
                    ]
                ]
            ],
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'user_email',
                        'title' => 'Email',
                        'type' => 'text',
                        'placeholder' => 'Email...',
                        'class' => 'mb-3',
                        'required' => true
                    ]
                ]
            ],
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'title' => 'Sistemas',
                        'component' => 'checkbox.image-check',
                        'name' => 'module_systems[]',
                        'option_list' => $list_systems
                    ]
                ]
            ],
        ];

        return view('users.create', $this->data);
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
        dd($request->all());

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
    public function edit(User $user)
    {
        //
        $this->data['user'] = $user;

        foreach (Role::all() as $index => $role) {

            $role_list[$index] = [
                'value' => $role->name,
                'text' => $role->name
            ];

        }

        $system_list = $user->with('my_systems.system')->first();

        // dd($system_list);

        $this->data['user_systems'] = $system_list->my_systems;

        foreach (Systems::all() as $index => $system) {
            $list_systems[$index] = [
                'value' => $system->id,
                'path_image' => asset('storage/' . $system->image_system_path),
                'label' => $system->name
            ];
        }

        $this->data['form'] = [
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'title' => 'Sistemas',
                        'component' => 'checkbox.image-check',
                        'name' => 'module_systems[]',
                        'option_list' => $list_systems
                    ]
                ]
            ],

            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'select.select-with-groups',
                        'name' => 'role',
                        'title' => 'Selecione o grupo de permissão',
                        'group_list' => isset($role_list) ? $role_list : []
                    ]
                ]
            ]
        ];

        return view('settings::users.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        // dd($request->all());
        // dd($user);

        // $user_id = Auth::user()->id;

        if ($request->module_systems) {
            foreach ($request->module_systems as $item) {
                $exist = UserModules::where('module_id' , $item)->where('user_id', $user->id)->first();

                if (!$exist) {
                    UserModules::create([
                        'module_id' => $item,
                        'user_id' => $user->id
                    ]);

                    // echo 'entrou';
                }

            }
        }

        if ($request->role) {
            if (!$user->hasRole($request->role)) {
                $user->assignRole($request->role);
            }
        }

        return back();
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
