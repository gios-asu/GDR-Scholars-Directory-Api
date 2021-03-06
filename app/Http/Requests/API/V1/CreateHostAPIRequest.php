<?php

namespace GdrScholars\Http\Requests\API\V1;

use GdrScholars\Models\Host;
use InfyOm\Generator\Request\APIRequest;

class CreateHostAPIRequest extends APIRequest
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
        return Host::$rules;
    }
}
