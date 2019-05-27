<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon_id' => 'required|exists:icons,id',
            'user_id' => 'required|exists:users,id',
            'title'    => 'required',
            'description' => 'required',
            'geoData' => 'required',
            'adress'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'icon_id.exists'       => 'Такой иконки не существует',
        ];
    }
}
