<?php

namespace App\Http\Requests;

use App\Sop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSopRequest extends FormRequest
{
   

    public function rules()
    {
        return [
            'created_by' => [
                'string',
                'nullable',
            ],
           
        ];
    }
}