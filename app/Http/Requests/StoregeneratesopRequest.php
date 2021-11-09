<?php

namespace App\Http\Requests;

use App\Generatesop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoregeneratesopRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('generate_new_sop_create');
    }

    public function rules()
    {
        return [
            'created_by' => [
                'string',
                'nullable',
            ],
            'approved_by' => [
                'string',
                'nullable',
            ],
            'uploaded_by' => [
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
            'string',
            'nullable',
        ],
        'doc_no' => [
            'integer',
            'nullable',
        ],
        'version_no' => [
            'ineteger',
            'nullable',
        ],
        'policy' => [
            'string',
            'nullable',
        ],
        'purpose' => [
            'string',
            'nullable',
        ],
        'scope' => [
            'string',
            'nullable',
        ],
        'review_pro' => [
            'string',
            'nullable',
        ],
        'monitoring' => [
            'string',
            'nullable',
        ],

        'desc' => [
            'string',
            'nullable',
        ],


        'verification' => [
            'string',
            'nullable',
        ],

        'description' => [
            'string',
            'nullable',
        ],
        'steps' => [
            'string',
            'nullable',
        ],

        'img' => [
            'string',
            'nullable',
        ],

         'appendix' => [
            'string',
            'nullable',

         ],
        

         'Process_owner'=>[
            'string'
           ],
  
  
           'Process_exec'=>[
            'string'
           ],
  
          
  

           





    ];
}
}