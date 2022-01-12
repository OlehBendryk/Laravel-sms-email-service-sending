<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'first_name' => [ 'string', 'min:3', 'max:64' ],
            'last_name' => ['string', 'min:3', 'max:64' ],
            'email' => ['email', 'max:64' ],
            'birth_of_date' => ['date'],
            'phone' => ['string', 'min:3', 'max:64' ],
            'sex' => ['string', 'min:3', 'max:64' ]
        ];
    }
}
