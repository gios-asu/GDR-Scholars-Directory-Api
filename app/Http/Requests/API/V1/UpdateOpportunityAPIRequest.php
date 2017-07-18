<?php

namespace GdrScholars\Http\Requests\API\V1;

use GdrScholars\Models\Opportunity;
use InfyOm\Generator\Request\APIRequest;

class UpdateOpportunityAPIRequest extends APIRequest
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
        return Opportunity::$rules;
    }
}
