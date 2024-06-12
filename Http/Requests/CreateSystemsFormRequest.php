<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSystemsFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'module_name' => 'required|string|max:255',
            'module_route' => 'required|string|max:255',
            'module_image' => 'nullable|image|mimes:jpeg,png,bmp,gif,svg,webp|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'module_name.required' => 'O nome do módulo é obrigatório.',
            'module_name.string' => 'O nome do módulo deve ser uma string.',
            'module_name.max' => 'O nome do módulo não pode ter mais de 255 caracteres.',

            'module_route.required' => 'A rota do módulo é obrigatória.',
            'module_route.url' => 'A rota do módulo deve ser uma URL válida.',
            'module_route.max' => 'A rota do módulo não pode ter mais de 255 caracteres.',

            'module_image.required' => 'A imagem do módulo é obrigatória.',
            'module_image.image' => 'O arquivo deve ser uma imagem.',
            'module_image.mimes' => 'A imagem deve ser do tipo: jpeg, png, bmp, gif, svg, webp',
            'module_image.max' => 'A imagem não pode ser maior que 2MB.',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
