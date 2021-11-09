<?php

namespace App\Http\Requests;

use App\Generatesop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGenerateSopRequest extends FormRequest
{
    

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:generatesop,id',
        ];
    }
}
