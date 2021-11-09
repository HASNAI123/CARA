<?php

namespace App\Http\Requests;

use App\Sop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSopRequest extends FormRequest
{
    

    public function rules()
    {
        return [
            'created_by' => [
                'string',
                'nullable',
            ],
           
                'Sop_file'=>[
                    'string',
                    'nullable',
                ],

                'sop_title' => [
                    'string',
                    'nullable',
            ],

            'effective_date' => [
                'integer',
                'nullable',
            ],
        'business_unit' => [
            'integer',
            'nullable',
        ],
    ];
}
}