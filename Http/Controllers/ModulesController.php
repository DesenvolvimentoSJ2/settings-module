<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Illuminate\Session\Store;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Modules\Settings\Entities\Menu;
use Modules\Settings\Entities\Systems;
use Modules\Settings\Http\Repositories\SystemRepository;
use Modules\Settings\Http\Requests\CreateSystemsFormRequest;
use Spatie\Permission\Models\Permission;

class ModulesController extends Controller
{
    private $data = array();

    public function __construct(
        private SystemRepository $repository
    ) {

        // dd($this->data['menu']);
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

        // dd($system);

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

        $lists = [];

        foreach ($module->menu()->with('menu_list')->get() as $index => $menu) {

            if ($menu->type == 'menu') {
                $lists[$index] = [
                    'value' => $menu->route_id,
                    'text' => $menu->title
                ];
            } else {
                $sub = [];
                foreach ($menu->menu_list as $i => $list) {
                    $sub[$i] = [
                        'value' => $list->route_id,
                        'text' => $list->title
                    ];
                }

                $lists[$index] = [
                    'label' => $menu->title,
                    'options' => $sub
                ];
            }
        }

        // dd($module->permissions);
        // dd($module->menu()->with('menu_list')->get());

        $this->data['menu'] = $module->menu()->with('menu_list')->get();

        // dd($this->data['menu']);

        $this->data['permissions'] = $module->permissions;
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
            [
                'size' => 'col-12',
                'item' => [
                    [
                        'component' => 'select.select-with-groups',
                        'name' => 'permissions_algumaCoisa',
                        'title' => 'Selecione o menu',
                        'group_list' => $lists
                    ]
                ]
            ]
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

        $this->data['form_edit'] = [
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
                        'required' => true,
                        'value' => $module->name
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
                        'required' => true,
                        'value' => $module->route
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
    public function update(Request $request, Systems $module)
    {
        //

        $system = $this->repository->update($request, $module);

        return to_route('modules.show', $module->id);
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
