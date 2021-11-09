<?php

namespace App\Http\Requests;

use App\Folder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class ShowRequest extends FormRequest
{
    

    public function rules()
    {
        return [
            'folder_title' => [
                'string',
                'nullable',
            ],

    ];
}
}