<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'user_id'    => 'required|exists:users,id',
            'organization_id' => '',
            'place_id'       => 'required|exists:places,id',
            'status_id'       => 'required|exists:statuses,id',
            'isEat' => 'required',
            'isSleep'       => 'required',
            'isMed' => 'required',
            'isHeat'       => 'required',
            'isDry' => 'required',
            'isWork'       => 'required',
            'title' => 'required|min:2|max:32',
            'description'       => 'required|min:2|max:256',
            'availableVisitors'       => 'required',
            'time'       => 'required',

            // 'user_id'    => '',
            // 'organization_id' => '',
            // 'place_id'       => '',
            // 'status_id'       => '',
            // 'type_id'       => '',
            // 'title' => '',
            // 'description'       => '',
            // 'availableVisitors'       => '',
            // 'time'       => '',
        ];
    }
}
