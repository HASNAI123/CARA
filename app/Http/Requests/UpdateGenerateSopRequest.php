<?php

namespace App\Http\Requests;

use App\generateSop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGenerateSopRequest extends FormRequest
{
   

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

            'sop_title' => [
                'string',
                'nullable',
        ],

        'effective_date' => [
           
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


    'verification' => [
        'string',
        'nullable',
    ],

    'steps' => [
        'array',
        'nullable',
    ],

    'img' => [
        'nullable',
    ],

    'desc' => [
        'array',
        'nullable',
    ],

    
    'appendix' => [
       
        'nullable',

     ],


     'Process_owner'=>[
        'nullable'
       ],


       'Process_exec'=>[
        'nullable'
       ],

      

       'reviewed_by'=>[
        'nullable'
       ],

       
       'edited_by'=>[
        'nullable'
       ],

       



        ];
    }
}