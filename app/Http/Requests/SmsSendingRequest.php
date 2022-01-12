<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsSendingRequest extends FormRequest
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
            'group_id' => ['string', 'exists:groups,id'],
            'msg_text' => ['string', 'exists:message_templates,id'],
            'time_sending' => ['string', 'nullable'],
        ];
    }
}
