<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Modules\Settings\Entities\Menu;
use Modules\Settings\Entities\Systems;
use Modules\Settings\Http\Repositories\SystemRepository;
use Modules\Settings\Http\Requests\CreateSystemsFormRequest;

class ModulesController extends Controller
{
    private $data = array();

    public function __construct(
        private SystemRepository $repository
    ) {
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
        $this->data['systems'] = Systems::all();

        return view('settings::module.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $this->data['form'] = [
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'module_name',
                        'title' => 'Nome do modulo',
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
                        'name' => 'module_route',
                        'title' => 'Principal rota do modulo',
                        'type' => 'text',
                        'placeholder' => 'Rota...',
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
                        'name' => 'module_image',
                        'title' => 'Imagem do modulo',
                        'type' => 'file',
                        'class' => 'mb-3'
                    ]
                ]
            ]
        ];

        return view('settings::module.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSystemsFormRequest $request)
    {
        //

        // dd($request->all());

        $system = $this->repository->add($request);

        return to_route('modules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Systems $module)
    {
        //

        $this->data['management'] = $module;
        $this->data['form_permission'] = [
            [
                'size' => '',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'permissions_id_system',
                        'title' => '',
                        'type' => 'hidden',
                        'value' => $module->id
                    ]
                ]
            ],
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'permissions_parameter',
                        'title' => 'Parâmetro',
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
                        'name' => 'permissions_description',
                        'title' => 'Descrição',
                        'type' => 'text',
                        'placeholder' => 'Descrição...',
                        'class' => 'mb-3',
                        'required' => true
                    ]
                ]
            ],
        ];
        $this->data['form_menu'] = [
            [
                'size' => '',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'menu_id_system',
                        'title' => '',
                        'type' => 'hidden',
                        'value' => $module->id
                    ]
                ]
            ],
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'menu_title',
                        'title' => 'Título',
                        'type' => 'text',
                        'placeholder' => 'Nome...',
                        'class' => 'mb-3',
                        'required' => true
                    ]
                ]
            ],
            [
                'size' => 'col-6',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'menu_icon',
                        'title' => 'Ícone',
                        'type' => 'text',
                        'placeholder' => 'Icone...',
                        'class' => 'mb-3',
                        'required' => true
                    ]
                ]
            ],
            [
                'size' => 'col-6',
                'item' => [
                    [
                        'component' => 'select.select',
                        'name' => 'menu_type',
                        'title' => 'Tipo do menu',
                        'id' => 'select_type_menu',
                        'type' => 'text',
                        'class' => 'mb-3',
                        'required' => true,
                        'option_list' => [
                            [
                                'value' => '',
                                'title' => 'Selecione'
                            ],
                            [
                                'value' => 'menu',
                                'title' => 'Menu'
                            ],
                            [
                                'value' => 'submenu',
                                'title' => 'Submenu'
                            ],
                        ]
                    ]
                ]
            ],
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'menu_route',
                        'title' => 'Rota',
                        'type' => 'text',
                        'placeholder' => 'Rota...',
                        'class' => 'mb-3',
                        // 'required' => true
                        'required' => false
                    ]
                ]
            ],
            [
                'size' => 'col-6',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'submenu_route',
                        'title' => 'Rota',
                        'type' => 'text',
                        'placeholder' => 'Rota...',
                        'class' => 'mb-3',
                        // 'required' => true
                        'required' => false
                    ]
                ]
            ],
            [
                'size' => 'col-6',
                'item' => [
                    [
                        'component' => 'input.input',
                        'name' => 'submenu_title',
                        'title' => 'Título',
                        'type' => 'text',
                        'placeholder' => 'Título...',
                        'class' => 'mb-3',
                        // 'required' => true
                        'required' => false
                    ]
                ]
            ],
        ];

        // dd($management->menu()->with('submenu')->get());

        return view('settings::module.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('settings::module.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
