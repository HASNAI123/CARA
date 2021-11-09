<?php

namespace App\Http\Requests;

use App\Sop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class DownloadSopRequest extends FormRequest
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
            ];
        
    }
}