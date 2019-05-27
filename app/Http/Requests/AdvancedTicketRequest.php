<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvancedTicketRequest extends FormRequest
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
            'startInterval' => 'required',
            'endInterval'       => 'required',
            'isMonday' => 'required',
            'isTuesday'       => 'required',
            'isWednesday' => 'required',
            'isThursday'       => 'required',
            'isFriday' => 'required',
            'isSaturday'       => 'required',
            'isSunday'       => 'required'
        ];
    }
}
